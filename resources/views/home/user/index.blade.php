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
		@if($users['pic']=='')
			
			<img src="{{asset('home/images/rank05.png')}}" alt=""/>
		@else
		<img src="{{$users['pic']}}" alt=""/>
		@endif
		
		<div class="center_edit">
			<div class="div_clearFloat center_personalData">
				<p>{{$users['name']}} </p>
				<span>@if($users['level'] ==1  ) 批发商
						@elseif($users['level'] == 0) 游客
						@endif
				</span>
				<i onclick="javascript:window.location.href='editData.html'" class="iconfont icon-shape"></i>
			</div>
			<p>推荐人：@if($pusers =='') 无
						@elseif($pusers !=''){{$pusers['name']}}  {{$pusers['phone']}}
						@endif
			</p>
		</div>
	</div>
	<div class="div_clearFloat center_bot">
		<div class="center_money">
			<p>￥{{$users['account']}}</p>
			<span>账户余额(元)</span>
		</div>
		<div class="center_money">
			<p>{{$count}}</p>
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
				<a href="{{url('users/userorder',['type'=>1])}}" class="a_jump">
					<img src="{{asset('home/images/center01.png')}}" alt=""/>
					<span>待付款</span>
				</a>
				<a href="/users/userorder?type=1" class="a_jump">
					<img src="{{asset('home/images/center02.png')}}" alt=""/>
					<span>待发货</span>
				</a>
				<a href="{{url('users/userorder',['type'=>3])}}" class="a_jump">
					<img src="{{asset('home/images/center03.png')}}" alt=""/>
					<span>待收货</span>
				</a>
				<a href="{{url('users/userorder',['type'=>4])}}" class="a_jump">
					<img src="{{asset('home/images/center04.png')}}" alt=""/>
					<span>已完成</span>
				</a>
			</div>
		</div>
		<ul class="centerList centerList3">
			<li class="centerItem">
				<a href="{{url('users/myaccount')}}" class="a_jump">
					<img src="{{asset('home/images/person01.png')}}" alt=""/>
					<span>我的账户</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
			<li class="centerItem">
				<a href="{{url('users/myintegral')}}" class="a_jump">
					<img src="{{asset('home/images/person02.png')}}" alt=""/>
					<span>我的积分</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
			<li class="centerItem">
				<a href="{{url('users/mybonus')}}" class="a_jump">
					<img src="{{asset('home/images/person03.png')}}" alt=""/>
					<span>我的奖金</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
		</ul>
		<ul class="centerList centerList1">
			<li class="centerItem">
				<a href="{{url('users/ranking_orders')}}" class="a_jump">
					<img src="{{asset('home/images/person04.png')}}" alt=""/>
					<span>排位订单</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
		</ul>
		<ul class="centerList centerList2">
			<li class="centerItem">
				<a href="{{url('users/activememberorders')}}" class="a_jump">
					<img src="{{asset('home/images/person05.png')}}" alt=""/>
					<span>激活会员订单</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
			<li class="centerItem">
				<a href="{{url('users/myteam')}}" class="a_jump">
					<img src="{{asset('home/images/person06.png')}}" alt=""/>
					<span>我的团队</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
		</ul>
		<ul class="centerList centerList2">
			<li class="centerItem">
				<a href="{{url('users/accountbinding')}}" class="a_jump">
					<img src="{{asset('home/images/person07.png')}}" alt=""/>
					<span>账户绑定</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
			<li class="centerItem">
				<a href="{{url('users/shippingaddress')}}" class="a_jump">
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
				<a href="{{url('info/account_settings')}}" class="a_jump">
					<img src="{{asset('home/images/person10.png')}}" alt=""/>
					<span>账号设置</span>
					<i class="iconfont icon-you"></i>
				</a>
			</li>
		</ul>
		<ul style="margin-bottom:0" class="centerList centerList1">
			<li class="centerItem">
				<a href="{{url('users/logout')}}" class="a_jump">
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
        outBox("需要消费成为会员才能查看二维码","{{url('users/qrcode')}}");
     })
</script>
</body>
</html>