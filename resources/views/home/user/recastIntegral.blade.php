
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
		<h3>复投积分</h3>
		<a href="myIntegral.html" class="iconfont icon-fanhui"></a>
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
		<ul>
			<li class="act_list">
				<img src="{{asset('home/images/act_icon06.png')}}" alt="">
				<div class="act_class">
					<p class="top_p">提现获得</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					+<span>30000</span>
				</div>
			</li>
			<li class="act_list">
				<img src="{{asset('home/images/act_icon05.png')}}" alt="">
				<div class="act_class">
					<p class="top_p">波妞——转账</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_state">
					交易成功
				</div>
				<div class="act_money act_money1">
					+<span>20000</span>
				</div>
			</li>
		</ul>
	</div>

	<!-- pay -->
	<div class="account_body account_pay" style="display:none">
		<ul>
			<li class="act_list">
				<img src="{{asset('home/images/act_icon10.png')}}" alt="">
				<div class="act_class">
					<p class="top_p">复投消费</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					-<span>300</span>
				</div>
			</li>
			<li class="act_list">
				<img src="{{asset('home/images/act_icon01.png')}}" alt="">
				<div class="act_class">
					<p class="top_p">激活下级</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					-<span>100</span>
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
	$(".account_nav li").click(function() {
		var _index = $(this).index();
		$(".account_nav li").removeClass('li_on');
		$(this).addClass('li_on');

		$(".account_body").css('display','none');
		$(".account_body").eq(_index).fadeIn(600);
	});
</script>
</body>
</html>