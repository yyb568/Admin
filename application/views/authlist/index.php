<?php $this->load->view("main/header");?>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
     <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                	<button class="btn btn-danger " type="button" onClick="addNew();"><i class="fa fa-check"></i>&nbsp;新增</button>
					<button class="btn btn-primary " type="button" onClick="SearchTime();"><i class="fa fa-paste"></i>&nbsp;查询条件</button>
					<button class="btn btn-success " type="button" onClick="window.location.reload();"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;刷新页面</button>
					
                </div>
            </div>
        </div>
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>管理员列表</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                	<th>登录账号</th>
                                    <th>用户</th>
                                    <th>手机号</th>
                                    <th>最后登录时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php foreach ((array)$list as $key => $val){?>
                                <tr>
                                    <td><?=$val['username'] ?></td>
                                    <td><span class="line"><?=$val['uname'] ?></span></td>
                                    <td><?=$val['phone'] ?></td>
                                    <td class="text-navy"><?=date("Y-m-d h:i:s",$val['last_time'])?></td>
                                    <td>
                                      	<div class="btn-group">
				                           <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" aria-expanded="false">操作 <span class="caret"></span></button>
				                             <ul class="dropdown-menu">
				                                <li><a href="javascript:void(0);LockInfo(<?=$val['id']?>);" class="font-bold">查看详情</a></li>
			                                	<li class="divider"></li>
			                                    <li><a href="javascript:void(0);Edit(<?=$val['id']?>);" class="font-bold">编辑</a></li>
			                                    <?php if ($val['status'] == 0){ 		// 只有0的时候才能删除?>
			                                    <li class="divider"></li>
			                                    <li><a href="javascript:void(0);Del(<?=$val['id']?>);">删除</a></li>
			                                    <?php } ?>
	                                		</ul>
	                            		</div>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                         <?=$Page; ?>
                    </div>
                </div>
        </div>
 </div>
<?php $this->load->view("main/footer")?>
<script>
//新增
function addNew(){
	showFarme('新增管理员','<?=site_url("authlist/authlist/doAdd")?>','80%','90%');
}
//详情
function LockInfo(id){
	showFarme('管理员详细资料','<?=site_url("authlist/authlist/lockInfo")?>/'+id,'80%','90%');
}
//编辑
function Edit(id){
	showFarme('管理员详细资料','<?=site_url("authlist/authlist/Edit")?>/'+id,'80%','90%');
}
//删除
function Del(id){
	showFarme('管理员详细资料','<?=site_url("authlist/authlist/Del")?>/'+id,'80%','90%');
}
</script>
</body>
</html>
