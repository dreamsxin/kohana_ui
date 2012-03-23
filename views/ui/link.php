<?php

    // Grab the HREF value from the container
    $href = $container->get_href();

    // Initialize the attribute array
    $attributes = array(
        'href' => isset($href) ? $href : '#',
    );

    // Attempt to grab the classes array
    $classes = implode(' ', $container->get_classes());

    // If we have any classes
    if ($classes !== '') {
        // Put the classes in an attribute
        $attribute['class'] = $classes;
    }

    // Render the children
    $children = $container->render_children();

?><a<?= HTML::attributes($attributes) ?>><?= $children ?></a>
