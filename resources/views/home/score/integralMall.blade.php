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
<script type="text/javascript" src="js/zepto.js"></script>
<style>
	body{background-color:#f5f5f5;}
    .index_navWrapper>.a_jump>img{border-radius:50%;}
    .index_goodsTitle{height:42px;line-height: 42px;padding:0 3.125%;font-size:14px;color:#666;}   
    .index_goodsDetail{margin-bottom:0;}
</style>
</head>
<body>
<div class="intergralHead">
    <div class="public_head" style="position:static;background:0;border:0">
        <h3 style="color:#333">积分商城</h3>
        <a style="color:#333" href="index.html" class="iconfont icon-fanhui"></a>
    </div>
    <div class="integralTotal">
        <p class="div_left">我的消费积分：</p>
        <p class="div_right">6912</p>
    </div>
</div>
<div class="index-content" style="padding:12px 0;border-top:1px solid #e6e6e6">
    <!-- index-nav   -->  
    <div class="index_nav">
        <div class="div_displayFlex index_navWrapper">
            <a href="integralMall_list.html?type=1" class="a_jump">
                <img src="images/integralNav01.png" alt=""/>
                <span>服装鞋帽</span>
            </a>
            <a href="integralMall_list.html?type=2" class="a_jump">
                <img src="images/integralNav02.png" alt=""/>
                <span>家居用品</span>
            </a>
            <a href="integralMall_list.html?type=3" class="a_jump">
                <img src="images/integralNav03.png" alt=""/>
                <span>运动鞋服</span>
            </a>
            <a href="integralMall_list.html?type=4" class="a_jump">
                <img src="images/integralNav04.png" alt=""/>
                <span>美妆洗护</span>
            </a>
            <a href="integralMall_list.html?type=5" class="a_jump">
                <img src="images/integralNav05.png" alt=""/>
                <span>饰品箱包</span>
            </a>
            <a href="integralMall_list.html?type=6" class="a_jump">
                <img src="images/integralNav08.png" alt=""/>
                <span>珠宝首饰</span>
            </a>
            <a href="integralMall_list.html?type=7" class="a_jump">
                <img src="images/integralNav07.png" alt=""/>
                <span>手机数码</span>
            </a>
            <a href="integralMall_list.html?type=8" class="a_jump">
                <img src="images/integralNav06.png" alt=""/>
                <span>生活电器</span>
            </a>
        </div>
    </div>
    <div style="height:12px;border-bottom:1px solid #e6e6e6"></div>
    <!-- goodsDetail -->
    <div class="index_goods">
         <div class="index_goodsDetail">
            <div class="div_clearFloat index_goodsTitle" style="border-top:0">
                热门推荐
            </div>
            <div class="hotRecomended">
                <ul class="div_displayFlex hotRecomendedBox">
                    <li class="div_borderBox hotRecomendList">
                        <a href="goodsDetail_integral.html" class="a_jump">
                            <div class="hotRecomend-con">
                                <p class="hotRecomend-txt">小米 5000mAh 移动电源</p>
                                <p class="hotRecomend-num">
                                    <em>5900</em><span>积分</span>
                                </p>
                            </div>
                            <img class="integralImg" src="images/integral.png" alt=""/>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/handlebars-1.0.0.beta.6.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script id="goods" type="text/x-handlebars-template">
    {{#each this}}
        <li class="div_borderBox hotRecomendList">
            <a href="goodsDetail_integral.html" class="a_jump">
                <div class="hotRecomend-con">
                    <p class="hotRecomend-txt">{{name}}</p>
                    <p class="hotRecomend-num">
                        <em>{{price}}</em><span>积分</span>
                    </p>
                </div>
                <img class="integralImg" src={{img}} alt=""/>
            </a>
        </li>
    {{/each}}
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var goodslist1 = [
                            {"img":"images/integral.png","name": "小米 5000mAh 移动电源","price": "5900"},     
                            {"img":"images/integral.png","name": "小米 5000mAh 移动电源","price": "5900"}, 
                            {"img":"images/integral.png","name": "小米 5000mAh 移动电源","price": "5900"}, 
                            {"img":"images/integral.png","name": "小米 5000mAh 移动电源","price": "5900"},
                            {"img":"images/integral.png","name": "小米 5000mAh 移动电源","price": "5900"}, 
                            {"img":"images/integral.png","name": "小米 5000mAh 移动电源","price": "5900"}      
                         ];
        var myTemplate = Handlebars.compile($('#goods').html());
        $('.hotRecomendedBox').html(myTemplate(goodslist1));
    });
</script>  
</body>
</html>