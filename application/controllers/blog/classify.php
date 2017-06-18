<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 文章分类
 * add by yyb5683@gmail.com
 * 2017年6月18日13:09:47
 */
class Classify extends MY_Controller{
	
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
	 * 博客首页面
	 * add by  yyb5683@gmail.com
	 * 2017年6月18日10:41:25
	 */
	public function index($offset = 0){
		$pageSize = 20;
		//查询后台管理员
		$params = array (
				'table' => 'classify',
				'select' => 'id,aname,created',
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
		$this->load->view("blog/blogclassify/index",$this->template);
	}
	
	/**
	 * 添加文章分类
	 * add by  yyb5683@gmail.com
	 * 2017年6月18日12:46:15
	 */
	public function doAdd($user_id = 0){
		if (!empty($user_id)){
			$params = array(
					'table' => 'blog',
					'where' => array('id' => $user_id),
					'limit' => 1
			);
			$info = $this->common_model->get_list($params);
			$this->template['info'] = $info;
		}
		$this->load->view("blog/blogclassify/edit",$this->template);
	}
	
	/**
	 * 保存分类名称
	 * add by yyb5683@gmail.com
	 * 2017年6月18日13:21:58
	 */
	public function doSave($id = 0){
		$data['aname'] = $this->input->post('aname',true);
	    //基本信息判断
	    if (empty($data['aname'])){$this->splitJson('请填写分类名！',1);}
	    $data['created'] = time();
	    //准备入库
	    $this->common_model->set_table("classify");
	    $info_id = $this->common_model->save($data,$id);
	    
	    if (empty($info_id)){
	    	$this->splitJson('保存信息失败！',1);
	    }else{
	    	$this->splitJson('保存成功！',0);
	    }
	}
} 