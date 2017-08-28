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
                    <h5>分销列表</h5>
                </div>

                <div class="ibox-content">
                    <form action="{{url('goods/goodsList')}}" method="get">
                        <div class="input-group">
                            <span  style="float: right;margin-left: 10px">商品类型：
                                <select name="goodsType" class="input-sm">
                                    <option value="">--请选择--</option>
                                    @foreach(config('admin.goodsType') as $k=>$v)
                                        <option value="{{$k+1}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </span>
                            <span  style="float: right;margin-left: 10px">商品名称：
                                <input name="name" type="text" class="input-sm" placeholder="请输入商品名称"/>
                            </span>
                            <span  style="float: right;margin-left: 10px">分类类型：
                                <select id="threeLevel" name="classType" class="input-sm">
                                    <option value="">--请选择--</option>
                                    @foreach(config('admin.goodsClassType') as $k=>$v)
                                        <option value="{{$k+1}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </span>
                            <span  style="float: right;margin-left: 10px">下级分类：
                                <select id="select_opts" name="nextName" class="input-sm">
                                    <option value="">--请选择--</option>
                                </select>
                            </span>
                            <span  style="float: right;">一级分类：
                                <select name="topName" class="input-sm" id="topLevel">
                                    <option value="">--请选择--</option>
                                    @foreach($goodsClass as $v)
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                </select>
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
                            <th>目标用户名称</th>
                            <th>目标用户手机号</th>
                            <th>目标用户性别</th>
                            <th>目标用户头像</th>
                            <th>记录详情</th>
                            <th>分销金钱</th>
                            <th>来源用户名称</th>
                            <th>来源用户手机号</th>
                            <th>来源用户性别</th>
                            <th>来源用户头像</th>
                            <th>分销时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($date as $v)
                            <tr class="gradeX">
                                <td class="did">{{$v->id}}</td>
                                <td>{{$v->to_login_name}}</td>
                                <td>{{$v->to_phone}}</td>
                                <td>{{$v->to_sex==1?'男':'女'}}</td>
                                <td><img src="{{asset($v->to_pic)}}" width="50px" height="50px"></td>
                                <td>{{$v->recode_info}}</td>
                                <td>{{$v->money}} 元</td>
                                <td>{{$v->from_login_name}} 元</td>
                                <td>{{$v->from_phone}}</td>
                                <td>{{$v->from_sex==1?'男':'女'}}</td>
                                <td><img src="{{asset($v->from_pic)}}" width="50px" height="50px"></td>
                                <td>{{$v->create_at}}</td>
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
</body>
</html>
<script type="text/javascript">
    var ue =UE.getEditor('editor');
</script>