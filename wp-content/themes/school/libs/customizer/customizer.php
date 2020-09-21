<?php
/*
 * Customizer for this theme.
 */

$wp_customize->add_section(
    'school_extras_settings_section',
    array(
        'title' => __('Extra Options', 'school'),
        'description' => __('', 'school'),
    )
);

$wp_customize->add_setting(
    'school_header_url',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'school_header_url',
    array(
        'type' => 'text',
        'label' => __('Add the URL of the header image', 'school'),
        'section' => 'school_extras_settings_section',
        'settings' => 'school_header_url',

    ));