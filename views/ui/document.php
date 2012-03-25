<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title><?= $container->get_title() ?></title>

<?php foreach ($container->get_css() as $uri): ?>
<link href="<?= $uri ?>" media="screen" rel="stylesheet" type="text/css" />
<?php endforeach; ?>

<?php foreach ($container->get_javascript() as $uri): ?>
<script src="<?= $uri ?>"></script>
<?php endforeach; ?>

</head>
<body>

<div>

<?= $container->render_children() ?>

</div>

</body>
</html>
