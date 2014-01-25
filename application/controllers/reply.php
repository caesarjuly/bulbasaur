<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 回复控制器
 */
class Reply extends CI_Controller {
	/**
	 * [__construct 构造函数，载入model]
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
	 * [添加回复]
	 * @param  [id] [问题id]
	 * @return [view] [问题页面]
	 */
	public function add($id)
	{
		$this->form_validation->set_rules('content', '回复内容', 'trim|required|min_length[6]|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			redirect('question/view_detail/'.$id);
			
		}
		else{
			$reply['content'] = $this->input->post('content');
			$reply['user_id'] = $this->session->userdata('id');
			$reply['create_time'] = time();
			$reply['change_time'] = time();
			$reply['question_id'] = $id;
			$this->reply_model->add_reply($reply);
		}
		redirect('question/view_detail/'.$id);
	}
	/**
	 * [删除回复]
	 * @param  [id] [回复id]
	 * @return [view] [question信息页面]
	 */
	public function delete($reply_id, $question_id)
	{
		$reply = $this->reply_model->get_reply_byId($reply_id);
		if ($reply->user_id == $this->session->userdata('id') || $this->session->userdata('is_admin')) {
			$this->reply_model->delete_reply($reply_id, $question_id);
			redirect('question/view_detail/'.$question_id);
		}
		else{
			redirect('index');
		}
	}
	/**
	 * [显示回复编辑页面]
	 * @param  [id] [回复id]
	 * @return [view] [编辑回复页面]
	 */
	public function view_change($id)
	{
		$data['reply'] = $this->reply_model->get_reply_byId($id);
		if ($data['reply']->user_id == $this->session->userdata('id') || $this->session->userdata('is_admin')) {
			$data['view'] = 'change_reply';
			$this->load->view('routes_view', $data);
		}
		else{
			redirect('index');
		}
	}
	/**
	 * [修改回复]
	 * @param  [id] [回复id]
	 * @return [view] [问题详细信息页面]
	 */
	public function change($id)
	{
		$query = $this->reply_model->get_reply_byId($id);
		if ($query->user_id == $this->session->userdata('id') || $this->session->userdata('is_admin')) {
			$this->form_validation->set_rules('content', '回复内容', 'trim|required|min_length[6]|xss_clean');
			$query = $this->reply_model->get_reply_byId($id);
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'change_reply';			
			}
			else{
				$reply['content'] = $this->input->post('content');
				$reply['change_time'] = time();
				if ($this->reply_model->change_reply($id, $reply)) {
					redirect('question/view_detail/'.$query->question_id);
				}
				else{
					$data['view'] = 'change_reply';
				}
			}

			$this->load->view('routes_view', $data);
		}
		else{
			redirect('index');
		}
		
	}
}

/* End of file reply.php */
/* Location: ./application/controllers/reply.php */