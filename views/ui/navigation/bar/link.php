<?php

    // Echo the beginning of the list item start tag
    echo '<li';

    // If we think this should be the active link
    if ($container->get_active()) {
        // Echo the 'active' class to the list item
        echo ' class="active"';
    }

    // Echo the end of the list item start tag
    echo '>';

    // Echo the start of the link tag
    echo '<a'.HTML::attributes($container->get_attributes()).'>';

    // Echo the escaped link text, if there is any
    echo HTML::entities($container->get_text());

    // Echo the result of rendering the children
    echo $container->render_children();

    // Echo the end of the link tag
    echo '</a>';

    // Echo the end of the links list item
    echo '</li>';
