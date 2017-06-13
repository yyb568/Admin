<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 控制器基类
 * add by yyb5683@gmail.com
 * 2015年12月10日11:33:26
 */
if (ENVIRONMENT != 'product'){
	ini_set('memory_limit', '256M');
}
class MY_Controller extends CI_Controller{
	
	/**
	 * 常量变量定义
	 */
	public $template = array();			//模板数据
	protected $user_id;					//用户登陆id
	protected $username;				//用户账号
	protected $uname;					//姓名
	protected $userinfo;
	protected $parentmenuList;			// 当前用户权限下的父菜单
	protected $lastmenulist;			// 当前用户权限下的子菜单
	
	/**
	 * 初始化操作
	 * add by yyb5683@gmail.com
	 * 2015年12月10日11:34:15
	 */
	public function __construct(){
		parent::__construct();
		$this->isLogin();					// 检查登录状态
		$this->role();						//检查权限
	}
	
	/**
	 * 判断用户是否登陆
	 * add by yyb5683@gmail.com
	 * 2015年12月10日11:34:44
	 */
	public function isLogin(){
		$this->load->model("common_model");
		$this->load->library("Hencrypt");
		$userinfo = $this->input->cookie("adminer");
		if (empty($userinfo)){
			redirect(site_url("login/index"));
			exit();
		}
		if (stripos($userinfo,'@') === false){
			redirect(site_url("login/index"));
			exit();
		}
		$user_info = explode('@',$userinfo);
		$user = $this->hencrypt->decrypt($user_info[0]);
		unset($userinfo);
		$userinfo = explode("@",$user);
		if (empty($userinfo)){
			redirect(site_url("login/index"));
			exit();
		}
		//查询数据库是否存在
		$this->username = $userinfo[0];
		$this->user_id = $userinfo[1];
		$password = $user_info[1];
		$params = array(
				'table' => 'auth',
				'select' => 'id,uname,username,password',
				'where' => array('username' => $this->username),
				'limit' => 1
		);
		$info = $this->common_model->get_list($params);
		if (empty($info)){
			redirect(site_url("login/index"));
		}
		if ($this->hencrypt->decrypt($password) != $this->hencrypt->decrypt($info['password'])){
			redirect(site_url("login/index"));
		}
		$this->uname = $info['uname'];
		$this->userinfo = $info;
		return true;
	}
	
	/**
	 * 获取并检查权限
	 * add by yyb5683@gmail.com
	 * 2016年08月04日16:41:20
	 */
	private function role(){
		//根据user_id查询当前用户权限
		$params = array(
				'table' => 'auth',
				'select' => 'id,role',
				'where' => array('id' => $this->user_id),
				'limit' => 1
		);
		$this->load->model("common_model");
		$userRole = $this->common_model->get_list($params);
		if (empty($userRole)){
			redirect(site_url("login/index"));exit();
		}
		
		// 获取权限
		if ($userRole['role'] != -1){		//系统管理员
			$role = unserialize($userRole['role']);		//拿到当前用户的权限列表
		}
		unset($params);
		// 获取系统菜单
		$params = array(
				'table' => 'menu',
				'select' => 'id,menu_name,pid,url,icon,sortd',
				'order' => 'sortd',
				'order_type' => 'ASC',
				'where' => array('pid' =>0),
				'limit' => -1
		);
		$menuList = $this->common_model->get_list($params);
		
		//根据当前用户的权限，筛选出符合当前用户的系统菜单
		$menu = array();
		foreach($menuList as $key => $val){
			$menu[$val['id']] = $val;
		}
		$Menu = array();
		if ($userRole['role'] != -1){
			foreach($menu as $key => $val){
				if (in_array($val['id'],$role)){
					if ($val['pid'] == 0){
						$parentmenu[$val['id']] = $val;
					}
				}
			}
			// 根据找到的父分类，找对应的子分类
			$_pid = implode(",", $role);
			$sql = "select id,menu_name,url,pid from yb_menu where pid in ({$_pid})";
			$nums = $this->common_model->execute($sql);
			foreach($nums as $key => $val){
				if (in_array($val['id'], $role)){
					$lastmenu[$val['pid']][] = $val;
				}
			}
			
			
		}else{
			foreach($menu as $key => $val){
				if ($val['pid'] == 0){
					$sql = "select menu_name,url from yb_menu where pid={$val['id']}";
					$nums = $this->common_model->execute($sql);
					$parentmenu[$val['id']] = $val;
					$lastmenu[$val['id']] = $nums;
				}
			}
		}
		$this->parentmenuList = $parentmenu;
		$this->lastmenulist = $lastmenu;
		$this->template['parentmenuList'] = $parentmenu;
		$this->template['lastmenulist'] = $lastmenu;
	}
	
	/**
	 * 错误信息输出格式
	 * add by yyb5683@gmail.com
	 * 2015年12月25日21:33:39
	 */
	public function showMessage($info){
		$this->template['info'] = $info;
		$html = $this->load->view("error/error",$this->template,true);
		echo $html;die;
	}
	
	/**
	 * 统一的错误输出
	 * add by yyb5683@gmail.com
	 * 2015年12月10日15:49:53
	 */
	public function splitJson($json,$status = 0,$type = 0) {
		$array = array('status' => $status,'info' => $json);
		if (empty($type)){
			echo json_encode($array);exit();
		}else{
			return json_encode($array);
		}
	}
	
}