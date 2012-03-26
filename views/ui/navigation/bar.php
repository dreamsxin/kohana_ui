<div<?= HTML::attributes($container->get_attributes()) ?>>

<div class="navbar navbar-fixed-top">
<div class="navbar-inner">
<div class="container">

<a class="brand" href="<?= URL::site() ?>"><?= HTML::entities($container->get_title()) ?></a>

<ul class="nav">

<?= $container->render_children(); ?>

</ul>

</div>
</div>
</div>

</div>
