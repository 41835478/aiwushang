<!DOCTYPE html>
<html>
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
@include('admin.layouts.box')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>提现列表</h5>
                </div>

                <div class="ibox-content">
                    <form action="{{url('withdraw/cashList')}}" method="get">
                        <div class="input-group">
                            <span  style="float: right;margin-left: 10px"><input id="end" name="end" class="laydate-icon" placeholder="请选择结束时间"></span>
                            <span  style="float: right;margin-left: 10px"><input id="start" name="start" class="laydate-icon" placeholder="请选择开始时间"></span>
                            <span  style="float: right;margin-left: 10px">手机号：
                                <input name="mobile" type="text" class="input-sm" placeholder="请输入手机号"/>
                            </span>
                            <span  style="float: right;margin-left: 10px">用户名：
                                <input name="name" type="text" class="input-sm" placeholder="请输入用户名称"/>
                            </span>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    搜索
                                </button>
                            </span>
                        </div>
                    </form>

                    <table class="footable table table-stripped" data-page-size="10" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>手机号</th>
                            <th>用户头像</th>
                            <th>用户性别</th>
                            <th>用户余额</th>
                            <th>提现金额</th>
                            <th>手续费</th>
                            <th>到账金额</th>
                            <th>提现方式</th>
                            <th>体现状态</th>
                            <th>提现申请时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($date as $v)
                            <tr class="gradeX">
                                <td class="did">{{$v->id}}</td>
                                <td>{{$v->name}}</td>
                                <td>{{$v->mobile}}</td>
                                <td><img src="{{asset($v->user->pic)}}" width="50px" height="50px"></td>
                                <td>{{$v->user->sex==1?'男':'女'}}</td>
                                <td>{{$v->user->account}} 元</td>
                                <td>{{$v->money}} 元</td>
                                <td>{{$v->fee}} 元</td>
                                <td>{{$v->arrival_money}} 元</td>
                                <td>
                                    @if($v->cash_way==1)
                                        <b style="color:green">支付宝</b>
                                    @elseif($v->cash_way==2)
                                        <b style="color:lightskyblue;" class="upPut">微信</b>
                                    @else
                                        <b style="color:#ccc;" class="upPut">银行卡</b>
                                    @endif
                                </td>
                                <td>
                                    @if($v->status==1)
                                        <b style="color:green">成功</b>
                                    @else
                                        <b style="color:#ccc;" class="upPut">失败</b>
                                    @endif
                                </td>
                                <td class="center">{{date('Y-m-d H:i:s',$v->create_at)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">共{{$res['total']}}条数据 当前第{{$res['currentPage']}}/{{$res['page']}}页</td>
                            <td colspan="11">
                                {!! $date->links() !!}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 全局js -->
<script src="{{asset('admin/js/jquery.min.js?v=2.1.4')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js?v=3.3.6')}}"></script>
{{--@include('admin.layouts.fooler')--}}
<!-- 自定义js -->
<script src="{{asset('admin/js/content.js?v=1.0.0')}}"></script>
<script src="{{asset('admin/js/plugins/layer/laydate/laydate.js')}}"></script>

</body>
</html>
<script type="text/javascript">
    $('.close').click(function(){
        $(this).parent().parent().remove();
    })
</script>
<script>
    //外部js调用
    laydate({
        elem: '#end', //目标元素。由于laydate.js封装了一个轻量级的选择器引擎，因此elem还允许你传入class、tag但必须按照这种方式 '#id .class'
        event: 'focus' //响应事件。如果没有传入event，则按照默认的click
    });
    laydate({
        elem: '#start', //目标元素。由于laydate.js封装了一个轻量级的选择器引擎，因此elem还允许你传入class、tag但必须按照这种方式 '#id .class'
        event: 'focus' //响应事件。如果没有传入event，则按照默认的click
    });
    //日期范围限制
    var start = {
        elem: '#start',
        format: 'YYYY/MM/DD hh:mm:ss',
        min: laydate.now(), //设定最小日期为当前日期
        max: '2099-06-16 23:59:59', //最大日期
        istime: true,
        istoday: false,
        choose: function (datas) {
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    var end = {
        elem: '#end',
        format: 'YYYY/MM/DD hh:mm:ss',
        min: laydate.now(),
        max: '2099-06-16 23:59:59',
        istime: true,
        istoday: false,
        choose: function (datas) {
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };
    laydate(start);
    laydate(end);
</script>

