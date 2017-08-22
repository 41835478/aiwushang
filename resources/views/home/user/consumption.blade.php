
<!DOCTYPE html>
<html>
<head>
<title>爱无尚</title>
 @include('home.public.header')
<style>
	body{
		background-color:#f5f5f5;
	}
</style>
</head>
<body>
<div class="reCastIntegral_top">
	<div class="public_head blue_head">
		<h3>消费积分</h3>
		<a href="javascript:history.go(-1);" class="iconfont icon-fanhui"></a>
	</div>
	<div class="rci_content">
		<div class="rci_msg">
			<div class="rci_top">
				<p class="act_p1">总积分</p>
				<p class="act_p2">688673</p>
			</div>
		</div>
	</div>
</div>

<!-- 内容区 -->
<div class="account_bottom">
	<ul class="account_nav">
		<li class="li_on">
			<i class="iconfont icon-shourulaiyuan"></i>
			<span>收入详情</span>
		</li>
		<li>
			<i class="iconfont icon-handcoins"></i>
			<span>支出详情</span>
		</li>
	</ul>
	
	<!-- income -->
	<div class="account_body account_income">
		<ul class="CP_income">
		
			 <li class="act_list">
				<img src="images/act_icon06.png" alt="">
				<div class="act_class">
					<p class="top_p">提现获得</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					+<span>30000</span>
				</div>
			</li> 
		</ul>
	</div>

	<!-- pay -->
	<div class="account_body account_pay" style="display:none">
		<ul class="CP_pay">
			 <li class="act_list">
				<img src="images/act_icon11.png" alt="">
				<div class="act_class">
					<p class="top_p">兑换商品</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					-<span>300</span>
				</div>
			</li> 
		</ul>
	</div>
</div>
<p class="account_p">没有更多内容了... ...</p>
<footer class="footer btn_foot account_foot">
	<a href="cancellation_integral.html" class="rci_btn" href="javascript:void(0);">去转账</a>
</footer>
<script>
	// for(var i=0; i<4; i++){
	// 	var _income =   '<li class="act_list">'
	// 				+		'<img src="images/act_icon06.png" +alt="">'
	// 				+		'<div class="act_class">'
	// 				+			'<p class="top_p">提现获得</p>'
	// 				+			'<p class="time">2017-03-22 12:35</p>'
	// 				+		'</div>'
	// 				+		'<div class="act_money">+<span>30000</span></div>'
	// 				+	'</li>';
	// 	$(".CP_income").append(_income);
	// }
	// for(var m=0; m<6; m++){
	// 	var _pay =   '<li class="act_list">'
	// 			+		'<img src="images/act_icon11.png" alt="">'
	// 			+		'<div class="act_class">'
	// 			+			'<p class="top_p">兑换商品</p>'
	// 			+			'<p class="time">2017-03-22 12:35</p>'
	// 			+		'</div>'
	// 			+		'<div class="act_money">-<span>300</span></div>'
	// 			+	'</li>';
	// 	$(".CP_pay").append(_pay);
	// }

	$(".account_nav li").click(function() {
		var _index = $(this).index();
		$(".account_nav li").removeClass('li_on');
		$(this).addClass('li_on');

		$(".account_body").css('display','none');
		$(".account_body").eq(_index).fadeIn(400);
	});
</script>
</body>
</html>