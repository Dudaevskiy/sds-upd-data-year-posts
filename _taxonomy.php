<?php
//d('Привет');
// Register Taxonomy SDStudio Авто обновление года
global $sdstudio_avtoobnovlenie_goda_da_ID;
function cptui_register_my_taxes_sds_update_this_post_year() {

    /**
     * Taxonomy: Категорії Студентів.
     */

    $labels = array(
        "name" => __( "SDStudio Авто обновление года", "sds_update_this_post_year" ),
        "singular_name" => __( "SDStudio Авто обновление года", "sds_update_this_post_year" ),
    );

    $args = array(
        "label" => __( "Категория SDStudio Авто обновление года", "sds_update_this_post_year" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array( 'slug' => 'sds_update_this_post_year', 'with_front' => true,  'hierarchical' => true, ),
        "show_admin_column" => true,
        "show_in_rest" => true,
        "rest_base" => "sds_update_this_post_year",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
    );
    register_taxonomy( "sds_update_this_post_year", array( "post" ), $args );



    //CODE TO REGISTER TAXONOMY
    // Создаем категорию
    if( !term_exists( 'sdstudio_avtoobnovlenie_goda_da', 'sds_update_this_post_year' ) ) {
        wp_insert_term(
            'SDStudio Автообновление года - ДА',
            'sds_update_this_post_year',
            array(
                'description' => 'Данная рубрика служит маркером для плагина "SDStudio Updater Data Year Posts", при помощи которого пользователь отмечает те записи которым необходимо изменить год в дате публикации записи',
                'slug'        => 'sdstudio_avtoobnovlenie_goda_da'
            )
        );
    }



}
add_action( 'init', 'cptui_register_my_taxes_sds_update_this_post_year'  );



