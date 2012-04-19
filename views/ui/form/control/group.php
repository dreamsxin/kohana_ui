<?php

    // Echo the control group start tag
    echo '<div'.HTML::attributes(
        $container->get_attributes()).'>';

    // Attempt to grab the label text
    $label_text = $container->get_label_text();

    // If label text is defined
    if (isset($label_text)) {
        // Start defining the label attributes
        $label_attributes = array(
            'class' => 'control-label',
        );

        // Attempt to grab the for attribute
        $for = $container->get_for();

        // If a for attribute is defined
        if (isset($for)) {
            // Add the for attribute
            $label_attributes['for'] = $for;
        }

        // Output the start tag for the label
        echo '<label'.HTML::attributes($label_attributes).'>';

        // Output the label text
        echo HTML::entities($label_text);

        // Output the end tag for the label
        echo '</label>';
    }

    // Output the controls div
    echo '<div class="controls">';

    // Render any child elements
    echo $container->render_children();

    // Attempt to grab the help text
    $help_text = $container->get_help_text();

    // If any help text is defined
    if (isset($help_text)) {
        // Echo the starting tag for the help text
        echo '<p class="help-block">';

        // Echo the help text
        echo HTML::entities($help_text);

        // Echo the closing tag for the help text
        echo '</p>';
    }

    // Echo the ending tag for the controls div
    echo '</div>';

    // Echo the control group end tag
    echo '</div>';
