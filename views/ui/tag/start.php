<?php

    // Echo the first part of the start tag
    echo '<'.$tag;

    // Render the attributes
    echo HTML::attributes($attributes);

    // Echo the end of the start tag
    echo '>';
