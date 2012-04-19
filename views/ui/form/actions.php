<?php

    // Echo the start tag
    echo '<div'.HTML::attributes(
        $container->get_attributes()).'>';

    // Render any child elements
    echo $container->render_children();

    // Echo the end tag
    echo '</div>';
