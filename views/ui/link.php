<?php

    // Echo the start tag
    echo '<a'.HTML::attributes($container->get_attributes()).'>';

    // Echo the escaped link text, if there is any
    echo HTML::entities($container->get_text());

    // Echo the result of rendering the children
    echo $container->render_children();

    // Echo the end tag
    echo '</a>';
