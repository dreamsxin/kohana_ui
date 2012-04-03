<?php

    // Echo the start tag
    echo '<form'.HTML::attributes($container->get_attributes()).'>';

    // Create a hidden form field with the form id
    echo '<input'.HTML::attributes(array(
        'type' => 'hidden',
        'name' => '_form_id',
        'value' => (string) $container->get_id(),
    )).' />';

    // Echo the result of rendering the children
    echo $container->render_children();

    // Echo the end tag
    echo '</form>';
