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
<link rel="stylesheet" href="css/swiper.min.css"/>
<link rel="stylesheet" type="text/css" href="font/iconfont.css"/>
<link rel="stylesheet" href="css/common.css"/>
<link rel="stylesheet" href="css/index.css"/>
<script type="text/javascript" src="js/swiper.min.js"></script>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<style>
	body{background-color:#f5f5f5;}
	.public_head{
		background: -webkit-linear-gradient(top, #62df9d , #ace9a5); 
		background: -o-linear-gradient(bottom, #62df9d, #ace9a5); 
		background: -moz-linear-gradient(bottom, #62df9d, #ace9a5); 
		background: linear-gradient(to bottom, #62df9d , #ace9a5);
		border:0;
	}
	.hotRecomend-con{padding-bottom:0;}
	.hotRecomend-num{margin-top:16px;}
</style>
</head>
<body>
<div class="public_head">
	<h3 id="inteTitle" style="color:#333">手机数码</h3>
	<a style="color:#333" href="integralMall.html" class="iconfont icon-fanhui"></a>
</div>
<!-- 内容区 -->
<div class="content" style="padding-bottom:0">
	<div class="integralList">
		<ul class="intergralListbox">
			<li class="div_clearFloat intergralList">
				<a href="javascript:void(0);" class="div_left div_clearFloat a_jump">
					<img src="images/integral2.png" alt=""/>
					<div class="hotRecomend-con">
                        <p class="hotRecomend-txt">小米 5000mAh 移动电源</p>
                        <p class="hotRecomend-num">
                            <em>5900</em><span>积分</span>
                        </p>
                    </div>
				</a>
				<button class="integralExchange" type="button">兑换</button>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript" src="js/handlebars-1.0.0.beta.6.js"></script>
<script type="text/x-handlebars-template" id="integral">
	{{#each this}}
		<li class="div_clearFloat intergralList">
			<a href="javascript:void(0);" class="div_left div_clearFloat a_jump">
				<img src="images/integral2.png" alt=""/>
				<div class="hotRecomend-con">
                    <p class="hotRecomend-txt">小米 5000mAh 移动电源</p>
                    <p class="hotRecomend-num">
                        <em>5900</em><span>积分</span>
                    </p>
                </div>
			</a>
			<button class={{transformat cls}} type="button">{{btn}}</button>
		</li>
	{{/each}}
</script>
<script type="text/javascript">
	var integralBox = [
		{img:'images/integral2.png',name:'小米 5000mAh 移动电源',integral:'6.9万',cls:'0',btn:'积分不足'},
		{img:'images/integral2.png',name:'小米 5000mAh 移动电源',integral:'6.9万',cls:'0',btn:'积分不足'},
		{img:'images/integral2.png',name:'小米 5000mAh 移动电源',integral:'5900',cls:'1',btn:'兑换'},
		{img:'images/integral2.png',name:'小米 5000mAh 移动电源',integral:'6.9万',cls:'0',btn:'积分不足'},
		{img:'images/integral2.png',name:'小米 5000mAh 移动电源',integral:'5900',cls:'1',btn:'兑换'},
		{img:'images/integral2.png',name:'小米 5000mAh 移动电源',integral:'6.9万',cls:'0',btn:'积分不足'}
	];
	var myTemplate = Handlebars.compile($('#integral').html());
    Handlebars.registerHelper("transformat",function(value){
          if(value=='0'){
	             return '';
		  }else if(value=='1'){
	            return "integralExchange";
	      }
	});      
	$('.intergralListbox').append(myTemplate(integralBox));
	$(".integralExchange").on('click',function(){
		window.location.href = 'goodsDetail_integral.html';
	}) 
	var _type = (window.location.href).split('=')[1];
	if(_type==1){
		$('#inteTitle').text('服装鞋帽');
	}else if(_type==2){
		$('#inteTitle').text('家居用品');
	}else if(_type==3){
		$('#inteTitle').text('运动鞋服');
	}else if(_type==4){
		$('#inteTitle').text('美妆洗护');
	}else if(_type==5){
		$('#inteTitle').text('饰品箱包');
	}else if(_type==6){
		$('#inteTitle').text('珠宝首饰');
	}else if(_type==7){
		$('#inteTitle').text('手机数码');
	}else if(_type==8){
		$('#inteTitle').text('生活电器');
	}
</script>
</body>
</html>