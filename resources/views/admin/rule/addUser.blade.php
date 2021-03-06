@extends("admin.layout.modify")

@section("content")
	<div id="wrapper" style="margin-top:20px;">
		<div id="page-wrapper">
			<form class="layui-form" >

				<div class="layui-form-item">
					<label class="layui-form-label">用户组</label>
					<div class="layui-input-block">
						@foreach($roles as $role)
							<input type="checkbox" class="user_group" name="role_id[]" title="{{$role->name}}" value="{{$role->id}}" @if($role && $role->checked == 1){{'checked'}} @endif>
						@endforeach
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">用户名</label>
					<div class="layui-input-block">
						<input type="text" name="username" required  lay-verify="required"  placeholder="请输入用户名" autocomplete="off" class="layui-input" value="@if(!empty($admin)){{$admin['username']}}@endif">
					</div>
				</div>


				<div class="layui-form-item">
					<label class="layui-form-label">密码</label>
					<div class="layui-input-block">
						<input type="password" name="password" required  lay-verify="required"  placeholder="请输入密码" autocomplete="off" class="layui-input" value="@if(!empty($admin)){{$admin['password']}}@endif" readonly>
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">确认密码</label>
					<div class="layui-input-block">
						<input type="password" name="password_confirmation" required  lay-verify="required"  placeholder="请输入确认密码" autocomplete="off" class="layui-input" value="@if(!empty($admin)){{$admin['password']}} @endif" readonly >
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">邮箱</label>
					<div class="layui-input-block">
						<input type="text" class="layui-input" name="email" lay-verify="email" placeholder="请输入邮箱" value="@if(!empty($admin)){{$admin['email']}}@endif" readonly>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">手机号</label>
					<div class="layui-input-block">
						<input type="text" class="layui-input" name="tel" lay-verify="required" placeholder="请输入手机号" value="@if(!empty($admin)){{$admin['tel']}}@endif" readonly>
					</div>
				</div>


				@if(!empty($admin))
					<input type="text" id="mold" hidden  value="edit" >
					<input type="text" id="id" hidden value="{{$admin['id']}}" >
				@endif

				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit="" lay-filter="formDemo">立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>


		</div>


	</div>
@endsection
@section("js")
	<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });

        layui.use(['util','form','laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element', 'slider'], function(){
            var laydate = layui.laydate //日期
                ,laypage = layui.laypage //分页
                ,layer = layui.layer //弹层
                ,table = layui.table //表格
                ,carousel = layui.carousel //轮播
                ,upload = layui.upload //上传
                ,element = layui.element //元素操作
                ,slider = layui.slider //滑块
            var form = layui.form;
//执行实例 多图上传
            upload.render({
                elem: '#test2'
                ,method: 'post'
                ,multiple: true //是否允许多文件上传。设置 true即可开启。不支持ie8/9
                ,url: '{{URL("file/img")}}' //上传接口
                ,done: function(index, upload){
                    //获取当前触发上传的元素，一般用于 elem 绑定 class 的情况，注意：此乃 layui 2.1.0 新增
                    if(index.code!=0){
                        layer.msg("上传错误",{icon:5});
                    }else{
                        layer.msg("上传成功",{icon:6});
                        img="../"+index.data;
                        $("#img2").append('<img src="'+img+'" name="img[]" width="20%"><input type="text" value="'+index.data+'" hidden name="rotation[]">')
                    }
                }
            });
            //监听提交
            form.on('submit(formDemo)', function(data){

                var date=data.field;

                if(date.types==""||date.label==""){
                    layer.msg("不能为空,请填写完整",{icon:5});return false;
                }
                date.type="add";
                if($("#mold").val()!=undefined){
                    date.update="update";
                    date.id=$("#id").val();
                    date.type="edit";
                }

                $.ajax({
                    data:date,
                    type:"post",
                    datatype:"json",
                    url:"{{url('admin/user')}}",
                    success:function(res){
                        console.log(res);
                        if(res.code==0){
                            parent.layer.msg(res.msg);
                            setTimeout(function(){
                                parent.layer.closeAll();
                                parent.location.reload();
                            },1000)
                        }else{
                            parent.layer.msg(res.msg);
                        }

                    }

                })
                return false;
            });
            //底部信息
            // var footerTpl = lay('#footer')[0].innerHTML;
            // lay('#footer').html(layui.laytpl(footerTpl).render({}))
            // .removeClass('layui-hide');
        });
	</script>
@endsection





