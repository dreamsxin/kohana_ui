<!DOCTYPE html>
<html lang="en">
<head>

<title><?= HTML::entities($container->get_title()) ?></title>

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
