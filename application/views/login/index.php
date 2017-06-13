<?php $this->load->view("main/header");?>
<link href="<?=static_url("css")?>login.min.css" rel="stylesheet">
<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <form method="post" action="http://www.zi-han.net/theme/hplus/index.html">
                    <h4 class="no-margins">登录：</h4>
                    <p class="m-t-md">欢迎登录到系统管理后台</p>
                    <input type="text" name="username" id="username" class="form-control uname" placeholder="用户名" />
                    <input type="password" name="password" id="password" class="form-control pword m-b" placeholder="密码" />
                    <a href="#">忘记密码了？</a>
                    <button type="button" class="btn btn-success btn-block" onClick="doSubmit()">登录</button>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">
                &copy; <?=date("Y")?> 尹角大王
            </div>
        </div>
    </div>
</body>
<script src="<?=static_url("js")?>jquery.min.js" ></script>
<script src="<?=static_url("js")?>bootstrap.min.js" ></script>
<script src="<?=static_url("js") ?>plugins/toastr/toastr.min.js"></script>
<script src="<?=static_url("js")?>common.js" ></script>
<script>
function doSubmit(){
	var username = $("#username").val()
	var password = $("#password").val();
	if (!username || !password){showTips('请填写账号密码再登陆！','error');return false;}
	$.post("<?=site_url("login/isLogin")?>",{"username":username,password:password},function(data){
		if (data.status == 1){
			showTips(data.info,'error');
		}else{
			window.location.href = '<?=site_url("home/index")?>';
		}
	},'json');
}
</script>
</html>