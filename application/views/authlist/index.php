<?php $this->load->view("main/header");?>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
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
                    </div>
                </div>
        </div>
 </div>
<?php $this->load->view("main/footer")?>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>
</html>
