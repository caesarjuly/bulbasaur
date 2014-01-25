<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 用户控制器
 */
class User extends CI_Controller {
	/**
	 * [__construct 构造函数]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->form_validation->set_error_delimiters('<div class="myError">', '</div>');
	}
	/**
	 * [管理员权限验证]
	 * @return [multi] [成功TRUE 失败跳转到登录页面]
	 */
	public function auth()
	{
		if ($this->session->userdata('is_logged') && $this->session->userdata('is_admin')) {
			return TRUE;
		}
		else{
			redirect('user/login');
		}
	}
	/**
	 * [普通用户权限验证]
	 * @return [multi] [成功TRUE 失败跳转到登录页面]
	 */
	public function user_auth()
	{
		if ($this->session->userdata('is_logged')) {
			return TRUE;
		}
		else{
			redirect('user/login');
		}
	}
	/**
	 * [用户注册]
	 * @return [view] [结果页面]
	 */
	public function register()
	{
		$this->form_validation->set_rules('username', '用户名', 'trim|required|max_length[45]|is_unique[user.username]');
		$this->form_validation->set_rules('password', '密码', 'trim|required|max_length[45]|xss_clean|sha1');
		if ($this->form_validation->run() == FALSE) {
			$data['view'] = 'register';
			
		}
		else{
			$user['username'] = $this->input->post('username');
			$user['password'] = $this->input->post('password');
			$user['name'] = $this->input->post('name');
			$user['major'] = $this->input->post('major');
			$user['class'] = $this->input->post('class');

			if ($this->user_model->add_user($user)) {

				$data['view'] = 'message';
				$data['message'] = '恭喜你！注册成功！';
				$data['url'] = 'user/login';
			}
			else{
				$data['view'] = 'register';
			}
		}

		$this->load->view('routes_view', $data);
	}
	/**
	 * [查看注册页面]
	 * @return [view] [注册页面]
	 */
	public function view_register()
	{

		$data['view'] = 'register';
		$this->load->view('routes_view', $data);

	}
	/**
	 * [用户登录]
	 * @return [view] [login页面或者主页]
	 */
	public function login()
	{
		if ($this->form_validation->run() == FALSE) {
			$data['view'] = 'login';
			
		}
		else{
			$user['username'] = $this->input->post('username');
			$user['password'] = $this->input->post('password');
			//print_r($user);
			if ($this->user_model->checkin($user)) {

				redirect('index');
			}
			else{
				$data['error'] = '用户名密码不匹配';
				$data['view'] = 'login';
			}
		}

		$this->load->view('routes_view', $data);

	}
	/**
	 * [用户登出]
	 * @return [view] [主页]
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('index');	

	}
	/**
	 * [用户管理]
	 * @return [view] [用户管理页面]
	 */
	public function manage($offset = '')
	{
		$this->auth();
		$limit = 10;
		$config['per_page'] = $limit;
		$config['base_url'] = site_url('user/manage');
		$config['total_rows'] = $this->user_model->count_user();
		
		$this->pagination->initialize($config);
		
		$data["users"] = $this->user_model->get_user($limit, $offset);
		$data["view"] = "manage_user";
		$this->load->view('routes_view', $data);
	}
	/**
	 * [查看添加用户页面]
	 * @return [view] [用户添加页面]
	 */
	public function view_add()
	{
		$this->auth();
		$data["view"] = "add_user";
		$this->load->view('routes_view', $data);
	}
	/**
	 * [添加用户]
	 * @return [view] [用户管理页面]
	 */
	public function add()
	{
		$this->auth();
		$this->form_validation->set_rules('username', '用户名', 'trim|required|max_length[45]|is_unique[user.username]');
		$this->form_validation->set_rules('password', '密码', 'trim|required|max_length[45]|xss_clean|sha1');
		$this->form_validation->set_rules('name', '姓名', 'trim|max_length[45]|xss_clean');
		$this->form_validation->set_rules('major', '专业', 'trim|max_length[45]|xss_clean');
		$this->form_validation->set_rules('class', '班级', 'trim|max_length[45]|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$data['view'] = 'add_user';
			
		}
		else{
			$user['username'] = $this->input->post('username');
			$user['password'] = $this->input->post('password');
			$user['name'] = $this->input->post('name');
			$user['major'] = $this->input->post('major');
			$user['class'] = $this->input->post('class');
			if ($this->user_model->add_user($user)) {
				redirect('user/manage');
			}
			else{
				$data['view'] = 'add_user';
			}
		}

		$this->load->view('routes_view', $data);
	}

	/**
	 * [删除用户]
	 * @param  [id] [用户id]
	 * @return [view] [用户管理页面]
	 */
	public function delete($id)
	{
		$this->auth();
		$this->user_model->delete_user($id);
		redirect('user/manage');
	}
	/**
	 * [查看编辑用户界面]
	 * @param  [id] [用户id]
	 * @return [view] [用户编辑页面]
	 */
	public function view_change($id)
	{
		$data['user'] = $this->user_model->get_user_byId($id);
		$data["view"] = "change_user";
		$this->load->view('routes_view', $data);
	}
	/**
	 * [管理员更新用户信息]
	 * @param  [id] [用户id]
	 * @return [view] [用户管理页面]
	 */
	public function change($id)
	{
		$this->auth();
		$this->form_validation->set_rules('username', '用户名', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('password', '密码', 'trim|max_length[45]|xss_clean|sha1');
		$this->form_validation->set_rules('name', '姓名', 'trim|max_length[45]|xss_clean');
		$this->form_validation->set_rules('major', '专业', 'trim|max_length[45]|xss_clean');
		$this->form_validation->set_rules('class', '班级', 'trim|max_length[45]|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$data['view'] = 'change_user';
			
		}
		else{
			if ($this->input->post('password')) {
				$user['password'] = $this->input->post('password');
			}
			$user['username'] = $this->input->post('username');
			$user['name'] = $this->input->post('name');
			$user['major'] = $this->input->post('major');
			$user['class'] = $this->input->post('class');
			//print_r($user);
			if ($this->user_model->change_user($id, $user)) {

				redirect('user/manage');
			}
			else{
				$data['view'] = 'change_user';
			}
		}

		$this->load->view('routes_view', $data);
	}
	/**
	 * [查看用户设置界面]
	 * @param  [id] [用户id]
	 * @return [view] [用户设置页面]
	 */
	public function view_set($id)
	{
		if ($id == $this->session->userdata('id')) {
			$data["view"] = "set_user";
			$data['user'] = $this->user_model->get_user_byId($id);
			$this->load->view('routes_view', $data);
		}
		else{
			redirect('index');
		}
		
	}
	
	/**
	 * [用户设置]
	 * @param  [id] [用户id]
	 * @return [view] [结果页面]
	 */
	public function set_user($id)
	{
		if ($id == $this->session->userdata('id')) {
			$this->form_validation->set_rules('username', '用户名', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('password', '密码', 'trim|max_length[45]|xss_clean|sha1');
			$this->form_validation->set_rules('name', '姓名', 'trim|max_length[45]|xss_clean');
			$this->form_validation->set_rules('major', '专业', 'trim|max_length[45]|xss_clean');
			$this->form_validation->set_rules('class', '班级', 'trim|max_length[45]|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				$data['view'] = 'set_user';
				
			}
			else{
				if ($this->input->post('password')) {
					$user['password'] = $this->input->post('password');
				}
				$user['username'] = $this->input->post('username');
				$user['name'] = $this->input->post('name');
				$user['major'] = $this->input->post('major');
				$user['class'] = $this->input->post('class');
				//print_r($user);
				if ($this->user_model->change_user($id, $user)) {

					$data['view'] = 'message';
					$data['message'] = '设置成功！';
					$data['url'] = 'index';
				}
				else{
					$data['view'] = 'set_user';
				}
			}

			$this->load->view('routes_view', $data);
		}
		else{
			redirect('index');
		}
		
	}
	/**
	 * [查看用户主页]
	 * @param  [id] [用户]
	 * @return [view] [用户主页]
	 */
	public function view_home($id)
	{
		$this->user_auth();
		$data['user'] = $this->user_model->get_user_byId($id);
		$data['questions'] = $this->question_model->get_question_byUser($id);
		$data['replys'] = $this->reply_model->get_reply_byUser($id);
		$data["view"] = "home";
		$this->load->view('routes_view', $data);
	}
	/**
	 * [查看用户问题主页]
	 * @param  [id] [用户]
	 * @return [view] [用户问题主页]
	 */
	public function more_question($id)
	{
		$this->user_auth();
		$data['user'] = $this->user_model->get_user_byId($id);
		$data['questions'] = $this->question_model->get_question_byUser($id);
		$data["view"] = "home_question";
		$this->load->view('routes_view', $data);
	}
	/**
	 * [查看用户回复主页]
	 * @param  [id] [用户]
	 * @return [view] [用户回复主页]
	 */
	public function more_reply($id)
	{
		$this->user_auth();
		$data['user'] = $this->user_model->get_user_byId($id);
		$data['replys'] = $this->reply_model->get_reply_byUser($id);
		$data["view"] = "home_reply";
		$this->load->view('routes_view', $data);
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */