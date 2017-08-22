
<!DOCTYPE html>
<html>
<head>
<title>爱无尚</title>
 @include('home.public.header')
<style>
	body{
		background-color:#fff;
	}
	::-webkit-input-placeholder {
        color: #959595;font-size:14px
    } 
    :-moz-placeholder {
        color: #959595; font-size:14px
    } 
    ::-moz-placeholder {
        color: #959595; font-size:14px
    } 
    :-ms-input-placeholder {
        color: #959595; font-size:14px
    }
    .footer{
    	padding:0;
    	width:100%;
    	height:50px;
    	line-height: 50px;
    	border:0;
    }
</style>
</head>
<body>
<div class="public_head" style="background-color:#fff">
	<h3 style="color:#333">修改登录密码</h3>
	<a style="font-size:20px;color:#333" href="javascript:history.go(-1);" class="iconfont icon-you-copy"></a>
</div>
<div class="content" style="padding-bottom:68px">
	<ul class="modifyBox">
		<li class="modifylist">
			<i class="iconfont icon-shouji2"></i>
			<input type="text" placeholder="136****2209"/>
		</li>
		<li class="modifylist">
			<i class="iconfont icon-yanzhengyanzhengma"></i>
			<input type="text" placeholder="请输入短信验证码"/>
			<button id="fetchCode" type="button" class="modify_code">获取验证码</button>
		</li>
		<li class="modifylist">
			<i class="iconfont icon-mima1"></i>
			<input type="password" placeholder="请输入新密码"/>
		</li>
		<li class="modifylist">
			<i class="iconfont icon-mima1"></i>
			<input type="password" placeholder="请再次输入密码"/>
		</li>
	</ul>
</div>
<footer class="footer">
	<button type="button" class="edit_save">确认</button>
</footer>
<script type="text/javascript">
	var wait=60;
	function time(o) {
	    if (wait == 0) {
	            o.removeAttribute("disabled");
	            o.innerHTML="获取验证码";
	            wait = 60;
	        } else {
	            o.setAttribute("disabled", true);
	            o.innerHTML="重新发送(" + wait + ")";
	            wait--;
	            setTimeout(function() {
	            time(o)
	        }, 1000)
	    }
	}
	$("#fetchCode").on("touchend",function(){
		time(fetchCode);
	})
</script>
</body>
</html>