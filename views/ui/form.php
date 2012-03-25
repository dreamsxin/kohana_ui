<?php

    // Echo the start tag
    echo '<form'.HTML::attributes($container->get_attributes()).'>';

    // Echo the result of rendering the children
    echo $container->render_children();

    // Echo the end tag
    echo '</form>';
