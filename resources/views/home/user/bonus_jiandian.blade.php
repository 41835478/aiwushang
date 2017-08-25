
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



<link rel="stylesheet" href="{{asset('home/css/index.css')}}"/>
<link rel="stylesheet" href="{{asset('home/css/swiper.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('home/font/iconfont.css')}}"/>
<link rel="stylesheet" href="{{asset('home/css/common.css')}}"/>

<script type="text/javascript" src="{{asset('home/js/swiper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('home/js/jquery-3.1.1.min.js')}}"></script>

<style>
	body{background-color:#f5f5f5;}
	.public_head{
		background: -webkit-linear-gradient(left, #1d93ec , #0188ed); 
        background: -o-linear-gradient(right, #1d93ec, #0188ed); 
        background: -moz-linear-gradient(right, #1d93ec, #0188ed); 
        background: linear-gradient(to right, #1d93ec , #0188ed); 
        border:0;
	}
</style>
</head>
<body>
<div class="public_head">
	<h3> @if($id==1)  见点奖金
			@elseif($id==2)	分销奖金
			@elseif($id==3)	推荐奖金	
			@elseif($id==4) 升级奖金
			@endif
	</h3>
	<a href="javascript:history.go(-1);" class="iconfont icon-fanhui"></a>
</div>
<!-- 内容区 -->
<div class="content" style="padding-top:48px;padding-bottom:0">


	<div class="bonus">
		<h2>
			<span>￥</span><em>{{$zbonus}}</em>
		</h2>
		<p>奖励金额</p>
	</div>
	<div class="bonus_box">
		<ul class="bonusList">
		@foreach($bonus as  $k=>$v)
			<li class="div_clearFloat bonusItem">
				<span>{{$k+1}}</span>
				<img src="{{$v['pic']}}" alt=""/>
				<div class="bonus_con">
					<p>{{$v['name']}}</p>
					<span> {{date('Y-m-d H:i:s',$v['update_at'])}}</span>
				</div>
				<p>￥{{$v['money']}}</p>
			</li>
		@endforeach

		</ul>
	</div>
</div>
<script src="https://cdn.bootcss.com/handlebars.js/4.0.10/handlebars.min.js"></script>
<script id="bonus" type="text/x-handlebars-template">

</script>
<script type="text/javascript">

	var handleHelper = Handlebars.registerHelper("addOne",function(index){
         return index+1;
    });
	var myTemplate = Handlebars.compile($("#bonus").html());
	$('.bonusList').html(myTemplate(bonuslist));
</script>
</body>
</html>