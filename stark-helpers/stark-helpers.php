<?php
/*
 * Plugin Name: Stark Helpers
 * Plugin URI: https://julianstark.de/
 * Description: Stark Helpers - Gutenberg Blocks.
 * Version: 2023.08.02.1
 * Author: Julian Stark
 */

add_action('init', 'stark_helpers_register_blocks');
function stark_helpers_register_blocks() {
    register_block_type(__DIR__ . '/blocks/slick-all');
    register_block_type(__DIR__ . '/blocks/scroll-animations');
}

/**
 * Register block script
 */
function stark_helpers_register_block_script() {
    //wp_register_script('slick-all-js', plugin_dir_url(__FILE__) . 'blocks/slick-all/slick-all.js', ['jquery']);
    //wp_register_script('slick-js', plugin_dir_url(__FILE__) . 'ressources/slick/slick.min.js', ['jquery']);
    //wp_register_script('featherlight-js', plugin_dir_url(__FILE__) . 'ressources/js/featherlight.min.js', ['jquery']);
    //wp_register_script('sal-js', plugin_dir_url(__FILE__) . 'ressources/sal/sal.js');
    //wp_register_script('sal-init-js', plugin_dir_url(__FILE__) . 'blocks/scroll-animations/scroll-animations.js', ['sal-js']);
}
//add_action('init', 'stark_helpers_register_block_script');

function stark_helpers_enqueue_acf_block_script() {
    if (is_singular()) {
        // Check if the current post/page contains the ACF block
        if (!is_admin() && stark_has_block('acf/scroll-animations')) {
            wp_enqueue_script('sal-js', plugin_dir_url(__FILE__) . 'ressources/sal/sal.js');
            //wp_enqueue_script('sal-init-js', plugin_dir_url(__FILE__) . 'blocks/scroll-animations/scroll-animations.js', ['sal-js']);
            wp_enqueue_style('sal-css', plugin_dir_url(__FILE__) . 'ressources/sal/sal.css', array(), '1.0', 'all');
        }
        if (!is_admin() && stark_has_block('acf/slick-all')) {
            wp_enqueue_script('slick-js', plugin_dir_url(__FILE__) . 'ressources/slick/slick.min.js', ['jquery']);
            wp_enqueue_style('slick-css', plugin_dir_url(__FILE__) . 'ressources/slick/slick.css');
            wp_enqueue_style('slick-theme-css', plugin_dir_url(__FILE__) . 'ressources/slick/slick-theme.css');
        }
    }
}
add_action('enqueue_block_assets', 'stark_helpers_enqueue_acf_block_script');

/*
 * Has Block inklusive GeneratePress Elements
 */
function stark_has_block($block_name, $post_id = null) {

    if (!$post_id) {
        $post_id = get_the_ID();
    }

    if (has_block($block_name, $post_id)) {
        return true;
    }

    global $generate_elements;

    if (!$generate_elements || empty($generate_elements)) {
        return false;
    }

    foreach ((array) $generate_elements as $key => $data) {
        if ($data['is_block_element'] && has_block($block_name, $data['id'])) {
            return true;
        }
    }

    return false;

}

/*
 * ACFs for Slick All
 */
add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_6491d6146909d',
        'title' => 'Block: Slick-All',
        'fields' => array(
            array(
                'key' => 'field_6491d878693b4',
                'label' => 'Selector',
                'name' => 'selector',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_6491d888693b5',
                'label' => 'Settings',
                'name' => 'settings',
                'aria-label' => '',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '{arrows: true,
	dots: true,}',
                'maxlength' => '',
                'rows' => 5,
                'placeholder' => '',
                'new_lines' => '',
            ),
            array(
                'key' => 'field_6491d89a693b6',
                'label' => 'CSS',
                'name' => 'css',
                'aria-label' => '',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'rows' => 5,
                'placeholder' => '',
                'new_lines' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/slick-all',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
});

/**
 * ACFs for Scroll Animations
 */
add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_64946716c4cd7',
        'title' => 'Block: Scroll Animations',
        'fields' => array(
            array(
                'key' => 'field_64946717b20e2',
                'label' => 'sal_options',
                'name' => 'sal_options',
                'aria-label' => '',
                'type' => 'textarea',
                'instructions' => '<a target="_blank" href="https://github.com/mciastek/sal#usage">📒 Doku</a>',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '{
		threshold: 0.5,
		once: true,
	}',
                'maxlength' => '',
                'rows' => 5,
                'placeholder' => '',
                'new_lines' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/scroll-animations',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
});