<!DOCTYPE html>
<html>
<head>
<title>爱无尚</title>
 @include('home.public.header')
<style>
	body{
		background-color:#f5f5f5;
	}
	.blue_head{
		background: none;
	}
</style>
</head>
<body>
<div class="myAccount_top">
	<div class="header">
		<h3>我的账户</h3>
		<a href="personalCenter.html" class="iconfont icon-fanhui"></a>
	</div>
	<div class="account_msg">
		<img class="account_star1" src="images/account01.png" alt="">
		<img class="account_img" src="images/account02.png" alt="">
		<img class="account_star2" src="images/account01.png" alt="">
		<p class="act_p1">(总金额)</p>
		<p class="act_p2">¥<span>6886.73</span></p>
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
				<img src="images/act_icon01.png" alt="">
				<div class="act_class">
					<p class="top_p">下层升级费</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					+¥<span>300.00</span>
				</div>
			</li>
			<li class="act_list">
				<img src="images/act_icon02.png" alt="">
				<div class="act_class">
					<p class="top_p">分销奖</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					+¥<span>88.00</span>
				</div>
			</li>
			<li class="act_list">
				<img src="images/act_icon05.png" alt="">
				<div class="act_class">
					<p class="top_p">波妞——转账</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_state">
					交易成功
				</div>
				<div class="act_money act_money1">
					+¥<span>200.00</span>
				</div>
			</li>
			<li class="act_list">
				<img src="images/act_icon03.png" alt="">
				<div class="act_class">
					<p class="top_p">见点奖</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					+¥<span>8.00</span>
				</div>
			</li>
			<li class="act_list">
				<img src="images/act_icon04.png" alt="">
				<div class="act_class">
					<p class="top_p">大转盘</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					+¥<span>2.00</span>
				</div>
			</li>
		</ul>
	</div>

	<!-- pay -->
	<div class="account_body account_pay" style="display:none">
		<ul>
			<li class="act_list">
				<img src="images/act_icon06.png" alt="">
				<div class="act_class">
					<p class="top_p">余额提现</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_state">
					交易成功
				</div>
				<div class="act_money act_money1">
					-¥<span>300.00</span>
				</div>
			</li>
			<li class="act_list">
				<img src="images/act_icon07.png" alt="">
				<div class="act_class">
					<p class="top_p">购物消费</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					-¥<span>88.00</span>
				</div>
			</li>
			<li class="act_list">
				<img src="images/act_icon08.png" alt="">
				<div class="act_class">
					<p class="top_p">宗介——转账</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_state">
					交易成功
				</div>
				<div class="act_money act_money1">
					-¥<span>200.00</span>
				</div>
			</li>
			<li class="act_list">
				<img src="images/act_icon09.png" alt="">
				<div class="act_class">
					<p class="top_p">点位升级</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					-¥<span>8.00</span>
				</div>
			</li>
			<li class="act_list">
				<img src="images/act_icon10.png" alt="">
				<div class="act_class">
					<p class="top_p">复投消费</p>
					<p class="time">2017-03-22 12:35</p>
				</div>
				<div class="act_money">
					-¥<span>2.00</span>
				</div>
			</li>
		</ul>
	</div>
</div>
<p class="account_p">没有更多内容了... ...</p>
<footer class="footer btn_foot account_foot">
	<button value="1" class="btn1" type="button">去转账</button>
	<button value="2" class="btn2" type="button">立即提现</button>
</footer>


<div class="tan_box" style="display:none">
	<div class="tan_body">
		<p class="tan_p1">提示</p>
		<p class="tan_p2">达到要求方可进行提现和好友互转操作。</p>
		<div class="tan_btn_box">
			<button class="tan_btn1" type="button">取消</button>
			<button class="tan_btn2" type="button">确定</button>
		</div>
	</div>
</div>
<script>
	$(".account_nav li").click(function() {
		var _index = $(this).index();
		$(".account_nav li").removeClass('li_on');
		$(this).addClass('li_on');

		$(".account_body").css('display','none');
		$(".account_body").eq(_index).fadeIn(600);
	});

	$(".account_foot button").click(function() {
		$(".tan_box").fadeIn('fast');
		var val = $(this).val();
		console.log(val);
		if(val == 1){
			$('.tan_btn2').on("click",function(){
				window.location.href = "cancellation_balance.html";
			})
		}else if(val == 2){
			$('.tan_btn2').on("click",function(){
				window.location.href = "presentApplication.html";
			})
		}

	});

	$(".tan_box").find(".tan_btn1").click(function() {
		$(".tan_box").fadeOut('fast');
	});
	$(".tan_box").find(".tan_btn2").click(function() {
		$(".tan_box").fadeOut('fast');
	});
</script>
</body>
</html>