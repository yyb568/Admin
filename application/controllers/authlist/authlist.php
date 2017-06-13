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
	public function index(){
		//查询后台管理员
		$params = array (
				'table' => 'auth',
				'select' => 'id,uname,username,phone,last_time',
				'limit' => -1
		);
		$list = $this->common_model->get_list($params);
		$params['total'] = true;
		$total = $this->common_model->get_list($params);
		$this->template['list'] = $list;
		$this->template['total'] = $total;
		$this->load->view("authlist/index",$this->template);
	}

}