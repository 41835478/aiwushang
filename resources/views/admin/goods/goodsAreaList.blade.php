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
                    <h5>专区商品列表</h5>
                </div>

                <div class="ibox-content">
                    <form action="{{url('goods/goodsAreaList')}}" method="get">
                        <div class="input-group">
                            <span  style="float: right;margin-left: 10px">专区分类：
                                <select name="areaType" class="input-sm">
                                    <option value="">--请选择--</option>
                                    @foreach(config('admin.specialArea') as $k=>$v)
                                        <option value="{{$k}}">{{$v}} 元专区</option>
                                    @endforeach
                                </select>
                            </span>
                            <span  style="float: right;margin-left: 10px">商品名称：
                                <input name="name" type="text" class="input-sm" placeholder="请输入商品名称"/>
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
                            <th>商品名称</th>
                            <th>商品主图</th>
                            <th>商品轮播图</th>
                            <th>价格</th>
                            <th>市场价</th>
                            <th>库存</th>
                            <th>销量</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($date as $v)
                            <tr class="gradeX">
                                <td class="did">{{$v->id}}</td>
                                <td>{{$v->name}}</td>
                                <td><img src="{{asset($v->pic)}}" width="50px" height="50px"></td>
                                <td>
                                    @foreach($v->small_pic as $val)
                                    <img src="{{asset($val)}}" width="50px" height="50px">
                                    @endforeach
                                </td>
                                <td>{{$v->price}} 元</td>
                                <td>{{$v->money}} 元</td>
                                <td>{{$v->storage}}</td>
                                <td>{{$v->sale}}</td>
                                <td>
                                    @if($v->status==1)
                                        <b style="color:green">上线</b> | <b style="color:#ccc;cursor:pointer" class="down">下线</b>
                                    @else
                                        <b style="color:#ccc;cursor:pointer" class="upPut">上线</b> | <b style="color:green">下线</b>
                                    @endif
                                </td>
                                <td class="center">
                                    <a href="{{url('goods/goodsInfoList',['id'=>$v->id])}}">详情</a> |
                                    <a href="{{url('goods/goodsInfoList',['id'=>$v->id])}}">修改</a> |
                                    <a href="{{url('goods/goodsInfoList',['id'=>$v->id])}}">修改商品轮播图</a> |
                                    <a href="javascript:;">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">共{{$res['total']}}条数据 当前第{{$res['currentPage']}}/{{$res['page']}}页</td>
                            <td colspan="6">
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
@include('admin.layouts.fooler')

<!-- 自定义js -->
<script src="{{asset('admin/js/content.js?v=1.0.0')}}"></script>
</body>
</html>
<script type="text/javascript">
    $(function(){
        $('.down').click(function(){
            var id=$(this).parent().parent().find('.did').html();
            var flag=2;
            var mark=1;
            var data={
                'id':id,
                'flag':flag,
                'mark':mark
            };
            commonSet(data)
        })
        $('.upPut').click(function(){
            var id=$(this).parent().parent().find('.did').html();
            var flag=1;
            var mark=1;
            var data={
                'id':id,
                'flag':flag,
                'mark':mark
            }
            commonSet(data)
        })
        function commonSet(data)
        {
            $.ajax({
                'url':'{{url("goods/commonSet")}}',
                'data':data,
                'async':true,
                'type':'get',
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
</script>