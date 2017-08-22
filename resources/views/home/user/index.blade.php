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
<div class="center_head">
	<div class="div_clearFloat center_top">
		<img src="{{asset('home/images/portrait.png')}}" alt=""/>
		<div class="center_edit">
			<div class="div_clearFloat center_personalData">
				<p>Asdes</p>
				<span>[批发商]</span>
				<i onclick="javascript:window.location.href='editData.html'" class="iconfont icon-shape"></i>
			</div>
			<p>推荐人：随风  123****1236</p>
		</div>
	</div>
	<div class="div_clearFloat center_bot">
		<div class="center_money">
			<p>￥800.00</p>
			<span>账户余额(元)</span>
		</div>
		<div class="center_money">
			<p>30</p>
			<span>我的团队(人)</span>
		</div>
	</div>
</div>
<div class="content" style="padding-top:0">
	<div class="center_content">
		<div class="center_nav">
			<div class="div_clearFloat centerMyorder">
				<i class="iconfont icon-dingdan"></i>
				<span>我的订单</span>
			</div>
			<div class="div_displayFlex center_navCon">
				<a href="myOrder.html?type=1" class="a_jump">
					<img src="{{asset('home/images/center01.png')}}" alt=""/>
					<span>待付款</span>
				</a>
				<a href="myOrder.html?type=2" class="a_jump">
					<img src="{{asset('home/images/center02.png')}}" alt=""/>
					<span>待发货</span>
				</a>
				<a href="myOrder.html?type=3" class="a_jump">
					<img src="{{asset('home/images/center03.png')}}" alt=""/>
					<span>待收货</span>
				</a>
				<a href="myOrder.html?type=4" class="a_jump">
					<img src="{{asset('home/images/center04.png')}}" alt=""/>
					<span>已完成</span>
				</a>
			</div>
		</div>
		<ul class="centerList centerList3">
			<li class="centerItem">
				<a href="myAccount.html" class="a_jump">
					<img src="{{asset('home/images/person01.png')}}" alt=""/>
					<span>我的账户</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
			<li class="centerItem">
				<a href="myIntegral.html" class="a_jump">
					<img src="{{asset('home/images/person02.png')}}" alt=""/>
					<span>我的积分</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
			<li class="centerItem">
				<a href="myBonus.html" class="a_jump">
					<img src="{{asset('home/images/person03.png')}}" alt=""/>
					<span>我的奖金</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
		</ul>
		<ul class="centerList centerList1">
			<li class="centerItem">
				<a href="ranking_orders.html" class="a_jump">
					<img src="{{asset('home/images/person04.png')}}" alt=""/>
					<span>排位订单</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
		</ul>
		<ul class="centerList centerList2">
			<li class="centerItem">
				<a href="activeMemberorders.html" class="a_jump">
					<img src="{{asset('home/images/person05.png')}}" alt=""/>
					<span>激活会员订单</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
			<li class="centerItem">
				<a href="myTeam.html" class="a_jump">
					<img src="{{asset('home/images/person06.png')}}" alt=""/>
					<span>我的团队</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
		</ul>
		<ul class="centerList centerList2">
			<li class="centerItem">
				<a href="Account_binding.html" class="a_jump">
					<img src="{{asset('home/images/person07.png')}}" alt=""/>
					<span>账户绑定</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
			<li class="centerItem">
				<a href="shippingAddress.html" class="a_jump">
					<img src="{{asset('home/images/person08.png')}}" alt=""/>
					<span>收货地址</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
		</ul>
		<ul class="centerList centerList2">
			<li class="centerItem">
				<a href="javascript:void(0);" class="a_jump person_b">
					<img src="{{asset('home/images/person09.png')}}" alt=""/>
					<span>二维码</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
			<li class="centerItem">
				<a href="accountSettings.html" class="a_jump">
					<img src="{{asset('home/images/person10.png')}}" alt=""/>
					<span>账号设置</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
		</ul>
		<ul style="margin-bottom:0" class="centerList centerList1">
			<li class="centerItem">
				<a href="login.html" class="a_jump">
					<img src="{{asset('home/images/person13.png')}}" alt=""/>
					<span>退出</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
		</ul>
	</div>
</div>
<footer class="footer">
	
 @include('home.public.fooler')

</footer>
<script>
	$(".person_b").on("click",function(){
        addBox("body");
        outBox("需要消费成为会员才能查看二维码","QRcode.html");
     })
</script>
</body>
</html>