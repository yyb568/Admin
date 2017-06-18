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
                        <h5>文章列表</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>标题</th>
                                    <th>所属分类</th>
                                    <th>是否发表</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php foreach ((array)$list as $key => $val){?>
                                <tr>
                                    <td><?=$val['titles'] ?></td>
                                    <td> <?=$ClassList[$val['id']]['aname']?></td>
                                    <td><?php if ($val['status'] == 1){?>
                                    	未发表
                                    	<?php }else{?>
                                    	已发表
                                    	<?php }?>
                                    </td>
                                    <td class="text-navy"><?=date("Y-m-d h:i:s",$val['created'])?></td>
                                    <td>
                                      	<div class="btn-group">
				                           <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" aria-expanded="false">操作 <span class="caret"></span></button>
				                             <ul class="dropdown-menu">
				                                <li><a href="javascript:void(0);LockInfo(<?=$val['id']?>);" class="font-bold">查看详情</a></li>
			                                	<li class="divider"></li>
			                                    <li><a href="javascript:void(0);Edit(<?=$val['id']?>);" class="font-bold">编辑</a></li>
			                                    <li class="divider"></li>
			                                    <li><a href="javascript:void(0);Del(<?=$val['id']?>);">删除</a></li>
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
	showFarme('新增文章','<?=site_url("blog/blog/doAdd")?>','80%','90%');
}
//编辑
function Edit(id){
	showFarme('编辑文章','<?=site_url("blog/blog/doAdd")?>/'+id,'80%','90%');
}
//删除
function Del(group_id){
	layer.confirm('您确定要删除吗', {
	    btn: ['确定','取消'] //按钮
	}, function(){
		$.get("<?=site_url("blog/blog/DelInfo") ?>/"+group_id,function(data){
			if (data.status == 1){
				showTips(data.info,'error');
			}else{
				showTips('删除成功！','success');
				setTimeout(function(){window.location.reload();},1000);
			}
		},'json');
	});
}
</script>
</body>
</html>
