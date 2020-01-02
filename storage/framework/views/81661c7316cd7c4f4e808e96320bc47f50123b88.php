<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>线上客客户服务器控制台</title>
    <link rel="stylesheet" href="<?php echo asset('/xianshangke/css/layout.css')?>">
    <link rel="stylesheet" href="<?php echo asset('/xianshangke/css/home.css')?>">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
<div class="layout">
    <div class="left">
        <h1>控制台</h1>
        <ul class="list">
        </ul>
        <p>线上客技术支持</p>
    </div>
    <div class="right">
        <div class="head">
            <ul >
                <li>帮助中心</li>
                <li>修改密码</li>
                <li><a href="/admin/logout">退出系统</a></li>
            </ul>
        </div>
        <div class="main">
            <div class="left_two">
            </div>
            <div class="content main-content"  id="pjax-container">
            
                <?php echo $__env->yieldContent('content'); ?>
            </div>


        </div>
    </div>
</div>

<script src="<?php echo asset('/xianshangke/js/jquery.min.js')?>"></script>
<script src="<?php echo asset('/xianshangke/js/bootstrap.min.js')?>"></script>
<script src="<?php echo asset('/xianshangke/js/home.js?v=2')?>"></script>
<script src="<?php echo asset('/xianshangke/js/jquery.pjax.js')?>"></script>

<?php echo $__env->yieldContent('js'); ?>

<!-- JavaScripts建议将这些js下载到本地 -->
<script>
    $(document).pjax('a', '#pjax-container');
    $(document).on("pjax:timeout", function(event) {
        // 阻止超时导致链接跳转事件发生
        event.preventDefault()
    });
</script>

</body>
</html><?php /**PATH D:\phpstudy\WWW\html\xianshangke\xianshangke\resources\views/admin/layout/main.blade.php ENDPATH**/ ?>