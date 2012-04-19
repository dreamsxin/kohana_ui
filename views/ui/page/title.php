<?php

    // Echo the start tag
    echo '<h1'.HTML::attributes($component->get_attributes()).'>';

    // Echo the title value
    echo HTML::entities($component->get_title());

    // Echo the end tag
    echo '</h1>';

    // Attempt to grab the description
    $description = $component->get_description();

    // If a description is defined
    if (isset($description)) {
        // Render the start tag for the description
        echo '<p>';

        // Echo the description text
        echo HTML::entities($description);

        // Render the ending tag for the description
        echo '</p>';
    }
