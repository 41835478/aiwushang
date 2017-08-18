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
                    <h5>会员列表</h5>
                </div>



                  <form action="{{url('member/index')}}" method="get">
       <div class="explain-col" style="margin-bottom: 10px;background: #fffced;border: 1px solid #ffbe7a;padding: 8px 10px;">
    <div class="input-group">
        <span  style="float: left;margin-left: 25px">

        <input id="end" name="end" class="laydate-icon" placeholder="请选择结束时间"></span>
        <span  style="float: left;margin-left: 25px">
        <input id="start" name="start" class="form-control layer-date laydate-icon" placeholder="请选择开始时间"  onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"></span>
        <span  style="float: left;margin-left: 25px">用户类型：
            <select style="border:1px solid #ccc;" name="level" class="input-sm">
                <option value="">--请选择用户类型--</option>
                <option value="0">游客</option>
                <option value="1">零售商</option>
                <option value="2">批发商</option>    
            </select>
        </span>
        <span  style="float: left;margin-left: 25px">手机号：<input style="border:1px solid #ccc;" name="phone" placeholder="请输入手机号" class="input-sm" type="text"></span>
         <span  style="float: left;margin-left: 25px">用户名：<input style="border:1px solid #ccc;" name="name" placeholder="请输入用户名" class="input-sm" type="text"></span>       
        <span class="input-group-btn" style="float: left;margin-left: 25px">
            <button type="submit" class="btn btn-sm btn-primary">
                搜索
            </button>
        </span>
    </div>
    </div>
</form>
                    <table class="footable table table-stripped" data-page-size="10" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>推荐人手机号</th>
                            <th>会员昵称</th>
                            <th>级别</th>
                            <th>会员手机号</th>
                            <th>会员注册时间</th>
                            <th>会员余额</th>
                         
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($memberclass as $v)
                            <tr class="gradeX">
                                <td class="did">{{$v->id}}</td>
                                <td>{{$v->pphone}}</td>
                             
                                  
                                <td>{{$v->name}}</td>
                                
                                <td>@if ($v->level == 0) 游客
                                    @elseif($v->level == 1)
                                        零售商
                                    @elseif($v->level == 2)
                                    批发商
                                    @endif </td>
                                <td>{{$v->phone}} </td>
                                
                                <td class="center">{{date('Y-m-d H:i:s',$v->create_at)}}</td>
                        
                                <td class="center">{{$v->account}}</td>
                              
                                   
                                
                                <td class="center">
                                    <a href="{{url('member/edit',['id'=>$v->id])}}">修改</a> |
                                    <a href="javascript:;" class="goodsClassDel">删除</a>
                                </td>
                            </tr>
                      @endforeach
                        </tbody>
                        <tfoot>
                        <tr>

                            <td colspan="4">共{{$total}}条数据 当前第{{$currentPage}}/{{$page}}页</td>
                            <td colspan="8">
                                {!! $memberclass->links() !!}
                            </td>
                               
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
@include('admin.layouts.fooler')

<!-- 自定义js -->
<script src="{{asset('admin/js/content.js?v=1.0.0')}}"></script>


<!-- 自定义js -->
<script src="{{asset('admin/js/content.js?v=1.0.0')}}"></script>
<script src="{{asset('admin/js/plugins/layer/laydate/laydate.js')}}"></script>
<script>
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
</body>
</html>
<script type="text/javascript">
    $(function(){
        $('.sort').blur(function(){
            var id=$(this).parent().parent().find('.did').html();
            var sort=$(this).val();
            if(sort!=''&&sort!=null){
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });
                $.ajax({
                    'url':'{{url("goodsClass/sort")}}',
                    'data':{'id':id,'sort':sort},
                    'async':true,
                    'type':'post',
                    'dataType':'json',
                    success:function(data){
                        if(data.status){
                            parent.layer.alert(data.message, {
                                icon: 1,
                                skin: 'layer-ext-moon'
                            })
                        }else{
                            alert(data.message);
                        }
                        window.location.reload();
                    },
                    error:function(){
                        alert('Ajax响应失败');
                    }
                })
            }
        })
        $('.goodsClassDel').click(function(){
            var id=$(this).parent().parent().find('.did').html();
            var sure=confirm("你确信要删除该条数据吗？删除将无法找回")
            if(sure==true){
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });
                $.ajax({
                    'url':'{{url("goodsClass/goodsClassDel")}}',
                    'data':{'id':id},
                    'async':true,
                    'type':'post',
                    'dataType':'json',
                    success:function(data){
                        if(data.status){
                            parent.layer.msg(data.message);
                            window.location.reload();
                        }else{
                            parent.layer.msg(data.message);
                            window.location.reload();
                        }
                    },
                    error:function(){
                        alert('Ajax响应失败');
                    }
                })
            }
        })
        $('.unDisplay').click(function(){
            var id=$(this).parent().parent().find('.did').html();
            var flag=2;
            var data={
                'id':id,
                'flag':flag,
            };
            displayAjax(data)
        })
        $('.display').click(function(){
            var id=$(this).parent().parent().find('.did').html();
            var flag=1;
            var data={
                'id':id,
                'flag':flag,
            };
            displayAjax(data)
        })
        function displayAjax(data)
        {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            $.ajax({
                'url':'{{url("goodsClass/whetherDisplay")}}',
                'data':data,
                'async':true,
                'type':'post',
                'dataType':'json',
                success:function(data){
                    if(data.status){
                        parent.layer.alert(data.message, {
                            icon: 1,
                            skin: 'layer-ext-moon'
                        })
                    }else{
                        alert(data.message);
                    }
                    window.location.reload();
                },
                error:function(){
                    alert('Ajax响应失败');
                }
            })
        }
        $('#topLevel').change(function(){
            $(".optionlist").remove();
            var id=$(this).val();
            if(id!=''){
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });
                $.ajax({
                    'url':'{{url("goodsClass/secondClass")}}',
                    'data':{'id':id},
                    'async':true,
                    'type':'post',
                    'dataType':'json',
                    success:function(data){
                        if(data.status==true){
                            $.each(data.data,function(index,value){
                                var opt = '<option class="optionlist" value='+value.id+'>' + value.name + '</option>';
                                $("#select_opts").append(opt);
                            })

                        }else{
                            alert(data.message);
                        }
                    },
                    error:function(){
                        alert('Ajax响应失败');
                    }
                })
            }
        })
    })
</script>