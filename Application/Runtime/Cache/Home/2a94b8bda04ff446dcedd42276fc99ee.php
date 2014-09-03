<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    
        <title>连接mongo数据库</title>
    
    <link rel="shortcut icon" type="image/ico" href="/Public/images/icon/favicon.ico">

    
</head>
<body>
    
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img src="<?php echo ($vo); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>

</body>
</html>