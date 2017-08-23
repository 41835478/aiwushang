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
<link rel="stylesheet" href="{{asset('home/css/index.css')}}"/>
<script type="text/javascript" src="{{asset('home/js/swiper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('home/js/jquery-3.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('home/js/zepto.js')}}"></script>
<style>
    body{
        background-color:#f5f5f5;
    }
</style>
</head>
<body>
<div class="index-content" style="padding-bottom:54px">
    <!-- banner -->
     <div class="swiper-container index-banner">
        <div class="swiper-wrapper">
            @foreach ($lunbo as $v)
            <div class="swiper-slide">
                <a class="a_jump" href="javascript:void(0)">
                    <img class="content-banner" src="{{ $v->pic }}" alt="{{ $v->title }}" />
                </a>
            </div>
            @endforeach
            {{--<div class="swiper-slide">--}}
                {{--<a class="a_jump" href="javascript:void(0)">--}}
                    {{--<img class="content-banner" src="{{asset('home/images/banner2.jpg')}}" />--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="swiper-slide">--}}
                {{--<a class="a_jump" href="javascript:void(0)">--}}
                    {{--<img class="content-banner" src="{{asset('home/images/banner3.jpg')}}" />--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination lf_page"></div>
    </div>
    <!-- index-nav   -->  
    <div class="index_nav">
        <div class="div_displayFlex index_navWrapper">
            <a href="BeginnerGuide.html" class="a_jump">
                <img src="{{asset('home/images/indexNav10.png')}}" alt=""/>
                <span>新手必看</span>
            </a>
            <a href="SystemNotice.html" class="a_jump">
                <img src="{{asset('home/images/indexNav04.png')}}" alt=""/>
                <span>系统公告</span>
            </a>
            <a href="rankingList.html" class="a_jump">
                <img src="{{asset('home/images/indexNav02.png')}}" alt=""/>
                <span>排行榜单</span>
            </a>
            <a href="saleZone.html" class="a_jump">
                <img src="{{asset('home/images/indexNav11.png')}}" alt=""/>
                <span>促销专区</span>
            </a>
            <a href="drawWeb.html" class="a_jump">
                <img src="{{asset('home/images/indexNav09.png')}}" alt=""/>
                <span>大转盘</span>
            </a>
            <a href="BaihuoMall.html" class="a_jump">
                <img src="{{asset('home/images/indexNav06.png')}}" alt=""/>
                <span>爱无尚商城</span>
            </a>
            <a href="cooperationPlatform.html" class="a_jump">
                <img src="{{asset('home/images/indexNav07.png')}}" alt=""/>
                <span>合作平台</span>
            </a>
            <a href="integralMall.html" class="a_jump">
                <img src="{{asset('home/images/indexNav08.png')}}" alt=""/>
                <span>积分商城</span>
            </a>
        </div>
    </div>
    <div style="height:12px;border-bottom:1px solid #e6e6e6"></div>
    <!-- goodsDetail -->
    <div class="index_goods">
         <div class="index_goodsDetail">
            <div class="div_clearFloat index_goodsTitle" style="border-top:0">
                <img src="{{asset('home/images/100.png')}}" alt=""/>
            </div>
            <div class="index_goodsBox">
                <ul class="div_displayFlex goods_yin">
                    @foreach ($goods as $v)
                        @if ($v->type == 4)
                    <li class="div_borderBox indexgoodsList">
                        <a href="/shop/goodsDetail?id={{ $v->id }}" class="a_jump">
                            <img class="div_borderBox indexGoodsimg" src="/{{ $v->pic }}" alt="{{ $v->name }}"/>
                            <div class="index_price">
                                <p class="index_con">{{ $v->name }}</p>
                                <p class="index_priceCon">￥{{ $v->price }}</p>
                            </div>
                        </a>
                    </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="index_goodsDetail">
            <div class="div_clearFloat index_goodsTitle">
                <img src="{{asset('home/images/300.png')}}" alt=""/>
            </div>
            <div class="index_goodsBox">
                <ul class="div_displayFlex goods_jin">
                    @foreach ($goods as $v)
                        @if ($v->type == 5)
                            <li class="div_borderBox indexgoodsList">
                                <a href="/shop/goodsDetail?id={{ $v->id }}" class="a_jump">
                                    <img class="div_borderBox indexGoodsimg" src="/{{ $v->pic }}" alt="{{ $v->name }}"/>
                                    <div class="index_price">
                                        <p class="index_con">{{ $v->name }}</p>
                                        <p class="index_priceCon">￥{{ $v->price }}</p>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="index_goodsDetail">
            <div class="div_clearFloat index_goodsTitle">
                <img src="{{asset('home/images/2000.png')}}" alt=""/>
            </div>
            <div class="index_goodsBox">
                <ul class="div_displayFlex goods_zuan">
                    @foreach ($goods as $v)
                        @if ($v->type == 6)
                            <li class="div_borderBox indexgoodsList">
                                <a href="/shop/goodsDetail?id={{ $v->id }}" class="a_jump">
                                    <img class="div_borderBox indexGoodsimg" src="/{{ $v->pic }}" alt="{{ $v->name }}"/>
                                    <div class="index_price">
                                        <p class="index_con">{{ $v->name }}</p>
                                        <p class="index_priceCon">￥{{ $v->price }}</p>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div style="padding-bottom:12px;color:#666;font-size:12px;text-align:center;">技术支持：<a style="color:#666" href="http://www.zzjbs.com">金帮手</a></div>
</div>
<footer class="footer">
    <div class="footerCon">
        <a href="index.html" class="a_jump footerOn">
            <img src="{{asset('home/images/icon-11.png')}}" alt=""/>
            <span class="footerlist-cn">首页</span>
        </a>
        <a href="shop_Cart.html" class="a_jump">
            <img src="{{asset('home/images/icon-2.png')}}" alt=""/>
            <span class="footerlist-cn">购物车</span>
        </a>
        <a class="a_jump qrcode person_b">
            <img src="{{asset('home/images/icon-3.png')}}" alt=""/>
            <span class="footerlist-cn">二维码</span>
        </a>
        <a class="a_jump person_c">
            <img src="{{asset('home/images/icon-4.png')}}" alt=""/>
            <span class="footerlist-cn">我的</span>
        </a>
    </div>
</footer>
<script type="text/javascript" src="{{asset('home/js/handlebars-1.0.0.beta.6.js')}}"></script>
<script type="text/javascript" src="{{asset('home/js/index.js')}}"></script>

<script type="text/javascript">

    $(".person_c").on("click",function(){
        addBox("body");
        outBoxx("查看个人中心需先下载APP在APP端进行查看，是否现在下载？","personalCenter.html");
    })
    $(".person_b").on("click",function(){
        addBox("body");
        outBoxc("需要消费成为会员才能查看二维码","QRcode.html");
     })
</script>  
</body>
</html>