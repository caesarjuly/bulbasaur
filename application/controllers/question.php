<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 问题控制器
 */
class Question extends CI_Controller {
	/**
	 * [__construct 构造函数]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->auth();
		$this->form_validation->set_error_delimiters('<div class="myError">', '</div>');
	}
	/**
	 * [权限验证]
	 * @return [multi] [成功TRUE 失败跳转到登录页面]
	 */
	public function auth()
	{
		if ($this->session->userdata('is_logged')) {
			return TRUE;
		}
		else{
			redirect('user/login');
		}
	}
	/**
	 * [显示提问页面]
	 * @return [view] [提问页面]
	 */
	public function view_add()
	{
		$data['view'] = 'add_question';
		$this->load->view('routes_view', $data);
	}
	/**
	 * [添加提问]
	 * @return [view] [主页面]
	 */
	public function add()
	{
		$this->form_validation->set_rules('title', '问题', 'trim|required|min_length[6]|xss_clean');
		$this->form_validation->set_rules('content', '问题内容', 'trim|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$data['view'] = 'add_question';
			
		}
		else{
			$question['user_id'] = $this->session->userdata('id');
			$question['title'] = $this->input->post('title');
			$question['content'] = $this->input->post('content');
			$question['create_time'] = time();
			$question['change_time'] = time();
			$question['reply_num'] = 0;
			if ($this->question_model->add_question($question)) {
				redirect('index');
			}
			else{
				$data['view'] = 'add_question';
			}
		}

		$this->load->view('routes_view', $data);
	}
	/**
	 * [显示问题详细信息页面]
	 * @param  [id] [问题id]
	 * @return [view] [详细信息页面]
	 */
	public function view_detail($id)
	{
		$data['question'] = $this->question_model->get_question_byId($id);
		$data['replys'] = $this->reply_model->get_reply_byQuestion($id);
		$data['view'] = 'detail';
		$this->load->view('routes_view', $data);
	}
	/**
	 * [删除问题]
	 * @param  [id] [问题id]
	 * @return [view] [首页页面]
	 */
	public function delete($id)
	{
		$question = $this->question_model->get_question_byId($id);
		if ($question->user_id == $this->session->userdata('id') || $this->session->userdata('is_admin')) {
			$this->question_model->delete_question($id);
		}
		redirect('index');
		
	}
	/**
	 * [显示问题编辑页面]
	 * @param  [id] [问题id]
	 * @return [view] [编辑问题页面]
	 */
	public function view_change($id)
	{
		$data['question'] = $this->question_model->get_question_byId($id);
		if ($data['question']->user_id == $this->session->userdata('id') || $this->session->userdata('is_admin')) {
			$data['view'] = 'change_question';
			$this->load->view('routes_view', $data);
		}
		else{
			redirect('index');
		}
	}
	/**
	 * [修改问题]
	 * @param  [id] [问题id]
	 * @return [view] [问题详细信息页面]
	 */
	public function change($id)
	{
		$query = $this->question_model->get_question_byId($id);
		if ($query->user_id == $this->session->userdata('id') || $this->session->userdata('is_admin')) {
			$this->form_validation->set_rules('title', '问题', 'trim|required|min_length[6]|xss_clean');
			$this->form_validation->set_rules('content', '问题内容', 'trim|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				redirect('question/view_change/'.$id);
				
			}
			else{
				$question['title'] = $this->input->post('title');
				$question['content'] = $this->input->post('content');
				$question['change_time'] = time();
				if ($this->question_model->change_question($id, $question)) {
					redirect('question/view_detail/'.$id);
				}
				else{
					redirect('question/view_change/'.$id);
				}
			}

			$this->load->view('routes_view', $data);
		}
		else{
			redirect('index');
		}
		
		
	}
}

/* End of file question.php */
/* Location: ./application/controllers/question.php */