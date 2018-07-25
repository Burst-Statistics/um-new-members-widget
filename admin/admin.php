<?php
defined('ABSPATH') or die("you do not have acces to this page!");
/***
 ***	@extend settings
 ***/
add_filter( 'um_settings_structure', 'um_new_members_settings', 10, 1 );

function um_new_members_settings( $settings ) {


    $exclude_roles = get_option( 'umnm_exclude_roles');
    $user_roles = um_get_roles();

    $key = ! empty( $settings['extensions']['sections'] ) ? 'um-new-members-widget' : '';
    $settings['extensions']['sections'][$key] = array(
        'title'     => __( 'UM New Members','um-new-members-widget'),
        'fields'    => array(

            array(
                'id'		=> 'umnm_exclude_roles',
                'type'		=> 'multi_selects',
                'label'		=> __( 'Choose roles to exclude','um-new-members-widget' ),
                'value'		=> $exclude_roles,
                'add_text'		=> __( 'Add new excluded role', 'um-new-members-widget' ),
                'options'		=> $user_roles,
                'show_default_number'	=> 0,
            ),

        )
    );

$settings = apply_filters( 'umnm_settings_structure', $settings );

return $settings;
}


add_filter( 'um_change_settings_before_save', 'umnm_before_save');
function umnm_before_save($um_options){

    if (isset($um_options['umnm_exclude_roles'])) {
        update_option('umnm_exclude_roles', $um_options['umnm_exclude_roles']);
    } else {
        update_option('umnm_exclude_roles', array());
    }
    return $um_options;
}
