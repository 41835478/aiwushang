
<!DOCTYPE html>
<html>
<head>
<title>爱无尚</title>
 @include('home.public.header')
<style>
	body{
		background-color:#f5f5f5;
	}
	.footer{
		width:100%;
		padding:0;
		height:50px;
	}
	::-webkit-input-placeholder {
        color: #999;font-size:16px
    } 
    :-moz-placeholder {
        color: #999; font-size:16px
    } 
    ::-moz-placeholder {
        color: #999; font-size:16px
    } 
    :-ms-input-placeholder {
        color: #999; font-size:16px
    } 
	.myBoxlist{padding:0 3.125%;}
	.myBoxlist>p{padding:0;font-size: 16px;color:#353535;}
	.memberUser{font-size:16px;color:#333;display:block;float:right;text-align: right;width:72%;height:54px;}
	.myBoxlist span.memberAvail{display:block;float:right;text-align: right;width:50%;overflow:hidden;font-size: 16px;color:#333;}
	.memberSelect{border:0;display:block;float:right;text-align: right;height:54px;font-size: 16px;color:#ffb32a;padding:0;background: url("images/selectbg.png") no-repeat right 24px;background-size:15px 8px;padding-right:20px;}
	.myBoxlist span.memberExpend{font-size: 16px;color:#ffb32a;display:block;float:right;}
</style>
</head>
<body>
<div class="public_head" style="background-color:#fff">
	<h3 style="color:#333">激活会员订单</h3>
	<a style="font-size:20px;color:#333" href="javascript:history.go(-1);" class="iconfont icon-fanhui"></a>
</div>
<div class="content">
	<ul class="myBox">
		<li class="myBoxlist">
			<p>会员账号：</p>
			<input class="memberUser" type="text" placeholder="请输入您要激活的会员的账号"/>
		</li>
		<li class="myBoxlist">
			<p>可用复投币余额：</p>
			<span class="memberAvail">8888.00</span>
		</li>
		<li class="myBoxlist">
			<p>激活订单：</p>
			<select class="memberSelect" name="" id="">
				<option value="1">100元订单</option>
				<option value="2">300元订单</option>
				<option value="3">2000元订单</option>
			</select>
		</li>
		<li class="myBoxlist">
			<p>需消耗复投币：</p>
			<span class="memberExpend">100.00</span>
		</li>
	</ul>
</div>
<footer class="footer">
	<button class="edit_save" type="button">确定激活</button>
</footer>
<script type="text/javascript">
	$('.memberSelect').on('change',function(){
		var _txt = $(this).val();
		if(_txt==1){
			$('.memberExpend').text("100.00");
		}
		if(_txt==2){
			$('.memberExpend').text("300.00");
		}
		if(_txt==3){
			$('.memberExpend').text("2000.00");
		}
	})
</script>
</body>
</html>