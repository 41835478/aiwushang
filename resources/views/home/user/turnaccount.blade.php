
<!DOCTYPE html>
<html>
<head>
<title>爱无尚</title>
<meta charset="utf-8"/>
<meta name="author" content="jbs"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=GBK"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<meta http-equiv="Expires" content="-1"/>
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta name="description" content="" />
<meta name="Keywords" content="" />
<link rel="stylesheet" href="{{asset('home/css/swiper.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('home/font/iconfont.css')}}"/>
<link rel="stylesheet" href="{{asset('home/css/common.css')}}"/>
<link rel="stylesheet" href="{{asset('home/css/fly.css')}}">
<script type="text/javascript" src="{{asset('home/js/swiper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('home/js/jquery-3.1.1.min.js')}}"></script>
<style>
	.public_head i{
		color: white;
	}
	body{
		background: #f5f5f5;
	}
	.present_ban{
		margin-top: 7px;
		background: white;
		height: 123px;
		border-bottom: 1px #f5f5f5 solid;
	}
	.present_ban p {
	    font-size: 40px;
	    color: #666666;
	    line-height: 0px;
	    float: left;
	    margin-top: 49px;
	}
	.present_cont{
		background: white;
	}
</style>
</head>
<body>
<div class="public_head">
	<h3>余额转账</h3>
	<a href="javascript:history.go(-1);" class="iconfont icon-fanhui"></a>
</div>
<!-- 内容区 -->
<div class="content">
	<div class="cancell_ban">
		<div class="cancell_bano">
			<p>好友账号</p>
			<input type="text" />
		</div>
	</div>
	<div class="present_ban">
		<em class="cancell_po">转账金额</em>
	    <div class="present_bann">
			<p>￥</p>
			<input type="number"/>
		</div>
	</div>
	<div class="present_cont">
		<div class="present_conto">
			<p>可用余额<span>￥{{$users['account']}}</span></p>
		</div>
	</div>
	<div class="cancell_cont">
		<div class="cancell_conto">
			<p>注：转账最低金额为50元</p>
		</div>
	</div>
	<div class="present_foot">
		<input type="button" onclick="window.location.href='myAccount.html'" value="确认转账" class="present_btn">
	</div>
</div>
</body>
</html>