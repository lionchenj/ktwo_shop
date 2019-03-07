<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    
<head>
        <title><?php echo C('WEB_SITE_TITLE');?></title><meta charset="UTF-8" />
        <meta name="apple-mobile-web-app-capable" content="yes"/><!-- 是否启用 WebApp 全屏模式 -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/><!-- 设置状态栏的背景颜色 -->
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no"/><!-- 禁止数字识自动别为电话号码 --><!-- 不让android识别邮箱 -->
		<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="/zhouzf/www/tcm/template/Maruti/css/maruti-login.css" />
    </head>
    <body>
        <div id="logo">
            <img src="/zhouzf/www/tcm/template/Maruti/img/login-logo.png" alt="" />
        </div>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="/zhouzf/www/tcm/login.html">
				 <div class="control-group normal_text"><h3>锦丰商城管理系统</h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input name="username" type="text" placeholder="用户名" />
                        </div>
						<error></error>
                    </div>
					
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><input name="password" type="password" placeholder="密码" />
                        </div>
						<error></error>
                    </div>
					
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="javascript:;" class="flip-link btn btn-warning" id="to-recover">忘记密码?</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-success" value="登录" /></span>
                </div>
            </form>
            <form id="recoverform" action="<?php echo U('retrieval');?>" class="form-vertical">
				<p class="normal_text">请在下面输出账号绑定的邮箱地址我们将<br/><font color="#FF6633">新的密码发送给您.</font></p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" name="email" placeholder="邮箱地址" />
                        </div>
						<error></error>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="javascript:;" class="flip-link btn btn-warning" id="to-login">&laquo; 重新登录</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-info" value="确认" /></span>
                </div>
            </form>
			<form id="returnform" action="javasrcipt" class="form-vertical">
				<p class="normal_text">温馨提示</p>
				
                    <div class="controls">
                       找回密码成功！请查收邮件！
                    </div>
               
                <div class="form-actions">
                    <span class="pull-right"><input type="botton" onclick="location.reload();" class="btn btn-info" value="确认" /></span>
                </div>
            </form>
        </div>
        
        <script src="/zhouzf/www/tcm/template/Maruti/js/jquery.min.js"></script>  
        <script src="/zhouzf/www/tcm/template/Maruti/js/maruti.login.js"></script> 
    </body>
</html>