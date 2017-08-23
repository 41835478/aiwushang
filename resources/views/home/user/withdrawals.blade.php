
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
<script type="text/javascript" src="js/swiper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('home/js/jquery-3.1.1.min.js')}}"></script>





<style>
	.public_head i{
		color: white;
	}
</style>
</head>
<body>
<div class="public_head">
	<h3>提现申请</h3>
	<a href="javascript:history.go(-1);" class="iconfont icon-fanhui"></a>
    <i onclick="javascript:window.location.href='Cash_register.html'" class="iconfont icon-tixianjilu"></i> 
</div>
<!-- 内容区 -->
<div class="content">
	<div class="present_ban">
	    <div class="present_bann">
			<p>￥</p>
			<input type="number" placeholder="请输入提现金额" onfocus="this.placeholder = ''" onblur="if(this.placeholder == ''){this.placeholder = '请输入提现金额'}">
		</div>
		<em>注：最低提现额度为50元，预留20%进入复投积分，预留10%进入消费积分</em>
	</div>
	<div class="present_boxx"></div>
	<div class="present_cont">
		<div class="present_conto">
			<p>可用余额<span>￥{{$users['account']}}</span></p>
		</div>
	</div>
	<div class="present_main">
		<div class="present_maino">
			<p>提现方式</p>
			<i class="iconfont icon-xiala"></i>
		</div>
	</div>
	<div class="present_toggle">
		<div class="present_cent">
			<div class="present_centt present_cen">
				<i class="iconfont icon-weixin"></i>
				<p>微信</p>
				<i class="present_i iconfont icon-not_selected icon-xuanzhong1"></i>
			</div>	
		</div>
		<div class="present_cent">
			<div class="present_centt present_cen">
				<i class="iconfont icon-zhifubao"></i>
				<p>支付宝</p>
				<i class="present_i iconfont icon-not_selected"></i>
			</div>	
		</div>
		<div onclick="javascript:window.location.href='Choose_bnak.html'" class="present_cent">
			<div class="present_centt">
				<i class="iconfont icon-yinhangqia"></i>
				<p>银行卡</p>
				<i class="present_i iconfont icon-iconfontright"></i>
			</div>	
		</div>	
	</div>
	<div class="present_foot">
		<input onclick="javascript:window.location.href='Cash_register.html'" type="button" value="确认提现" class="present_btn">
	</div>
</div>
<script>
	$(".present_cen").on("click", function (){
      $(".present_cen").find('.present_i').removeClass('icon-xuanzhong1');
      $(this).find('.present_i').addClass("icon-xuanzhong1");
      var box = $(this);
      var index = goIndex(box);
   });
   function goIndex(it) {
      var big = it.parent();
      for (var i = 0; i < big.children().length; i++) {
          if (big.children().eq(i)[0] == it[0]) {
              return i;
          }
       }
    };
    $(".present_maino").on("click",function(){
    	$(this).find("i").toggleClass("icon-shang")
    	$(".present_toggle").slideToggle();
    })
</script>
</body>
</html>