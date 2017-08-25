
<!DOCTYPE html>
<html>
<head>
<title>爱无尚</title>
 @include('home.public.header')
<style>
	body{
		background-color:#f5f5f5;
	}
	.addressBox{
		padding:0 3.125%;
		background-color: #fff;
		border-bottom:1px solid #eaeaea;
	}
	.addressBox>.submitAddress{
		padding:12px 0;
		border-bottom:1px solid #eaeaea;
	}
	.submitAddress-con{
		color:#333;
	}
	.default{
		color:#2194eb;
	}
	.addressBox>li:last-child{
		border:0;
	}
</style>
</head>
<body>
<div class="public_head">
	<h3>选择收货地址</h3>
	<a href="javascript:history.go(-1);" class="iconfont icon-fanhui"></a>
	<span onclick="javascript:window.location.href='/users/manageaddress'">管理</span>
</div>
<div class="content">
<ul class="addressBox">

	@foreach($address as $v)
	<li class="submitAddress">
		<div class="submit_consignee">
			<p class="div_left">{{$v['name']}}</p>
			<p class="div_right">{{$v['phone']}}</p>
		</div>
		<p class="submitAddress-con">
			@if($v['default'] ==1)
			<span class="default">[默认地址]</span>
			@elseif($v['default'] ==0)

			@endif
			<span>{{$v['province']}} {{$v['city']}} {{$v['area']}}  {{$v['address']}}</span>
		</p>
	</li>
	@endforeach
	
</ul>
</div>
</body>
</html>