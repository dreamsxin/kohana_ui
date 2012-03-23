<?php

    // Grab the HREF value from the container
    $href = $container->get_href();

    // Initialize the attribute array
    $attributes = array(
        'href' => isset($href) ? $href : '#',
    );

    // Attempt to grab the id value
    $id = $container->get_id();

    // If we have an id value
    if (isset($id)) {
        // Add the id attribute
        $attributes['id'] = $id;
    }

    // Attempt to grab the classes array
    $classes = implode(' ', $container->get_classes());

    // If we have any classes
    if ($classes !== '') {
        // Put the classes in an attribute
        $attributes['class'] = $classes;
    }

    // Echo the tag
    echo '<a';

    // Echo the rendered attributes
    echo HTML::attributes($attributes);

    // Echo the end of the start tag
    echo '>';

    // Echo the result of rendering the children
    echo $container->render_children();

    // Echo the end tag
    echo '</a>';
