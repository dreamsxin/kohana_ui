<html>
<head>

<title><?= $container->get_title() ?></title>

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
