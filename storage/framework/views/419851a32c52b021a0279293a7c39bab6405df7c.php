<?php $__env->startSection("content"); ?>
	<blockquote class="layui-elem-quote news_search">
		<div class="layui-inline">
			<a class="layui-btn role_add" style="background-color:#5FB878">添加用户组</a>
		</div>
	</blockquote>
	<div class="layui-form links_list">
	  	<table class="layui-table">
		    <colgroup>
				<col width="">
				<col width="">
				<col>
				<col>
		    </colgroup>
		    <thead>
				<tr>
					<th>#</th>
					<th style="text-align:left;">用户组名</th>
					<th>添加时间</th>
					<th>操作</th>
				</tr> 
		    </thead>
		    <tbody class="links_content">
			<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($role->id); ?></td>
					<td style="text-align:left;"><?php echo e($role->name); ?></td>
					<td><?php echo e($role->created_at); ?></td>
					<td>
						<a data-id="<?php echo e($role->id); ?>" class="layui-btn layui-btn-xs role_edit">
							<i class="layui-icon">&#xe642;</i>
							编辑
						</a>
						<a data-id="<?php echo e($role->id); ?>" class="layui-btn layui-btn-warm layui-btn-xs rule_set">
							<i class="layui-icon"></i>
							权限配置
						</a>
						<a data-id="<?php echo e($role->id); ?>" class="layui-btn layui-btn-danger layui-btn-xs role_del">
							<i class="layui-icon"></i>
							删除
						</a>
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("js"); ?>
	<script type="text/javascript" src="/layadmin/modul/rule/roles.js"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("admin.layout.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\phpstudy\WWW\html\xianshangke\xianshangke\resources\views/admin/rule/roles.blade.php ENDPATH**/ ?>