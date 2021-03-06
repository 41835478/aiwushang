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

    <link rel="stylesheet" href="{{asset('home/css/main.css')}}">
    <script type="text/javascript" src="{{asset('home/js/swiper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/js/jquery-3.1.1.min.js')}}"></script>
    <style>
        /* body{
            background-color:#f5f5f5;
        } */
        .register_box .login_bottom{
            margin: 40px auto 10px;
        }
        .login_zh{
            text-align: center;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="login_top">
    <img class="logo" src="{{asset('home/images/login_logo.png')}}" alt="">
    <ul class="login_nav">
        <li class="nav_li nav_li1">
            <span>登录</span>
            <img class="jiao" src="{{asset('home/images/login_jiao.png')}}" alt="">
        </li>
        <li class="nav_li">
            <span>注册</span>
            <img style="display:none" class="jiao" src="{{asset('home/images/login_jiao.png')}}" alt="">
        </li>
    </ul>
</div>
<div class="btm_box login_box">
    <div class="login_bottom">
        <div class="list_div">
            <img class="iconfont icon-zhanghao" src="{{asset('home/images/login_icon01.png')}}" alt="">
            <input class="input login-phone" type="text" placeholder="请输入手机号">
        </div>
        <div class="list_div">
            <img class="iconfont icon-mima" src="{{asset('home/images/login_icon02.png')}}" alt="">
            <input class="input login-pwd" type="password" placeholder="请输入密码">
        </div>

        <button class="login_btn" type="button">登录</button>
        <div class="login_zh">
            <div class="zh_div rem_div">
                <i class="iconfont icon-xuanzhong"></i>
                <span>记住账号</span>
            </div>
            <div class="zh_div fget_div">
                <a href="{{url('forget/forgetPwd')}}">忘记密码？</a>
            </div>
        </div>
    </div>
</div>

<div class="btm_box register_box" style="display:none">
    <div class="login_bottom">
        <div class="list_div">
            <img class="iconfont icon-zhanghao" src="{{asset('home/images/login_icon01.png')}}" alt="">
            <input class="input phone" type="text" name="phone" placeholder="请输入手机号">
        </div>
        <div class="list_div">
            <img class="iconfont icon-mima" src="{{asset('home/images/login_icon02.png')}}" alt="">
            <input class="input pwd" type="password" name="pwd" placeholder="请输入登录密码">
        </div>
        <div class="list_div">
            <img class="iconfont icon-mima" src="{{asset('home/images/login_icon02.png')}}" alt="">
            <input class="input pwd_confirmation" type="password" name="pwd_confirmation" placeholder="请确认登录密码">
        </div>
        <div class="list_div">
            <img class="iconfont icon-mima" src="{{asset('home/images/login_icon04.png')}}" alt="">
            <input class="input paypwd" type="password" name="paypwd" placeholder="请设置支付密码">
        </div>
        <div class="list_div">
            <img class="iconfont icon-mima" src="{{asset('home/images/login_icon03.png')}}" alt="">
            <input class="yz_input input code" type="text" name="code" placeholder="输入验证码">
            <input class="register_yzBtn" type="button" value="获取验证码">
        </div>
        <input type="hidden" value="{{$pid}}" class="registerPid">
        <button class="register_btn" type="button">注册</button>
    </div>
    <div class="login_zh">
        <p>点击注册代表您已阅读并同意<a href="{{url('register/agreement')}}">《用户注册协议》</a></p>
    </div>
</div>
<script>
    $(".login_nav").find('li').click(function() {
        var li_index = $(this).index();
        $(".login_nav").find(".jiao").css('display','none');
        $(".login_nav").find(".jiao").eq(li_index).css('display','block');

        $(".btm_box").css('display','none');
        $(".btm_box").eq(li_index).fadeIn('fast');
    });

    var flag = true;
    $(".rem_div").click(function() {
        if(flag){
            $(this).children('i').removeClass('icon-xuanzhong');
            $(this).children('i').addClass('icon-not_selected');
            flag = false;
        }else{
            $(this).children('i').removeClass('icon-not_selected');
            $(this).children('i').addClass('icon-xuanzhong');
            flag = true;
        }

    });
</script>
</body>
</html>
<script type="text/javascript">
    $(function(){
        $('.login_btn').click(function(){
            var phone=$('.login-phone').val();
            var pwd=$('.login-pwd').val();
            if(phone==""){
                alert("请输入您的手机号码！");
                return false;
            }
            if(!phone.match(/^1[34578]\d{9}$/)){
                alert('手机号不符合规则！');
                return false;
            }
            if(pwd==''){
                alert("请输入您的登录密码！");
                return false;
            }
            var data={
                'phone':phone,
                'pwd':pwd,
            };
            var url="{{url('login/homeLogin')}}";
            sendAjax(data,url)
        })

        $('.register_btn').click(function(){
            var phone=$('.phone').val();
            if(phone==""){
                alert("请输入您的手机号码！");
                return false;
            }
            if(!phone.match(/^1[34578]\d{9}$/)){
                alert('手机号不符合规则！');
                return false;
            }
            var pwd=$('.pwd').val();
            if(pwd==''){
                alert("请输入您的登录密码！");
                return false;
            }
            var repwd=$('.pwd_confirmation').val();
            if(repwd==""){
                alert("请输入确认登录密码！");
                return false;
            }
            if(pwd!=repwd){
                alert('两次密码输入不一致');
                return false;
            }
            var paypwd=$('.paypwd').val();
            if(paypwd==''){
                alert('支付密码不能为空');
                return false;
            }
            var code=$('.code').val();
            if(code==''){
                alert('验证码不能为空');
                return false;
            }
            var pid=$('.registerPid').val();
            var data={
                'phone':phone,
                'pwd':pwd,
                'pid':pid,
                'pwd_confirmation':repwd,
                'paypwd':paypwd,
                'code':code,
                '_token':'{{csrf_token()}}',
            };
            var url="{{url('register/goRegister')}}";
            sendAjax(data,url)
        })
        $('.register_yzBtn').click(function(){
            var phone=$('.phone').val();
            if(phone==""){
                alert("请输入您的手机号码！");
                return false;
            }
            if(!phone.match(/^1[34578]\d{9}$/)){
                alert('手机号不符合规则！');
                return false;
            }
            var data={
                'phone':phone,
                '_token':'{{csrf_token()}}',
            }
            var url="{{url('register/sendCode')}}";
            sendAjax(data,url)
        })
        function sendAjax(data,url){
            $.ajax({
                'url':url,
                'data':data,
                'async':true,
                'type':'post',
                'dataType':'json',
                success:function(data){
                    if(data.status){
                        alert(data.message);
                        if(data.data.flag==1){
                            window.location.href='/';
                        }else if(data.data.flag==2){
                            window.location.reload();
                        }else if(data.data.flag==3){
                            var wait=10;
                            time(this,wait)
                        }
                    }else{
                        alert(data.message);
                    }
                },
                error:function(msg){
                    var json=JSON.parse(msg.responseText);
                    alert(Object.values(json)[0].toString());
                }
            })
        }
        function time(o,wait) {
            if (wait == 0) {
                o.removeAttribute("disabled");
                o.value="获取验证码";
                wait = 120;
            } else {
                o.setAttribute("disabled", true);
                o.value="重新发送(" + wait + ")";
                wait--;
                setTimeout(function() {time(o,wait)}, 1000)
            }
        }
    })
</script>