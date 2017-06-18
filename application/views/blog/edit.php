<?php $this->load->view("main/header"); ?>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form method="get" class="form-horizontal" id="form1" name="form1">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">文章标题：</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="titles" id="titles" value="<?=$info['titles']?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">文章分类：</label>
                                <div class="col-sm-4">
                                	<select class="form-control m-b" name="classify" id="classify">
                                        <option>请选择</option>
                                    	<?php foreach($list as $key => $val){?>
                                        <option value="<?=$val['id']?>" <?php if ($info['classify'] == $val['id']){echo 'selected';}?>><?=$val['aname']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">是否发表：</label>
                                <div class="col-sm-2">
                                	<div class="radio">
                                        <label>
                                            <input type="radio"  value="1" id="status" name="status" <?php if ($info['status'] == 1){echo 'checked';}?>>NO</label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="2" id="status" name="status" <?php if ($info['status'] == 2){echo 'checked';}?>>YES</label>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                             <div class="form-group">
                            <label class="col-sm-2 control-label">文章内容：</label>
                            <div class="col-sm-10">
                                <textarea name="msg" id="msg" style="width:700px;;height:300px;"><?=$info['content']?></textarea>
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="button" onClick="doSubmit();">保存信息</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
    </div>
<?php $this->load->view("main/footer");?>
<script src="<?=static_url("js")?>kindeditor/kindeditor-min.js"></script>
<script>
var editor
KindEditor.ready(function(K) {
    editor = K.create('textarea[name="msg"]', {
        resizeType : 1,
        allowPreviewEmoticons : false,	//表情预览
        allowImageUpload : true,
        allowFileManager:true,
        fileManagerJson : '<?=site_url("manager/fileList")?>?dir=image',
        uploadJson:'<?=site_url("_up/upload")?>?path=/uploads/picture&dir=image',
        syncType:'',
        afterChange: function (e) {
            editor.sync("msg");//同步数据
        },
        filterMode:true,
    });
});


//保存配置信息
function doSubmit(){
	$.post("<?=site_url("blog/blog/doSave/{$info['id']}")?>",$("#form1").serialize(),function(data){
		if (data.status == 0){
			showTips('保存成功！','success','',1);
			setTimeout(function(){
				window.parent.location.reload();
			},1000);
		}else{
			showTips(data.info,'','',1);
		}
	},'json');
}
</script>