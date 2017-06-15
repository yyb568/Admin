<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 后台管理首页
 * add by yyb5683@gmail.com
 * 2017年6月12日16:31:04
 */
class Authlist extends MY_Controller{
	/**
	 * 初始化
	 * add by yyb5683@gmail.com
	 * 2017年6月12日16:32:00
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model("common_model");
	}

	/**
	 * 管理首页面
	 * add by  yyb5683@gmail.com
	 * 2017年6月12日16:32:21
	 */
	public function index($offset = 0){
		$pageSize = 20;
		//查询后台管理员
		$params = array (
				'table' => 'auth',
				'select' => 'id,uname,username,phone,last_time',
				'offset' => $offset,
				'limit' => $pageSize,
		);
		$list = $this->common_model->get_list($params);
		$params['total'] = true;
		$total = $this->common_model->get_list($params);
		
		$this->load->library('pagination');					// 分页类库加载
		
		$config['base_url'] = site_url("authlist/authlist/index/{page}");
		$config['total_rows'] = $total;
		$config['per_page'] = $pageSize;
		$config['uri_segment'] = 3;
		$config['num_links'] = 6;
		$config['cur_tag_open'] = '<li class="paginate_button active">';
		$config['cur_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		$pageStr = $this->pagination->create_links();
		$this->template['Page'] = '<ul class="pagination ">'.rtrim($pageStr,"/").'</ul>';
		
		
		
		$this->template['list'] = $list;
		$this->template['total'] = $total;
		$this->load->view("authlist/index",$this->template);
	}
	
	/**
	 * 管理首页面
	 * add by  yyb5683@gmail.com
	 * 2017年6月15日10:43:21
	 */
	public function lockInfo($id = 0){
		if (empty($id)){$this->showMessage('无效的ID属性值！');}
		$params = array (
				'table' => 'auth',
				'where' => array ('id' => $id),
				'limit' => 1
		);
		$info = $this->common_model->get_list($params);
 		$this->template['info'] = $info;
 		$this->load->view("authlist/info",$this->template);
	}
	
	/**
	 * 编辑/添加管理员
	 * add by yyb5683@gmail.com
	 * 2017年6月15日20:49:44
	 */
	public function doAdd($user_id = 0){
		if (!empty($user_id)){
			$params = array(
					'table' => 'users',
					'where' => array('id' => $user_id),
					'limit' => 1
			);
			$info = $this->common_model->get_list($params);
			$this->template['info'] = $info;
		}
		$this->load->view("authlist/edit",$this->template);
	}
}