<?php $__env->startSection('css'); ?>
	<link href="<?php echo e(asset('assets/libs/layui/css/layui.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('page/table/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('page/table/vendor/datatables-plugins/dataTables.bootstrap.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('page/table/vendor/datatables-responsive/dataTables.responsive.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('page/table/vendor/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
	<div id="page-wrapper">

		<div class="row">
			<div class="col-lg-12">
				<div class="layui-form toolbar">
					<div class="layui-form-item">
						<div class="layui-inline">
							<label class="layui-form-label w-auto">搜索：</label>
							<div class="layui-input-inline mr0">
								<input name="keyword" class="layui-input" type="text" placeholder="输入关键字"/>
							</div>
						</div>



						<div class="layui-inline">
							<button class="layui-btn icon-btn" lay-filter="formSubSearchRole" lay-submit>
								<i class="layui-icon">&#xe615;</i>搜索
							</button>
						</div>

					</div>
				</div>

				<table class="layui-hide" id="demo" lay-filter="test"></table>

				<div id="test1"></div>


				<script type="text/html" id="barDemo">
					<a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
					<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
				</script>

				<script type="text/html" id="staDemo">
					
					{{#  if(d.status ==1){ }}
					<a class="layui-btn layui-btn-danger layui-btn-xs"  onclick="status({{d.id}})" lay-event="check">禁用</a>
					{{#  } }}

					{{#  if(d.status ==0){ }}
					<a class="layui-btn layui-btn-xs" onclick="status({{d.id}})" lay-event="check">启用</a>
					{{#  } }}
					
				</script>
				<script type="text/html" id="typeDemo">
					
					{{#  if(d.type ==1){ }}
					<a >会员标签</a>
					{{#  } }}

					{{#  if(d.type ==2){ }}
					<a >导游标签</a>
					{{#  } }}

					{{#  if(d.type ==3){ }}
					<a >评论标签</a>
					{{#  } }}
					
				</script>

				<script type="text/html" id="good_image">
					
					<img src="../{{d.good_image}}">
					
				</script>



			</div>
			<!-- /.col-lg-12 -->
		</div>

	</div>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

    <script>
        layui.config({
            version: '1568076536509' //为了更新 js 缓存，可忽略
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

            var insTb = table.render({
                elem: '#demo'
                ,height: 800
                ,url: '<?php echo e(URL("goods/index")); ?>?type=select' //数据接口
                ,title: '标签表'
                ,page: true //开启分页
                ,toolbar: 'default' //开启工具栏，此处显示默认图标，可以自定义模板，详见文档
                ,totalRow: true //开启合计行
                ,limit : 5 //这里设置的是每页显示多少条
                ,cols: [[ //表头
                    {type: 'checkbox', fixed: 'left'}
                    ,{field: 'id', title: 'ID', width:80, sort: true }
                    // ,{title: '类型', width:100,align:'center',toolbar: '#typeDemo'}
                    ,{field: 'good_title', title: '标题', width:100,align:'center'}
                    ,{field: 'good_dsc', title: '副标题', width:100,align:'center'}
                    ,{field: 'goods_name', title: '商品分类', width:100,align:'center'}
                    ,{field: 'royalty_price', title: '提成价格', width:100,align:'center'}
                    ,{field: 'old_price', title: '原价格', width:100,align:'center'}
                    ,{field: 'new_price', title: '新价格', width:100,align:'center'}
                    ,{field: 'thumbs_num', title: '点赞次数', width:100,align:'center'}
                    ,{field: 'stock', title: '库存', width:100,align:'center'}
                    ,{field: 'browse_num', title: '浏览量', width:100,align:'center'}
                    ,{field: 'sell_num', title: '销量', width:100,align:'center'}
                    ,{ title: '商品图片', width:100,align:'center', toolbar: '#good_image'}
                    ,{field:'freight',title: '运费', width:100,align:'center',templet:function(d){
                        if(d.freight==0){
                            return '<a>包邮</a>';
                        }else{
                            return '<a>不包邮</a>';
                        }
                    }}
                    ,{field:'goods_status',title: '商品状态', width:100,align:'center',templet:function(d){
                        if(d.goods_status==1){
                            return '<a>出售中</a>';
                        }else{
                            return '<a>下架</a>';
                        }
                    }}
                    ,{field: 'created_at', title: '创建时间', width:100,align:'center'}
                    ,{field: 'updated_at', title: '更新时间', width:100,align:'center'}


                    // ,{field: 'time', title: '创建时间', width:180,align:'center',
                    //   templet: function (d) {
                    //     return layui.util.toDateString(d.time * 1000, "yyyy-MM-dd HH:mm:ss")
                    //   }
                    // }
                    // ,{ title: '分类', width:80,align:'center', toolbar: '#staDemo'}
                    ,{fixed: 'right',title:'操作', width: 165, align:'center', toolbar: '#barDemo'}
                ]]
            });

            element.init();
            //搜索
            form.on('submit(formSubSearchRole)', function (data) {
                insTb.reload({where: data.field}, 'data');
            });

            //监听头工具栏事件
            table.on('toolbar(test)', function(obj){

                var checkStatus = table.checkStatus(obj.config.id)
                    ,data = checkStatus.data; //获取选中的数据
                switch(obj.event){
                    case 'add':
                        layer.open({
                            title:"添加",
                            type: 2,
                            area: ['80%', '80%'],
                            content: '<?php echo e(url("goods/detail")); ?>' //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                        });
                        //layer.msg('添加');
                        break;
                    case 'update':
                        if(data.length === 0){
                            layer.msg('请选择一行');
                        } else if(data.length > 1){
                            layer.msg('只能同时编辑一个');
                        } else {

                            layer.open({
                                title:"编辑",
                                type: 2,
                                area: ['80%', '80%'],
                                content: '<?php echo e(url("goods/detail")); ?>?type=edit&id='+data[0].id

                            });
                        }
                        break;
                    case 'delete':
                        if(data.length === 0){
                            layer.msg('请选择一行');
                        } else {
                            layer.alert('确定删除？', {
                                skin: 'layui-layer-molv' //样式类名  自定义样式
                                ,closeBtn: 1    // 是否显示关闭按钮
                                ,anim: 1 //动画类型
                                ,btn: ['确定','取消'] //按钮
                                ,icon: 6    // icon
                                ,yes:function(){
                                    del(data);
                                }
                                ,btn2:function(){
                                    layer.msg('已取消操作')
                                }});

                        }
                        break;
                };
            });

            //监听行工具事件
            table.on('tool(test)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
                var data = obj.data //获得当前行数据
                    ,layEvent = obj.event; //获得 lay-event 对应的值
                if(layEvent === 'detail'){
                    layer.msg('查看操作');
                } else if(layEvent === 'del'){
                    layer.alert('确定删除？', {
                        skin: 'layui-layer-molv' //样式类名  自定义样式
                        ,closeBtn: 1    // 是否显示关闭按钮
                        ,anim: 1 //动画类型
                        ,btn: ['确定','取消'] //按钮
                        ,icon: 6    // icon
                        ,yes:function(){
                            del(data);
                        }
                        ,btn2:function(){
                            layer.msg('已取消操作')
                        }});
                } else if(layEvent === 'edit'){
                    layer.open({
                        title:"编辑",
                        type: 2,
                        area: ['80%', '80%'],
                        content: '<?php echo e(url("goods/detail")); ?>?type=edit&id='+obj.data.id //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']

                    });
                }
            });

            function del(data){
                if(data.length==undefined){
                    //单行删除
                    var id=data.id;
                }else{//多行删除
                    var id=[];
                    for(var i=0;i<data.length;i++){
                        id.push(data[i].id);
                    }
                }

                $.ajax({
                    type:"post",
                    datatype:"json",
                    data:{'id':id,'type':'del'},
                    url:"<?php echo e(url('goods/status')); ?>",
                    success:function(res){
                        console.log(res);
                        if(res.code==1){
                            layer.msg(res.msg);
                            setTimeout(function(){
                                window.location.reload();
                            },1000);
                        }else{
                            layer.msg(res.msg);
                        }
                    }

                });



            };

            //底部信息
            // var footerTpl = lay('#footer')[0].innerHTML;
            // lay('#footer').html(layui.laytpl(footerTpl).render({}))
            // .removeClass('layui-hide');

        });
        function status(id){
            $.ajax({
                data:{'id':id,'type':'edit'},
                type:'post',
                datatype:"json",
                url:"<?php echo e(url('goods/index')); ?>",
                success:function(res){
                    if(res.code==1){
                        layer.msg(res.msg,{icon:6});
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }else{
                        layer.msg(res.msg,{icon:5});
                    }
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("js"); ?>

	<script src="<?php echo e(asset('page/table/vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('page/table/vendor/datatables-plugins/dataTables.bootstrap.min.js')); ?>"></script>
	<script src="<?php echo e(asset('page/table/vendor/datatables-responsive/dataTables.responsive.js')); ?>"></script>

	<!-- <script src="<?php echo e(asset('assets/libs/layui/layui.all.js')); ?>"></script> -->
	<script src="<?php echo e(asset('assets/libs/layui/layui.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\phpstudy\WWW\html\xianshangke\xianshangke\resources\views/admin/rule/users.blade.php ENDPATH**/ ?>