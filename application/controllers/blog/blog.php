<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 我的博客
 * add by yyb5683@gmail.com
 * 2017年6月18日10:40:38
 */
class Blog extends MY_Controller{
	
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
				'table' => 'blog',
				'select' => 'id,classify,titles,user_id,content,img,created,status',
				'offset' => $offset,
				'limit' => $pageSize,
		);
		$list = $this->common_model->get_list($params);
		$params['total'] = true;
		$total = $this->common_model->get_list($params);
		//查询文章分类
		$ClassList = $this->common_model->get_Classification();
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
	
	
	 	$this->template['ClassList'] = $ClassList;
		$this->template['list'] = $list;
		$this->template['total'] = $total;
		$this->load->view("blog/index",$this->template);
	}
	
	/**
	 * 添加文章
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
		//查询文章分类
		$ClassList = $this->common_model->get_Classification();
		$this->template['list'] = $ClassList;
		$this->load->view("blog/edit",$this->template);
	}
	
	/**
	 * 保存文章
	 * add by  yyb5683@gmail.com
	 * 2017年6月18日14:25:46
	 */
	public function doSave($user_id = 0){
		$data['titles'] = $this->input->post('titles',true);
	    $data['classify']  = $this->input->post('classify',true);
	    $data['status']  = $this->input->post('status',true);
	    $data['content'] = $this->input->post('msg',true);
	    //基本信息判断
	    if (empty($data['titles'])){$this->splitJson('请填文章标题！',1);}
	    if (empty($data['classify'])){$this->splitJson('请选择文章分类！',1);}
	    if (empty($data['content'])){$this->splitJson('请填写文章内容！',1);}
	    
	    $data['user_id'] = $this->user_id;
	    $data['created'] = time();
	    //准备入库
	    $this->common_model->set_table("blog");
	    $info_id = $this->common_model->save($data,$user_id);
	    if (empty($info_id)){
	    	$this->splitJson('保存信息失败！',1);
	    }else{
	    	$this->splitJson('保存成功！',0);
	    }
	}
	
	/**
	 * 删除文章
	 * add by yyb5683@gmail.com
	 * 2017年2月16日15:58:14
	 */
	public function DelInfo($id){
		if (empty($id)){$this->splitJson('无效的ID属性值！',1);}
		$this->common_model->set_table("blog");
		$info_id = $this->common_model->delById($id);
		if (empty($info_id)){
			$this->splitJson('删除失败！',1);
		}else{
			$this->splitJson('删除成功！',0);
		}
	}
} 