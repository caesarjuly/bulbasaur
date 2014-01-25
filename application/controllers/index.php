<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 首页控制器
 */
class Index extends CI_Controller {
	/**
	 * [__construct 构造函数，载入model]
	 */
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * [默认函数，显示问题列表]
	 * @return [view] [index页面]
	 */
	public function index($offset = '')
	{
		$limit = 5;
		$config['per_page'] = $limit;
		$config['base_url'] = site_url('index/index');
		$config['total_rows'] = $this->question_model->count_question();
		
		$this->pagination->initialize($config);
		
		$data["questions"] = $this->question_model->get_question($limit, $offset);
		$data["view"] = "index";
		$this->load->view('routes_view', $data);
		
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */