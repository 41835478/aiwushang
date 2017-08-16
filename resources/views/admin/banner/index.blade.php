

<!DOCTYPE html>
<html>

<head>
    @include('admin.layouts.header')
</head>

<body class="gray-bg">
@include('admin.layouts.box')
<div style="margin-bottom:10px;border-bottom:1px solid #eee;padding: 0 0 6px;"><a  href="{{url('banner/index')}}" class="btn btn-info" >管理轮播图</a><span style="margin-left: 10px;margin-right: 10px;">|</span> <a  href="{{url('banner/add')}}" class="diva"  style="height:22px;line-height:14px;" >添加轮播图</a> 
</div>
<div class="explain-col" style="margin-bottom: 10px;background: #fffced;border: 1px solid #ffbe7a;padding: 8px 10px;">

</div>
    
      <div class="row">
        <div class="col-sm-12">
          <div class="ibox float-e-margins">
            <div class="ibox-content">
           
             <form action="{{url('banner/index')}}" method="post">
              <table class=" table table-stripped" data-filter=#filter>
                <thead>
                  <tr>
                    <th>排序</th>
                    <th>标题</th>
                    <th>图片</th>
                    <th>链接</th>
                    <th>状态</th>
                    <th>操作</th>
                 </tr>
                </thead>
                <tbody>
            @foreach ($banner as $v)
                  <tr class="gradeX">
                    <td ><input name="sort[{{$v->id}}]" size="3" value="{{$v->id}}"  type="text" style="border: 0px solid #a7a6aa;height: 20px;padding: 2px 0 0;text-align: center;"></td>
                    <td>{{$v->title}}</td>
                    <td><img src="{{$v->pic}}" alt="" style="width:80px;height:60px;"/></td>
                    <td class="center">{{$v->url}}</td>
                    <td> @if ($v->status == 0) 开启
                          @elseif($v->status == 1)
                            禁用
                         @endif</td>
                    <td class="center"><a class="btn  btn-xs btn-info" href="{{url('banner/edit',array('id'=>$v->id))}}">修改</a> || <a class="btn  btn-xs btn-danger" href="">删除</a></td>
                  </tr> 
                   @endforeach                    
                </tbody>
              </table>
            <!--    <input type="submit" name="dosubmit" value="排序"  style="padding: 0.25em;background: #ddd none repeat scroll 0 0;border-color: currentcolor #666 #666 currentcolor;border-style: none solid solid none;border-width: 0 1px 1px 0;height: 24px;margin-right: 5px;"> <span>数值越大越靠前</span>
                </form> -->
            </div>
          </div>
        </div>
      </div>
     

    <!-- 全局js -->
    <script src="{{asset('admin/js/jquery.min.js?v=2.1.4')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js?v=3.3.6')}}"></script>
    <script src="{{asset('admin/js/plugins/footable/footable.all.min.js')}}"></script>
    <!-- 自定义js -->
    <script src="{{asset('admin/js/content.js?v=1.0.0')}}"></script>
    <script>$(document).ready(function() {
        $('.footable').footable();
        $('.footable2').footable();
      });
        $("tr").mouseenter(function () {
            $(this).css("background","#F0FFF0");
        });
        $("tr").mouseleave(function () {
            $(this).css("background","none");
        })

    </script>
