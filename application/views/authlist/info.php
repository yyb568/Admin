<?php $this->load->view("main/header"); ?>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form method="get" class="form-horizontal" id="form1" name="form1">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">登录账号：</label>
                                <div class="col-sm-4">
                                	<?=$info['username']?>	
                                </div>
                            </div>
	                       <div class="hr-line-dashed"></div>
	                            <div class="form-group">
	                                <label class="col-sm-2 control-label">姓名：</label>
	                                <div class="col-sm-4">
	                                    <?=$info['uname']?>
	                                </div>
	                            </div>
	                        <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">手机号：</label>
                                <div class="col-sm-4">
                                	<?=$info['phone']?>	
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">状态：</label>
                                <div class="col-sm-2">
                                	<?php if ($info['status'] == 0){echo '<font color=red>冻结</font>';}else{echo '<font color=green>正常</font>';} ?>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">最后登录时间：</label>
                                <div class="col-sm-2">
                                	<?php if($info['last_time'] == 0){?>
                                		用户从未登录
                                	<?php }else{?>
                                		<?=date("Y-m-d H:i:s",$info['last_time'])?>
                                	<?php }?>
                                </div>
                            </div>
                             <div class="hr-line-dashed"></div>
                             <div class="form-group">
                                <label class="col-sm-2 control-label">最后登录ip：</label>
                                <div class="col-sm-2">
                                	<?=$info['last_ip']?>	
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("main/footer");?>
