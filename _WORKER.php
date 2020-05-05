<?php
//use Sds_Upd_Data_Year_Posts/includes
//Download and Insert a Remote Image File into the WordPress Media Library
//https://kellenmace.com/download-insert-remote-image-file-wordpress-media-library/
// Require the file that contains the KM_Download_Remote_Image class.
// Подключаем в основном файле 
// require_once plugin_dir_path( __FILE__ ) . '_WORKER.php';
 require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

// Название плагина
//$plugin_data = get_plugin_data( __FILE__ );
$plugin_name = SDStudioPluginName();
$plugin_version = SDStudioPluginVersion();


//https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js
// Marcdown parser for php
// traditional markdown and parse full text
//$parser = new \cebe\markdown\Markdown();
$MarkdownParser = new \cebe\markdown\Markdown();
// Использование:
// $markdown = '## Привет';
// s($parser->parse($markdown));


if ( !function_exists( 'run_prettify' ) ){
	
	add_action( 'wp_enqueue_scripts', 'run_prettify' );
	
	function run_prettify(){
		wp_enqueue_script( 'run_prettify', 'https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js');
	}
}

if (!class_exists('ReduxFramework') && file_exists(plugin_dir_path(__FILE__) . 'wp-content/plugins/redux-framework-4/ReduxCore/framework.php')) {
//==========================================
//==========================================
// Подключаем Redux
    // Redux Framework
    require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

    require_once plugin_dir_path( __FILE__ ) . '/wp-content/plugins/redux-framework-4/ReduxCore/framework.php';

//Redux::setSection($opt_name__redux_sds_upd_data_year_posts, array(    'title' => esc_html__('Section title', 'yourtextdomain') ,    'id' => esc_html__('section-unique-id', ' yourtextdomain') ,    'icon' => 'icon-name',    'fields' => array()));

//==========================================
//==========================================
}
if ( ! class_exists( 'Redux' ) ) {
    return null;
}

//-----------------------------------------
// REMOVE DEMO and PROMO REDUX
// START
//-----------------------------------------
/**
 * Disable Redux Developer Mode dev_mode
 * https://asique.net/disable-redux-framework-developer-mode-dev_mode/
 * START
 */

if ( !function_exists( 'redux_disable_dev_mode_plugin' ) ) {

    function redux_disable_dev_mode_plugin( $redux ) {
        if ( $redux->args[ 'opt_name' ] != 'redux_demo' ) {
            $redux->args[ 'dev_mode' ] = false;
            $redux->args[ 'forced_dev_mode_off' ] = false;
        }
    }

    add_action( 'redux/construct', 'redux_disable_dev_mode_plugin' );
}

if ( !function_exists( 'gl_removeDemoModeLink' ) ) {
	function gl_removeDemoModeLink() {
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_filter( 'plugin_row_meta', [ ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks' ], null, 2 );
		}
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_action( 'admin_notices', [ ReduxFrameworkPlugin::get_instance(), 'admin_notices' ] );
		}
	}
	add_action( 'init', 'gl_removeDemoModeLink' );
}


/**
 * END
 * Disable Redux Developer Mode dev_mode
 */
add_action( 'redux/loaded', 'remove_demo' );


/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 * https://forums.envato.com/t/how-to-remove-redux-framework-notice/62645/4
 * START
 */
if ( ! function_exists( 'remove_demo' ) ) {
    function remove_demo() {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', [
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ], null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', [ ReduxFrameworkPlugin::instance(), 'admin_notices' ] );
        }
    }
}
/**
 * END
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 * https://forums.envato.com/t/how-to-remove-redux-framework-notice/62645/4
 */

/**
 * https://docs.reduxframework.com/core/the-basics/removing-demo-mode-and-notices/
 * START
 */
 if ( ! function_exists( 'removeDemoModeLink' ) ) {
	function removeDemoModeLink() { // Be sure to rename this function to something more unique
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', [ ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'], null, 2 );
		}
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action('admin_notices', [ ReduxFrameworkPlugin::get_instance(), 'admin_notices' ] );
		}
	}
	add_action('init', 'removeDemoModeLink');
}
/**
 * END
 * https://docs.reduxframework.com/core/the-basics/removing-demo-mode-and-notices/
 */
//-----------------------------------------
// END
// REMOVE DEMO and PROMO REDUX
//-----------------------------------------













// This is your option name where all the Redux data is stored.
//dd($opt_name__redux_sds_upd_data_year_posts);
$opt_name__redux_sds_upd_data_year_posts = 'redux_sds_upd_data_year_posts';
//Redux::init($opt_name__redux_sds_upd_data_year_posts);
/**
 * GLOBAL ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: @link https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 */

/**
 * ---> BEGIN ARGUMENTS
 */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = [
    // REQUIRED!!  Change these values as you need/desire.
    'opt_name'                  => $opt_name__redux_sds_upd_data_year_posts,


	'ajax_save'                 => true,


    // Name that appears at the top of your panel.
//    'display_name'              => $theme->get( 'Name' ),
    'display_name'              => $plugin_name,

    // Version that appears at the top of your panel.
    'display_version'           => $plugin_version,

    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
    'menu_type'                 => 'menu',

    // Show the sections below the admin menu item or not.
    'allow_sub_menu'            => true,

    'menu_title'                => esc_html__( 'SDStudio Updater Data Year Posts', 'your-domain-here' ),
    'page_title'                => esc_html__( 'SDStudio Updater Data Year Posts', 'your-domain-here' ),

    // Specify a custom URL to an icon.
    'menu_icon'                 => 'dashicons-welcome-widgets-menus',

    // Use a asynchronous font on the front end or font string.
    'async_typography'          => true,

    // Disable this in case you want to create your own google fonts loader.
    'disable_google_fonts_link' => false,

    // Show the panel pages on the admin bar.
    'admin_bar'                 => false,

    // Choose an icon for the admin bar menu.
    'admin_bar_icon'            => 'dashicons-calendar',

    // Choose an priority for the admin bar menu.
    'admin_bar_priority'        => 50,

    // Set a different name for your global variable other than the opt_name.
    'global_variable'           => '',

    // Show the time the page took to load, etc.
    'dev_mode'                  => false,

    // Enable basic customizer support.
    'customizer'                => true,

    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_priority'             => null,

    // For a full list of options, visit: @link http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
    'page_parent'               => 'themes.php',

    // Permissions needed to access the options panel.
    'page_permissions'          => 'manage_options',


    // Force your panel to always open to a specific tab (by id).
    'last_tab'                  => '',

    // Icon displayed in the admin panel next to your menu_title.
    'page_icon'                 => 'icon-themes',

    // Page slug used to denote the panel.
    'page_slug'                 => 'sds-upd-data-year-posts',

    // On load save the defaults to DB before user clicks save or not.
    'save_defaults'             => true,

    // If true, shows the default value next to each field that is not the default value.
    'default_show'              => false,

    // What to print by the field's title if the value shown is default. Suggested: *.
    'default_mark'              => '',

    // Shows the Import/Export panel when not used as a field.
    'show_import_export'        => true,

    // CAREFUL -> These options are for advanced use only.
    'transient_time'            => 60 * MINUTE_IN_SECONDS,

    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
    'output'                    => true,

    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head.
    'output_tag'                => true,

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'database'                  => '',

    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    'use_cdn'                   => true,
    'compiler'                  => true,

    // HINTS.
    'hints'                     => [
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => [
            'color'   => 'light',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ],
        'tip_position'  => [
            'my' => 'top left',
            'at' => 'bottom right',
        ],
        'tip_effect'    => [
            'show' => [
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ],
            'hide' => [
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ],
        ],
    ],
];

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
$args['admin_bar_links'][] = [
    'id'    => 'redux-docs',
    'href'  => '//docs.reduxframework.com/',
    'title' => esc_html__( 'Documentation', 'your-domain-here' ),
];

$args['admin_bar_links'][] = [
    'id'    => 'redux-support',
    'href'  => '//github.com/ReduxFramework/redux-framework/issues',
    'title' => esc_html__( 'Support', 'your-domain-here' ),
];

$args['admin_bar_links'][] = [
    'id'    => 'redux-extensions',
    'href'  => 'reduxframework.com/extensions',
    'title' => esc_html__( 'Extensions', 'your-domain-here' ),
];

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args['share_icons'][] = [
    'url'   => '//github.com/ReduxFramework/ReduxFramework',
    'title' => 'Visit us on GitHub',
    'icon'  => 'el el-github',
];
$args['share_icons'][] = [
    'url'   => '//www.facebook.com/pages/Redux-Framework/243141545850368',
    'title' => esc_html__( 'Like us on Facebook', 'your-domain-here' ),
    'icon'  => 'el el-facebook',
];
$args['share_icons'][] = [
    'url'   => '//twitter.com/reduxframework',
    'title' => esc_html__( 'Follow us on Twitter', 'your-domain-here' ),
    'icon'  => 'el el-twitter',
];
$args['share_icons'][] = [
    'url'   => '//www.linkedin.com/company/redux-framework',
    'title' => esc_html__( 'FInd us on LinkedIn', 'your-domain-here' ),
    'icon'  => 'el el-linkedin',
];

// Panel Intro text -> before the form.
if ( ! isset( $args['global_variable'] ) || false !== $args['global_variable'] ) {
    if ( ! empty( $args['global_variable'] ) ) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace( '-', '_', $args['opt_name'] );
    }
//    $args['intro_text'] = '<p>' . sprintf( __( 'Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: $s', 'your-domain-here' ) . '</p>', '<strong>' . $v . '</strong>' );
} else {
//    $args['intro_text'] = '<p>' . esc_html__( 'This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'your-domain-here' ) . '</p>';
}

// Add content after the form.
//$args['footer_text'] = '<p>' . esc_html__( 'This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.', 'your-domain-here' ) . '</p>';

Redux::set_args( $opt_name__redux_sds_upd_data_year_posts, $args );

/*
 * ---> END ARGUMENTS
 */


/*
 *
 * ---> BEGIN SECTIONS
 *з-зю0з
 */

/* As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for. */

/* -> START Basic Fields. */

$kses_exceptions = [
    'a'      => [
        'href' => [],
    ],
    'strong' => [],
    'br'     => [],
];
// traditional markdown and parse full text
// $parser = new \cebe\markdown\Markdown();
// echo $MarkdownParser->parse($markdown);

// $FAQ = file_get_contents(dirname(__FILE__) . '/_Markdown/FAQ.md');
$FAQ = $MarkdownParser->parse( file_get_contents(dirname(__FILE__) . '/_Markdown/FAQ.md') );
$section = [
    'title' => __( 'FAQ', 'sds-upd-data-year-postsyour-domain-here' ),
    'id'    => 'basic',
    'icon'  => 'el el-home',
		'fields' => [ 
		[
			'id'       => 'opt-raw',
			'type'     => 'raw',
			// 'title'    => __('Raw output', 'redux-framework-demo'),
			// 'subtitle' => __('Subtitle text goes here.', 'redux-framework-demo'),
			// 'desc'     => __('This is the description field for additional info.', 'redux-framework-demo'),
			// 'content'  => $MarkdownParser->parse( file_get_contents(dirname(__FILE__) . '/_Markdown/FAQ.md') )
			'desc'  => $FAQ
		],
		],
];

Redux::set_section( $opt_name__redux_sds_upd_data_year_posts, $section );

/**
 * UPDAE ALL POSTS
 * START
 *********************************/
$year = date("Y");
$section = [
    'title' => __( 'Обновить год постов', 'update-all-posts-sds-upd-data-year-posts' ),
    'id'    => 'posts_updater_sds_upd_data_year_posts',
    'subsection' => false,
    'fields' => [
        [
			'id'       => 'opt-text-sds-upd-data-year-posts',
			'type'     => 'text',
			'title'    => __('Введите год для записей', 'sds-upd-data-year-posts'),
			'subtitle' => __('Если Вы уще прикрепили записи к таксономии <b>"SDStudio Автообновление года"</b> значит вводим нужный год, и жмем кнопку', 'sds-upd-data-year-posts'),
			'desc'     => __('Введите год в формате <b>2015</b>', 'sds-upd-data-year-posts'),
			// 'validate' => 'email',
			'msg'      => 'custom error message',
			// 'default'  => 'test@test.com'
			'default'  => $year
        ],
    ],
    'desc'  => __( 'При клике произойдет перебор абсолютно всех постов блога, и автоматическкое обновление каждого из них.', 'your-domain-here' ),
    // Иконки брать здесь
    // http://elusiveicons.com/icons/
    'icon'  => 'el el-repeat-alt',
];

Redux::set_section( $opt_name__redux_sds_upd_data_year_posts, $section );

// Функция которая исполняется при сохранении настроек плагином
$MyOptionName = 'redux/options/'.$opt_name__redux_sds_upd_data_year_posts.'/saved';
add_action ($MyOptionName, 'test');
function test(){

    /**
     * И получаем введенный год
     * За обработку POST['data'] отвечает 'sds-upd-data-year-posts\_Redux_Framework_Parser_POST_data.php.
     *
     */
    $ReduxFramework_ParserPOSTdata = redux_parse_str( $_POST['data'] );
    global $SDStudio_year;
    $SDStudio_year = $ReduxFramework_ParserPOSTdata['redux_sds_upd_data_year_posts'];
    $SDStudio_year = $SDStudio_year['opt-text-sds-upd-data-year-posts'];

    /**
     * START
     * SDStudio_import_post_status
     * null_import
     */
    if (!empty($SDStudio_year)) {
        function update_all_posts_year_in_data_publish()
        {

            global $SDStudio_year;

            $args = [
                'post_type' => 'post',
                'post_status' => ['publish', 'draft','future'],
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'sds_update_this_post_year',
                        'field' => 'slug',
                        'terms' => 'sdstudio_avtoobnovlenie_goda_da',
                        'operator' => 'IN',
                    ),
                ),
                // Для еденичной проверки
//                 'post__in' => array(8)
                'numberposts' => -1
            ];
            $all_posts = get_posts($args);
//                s($all_posts);

            /**
             * И погнали обрабатывать посты
             */
            foreach ($all_posts as $single_post) {

                $post_id = $single_post->ID;
//                s($single_post);
                $post_date = $single_post->post_date;

                $OLD_post_data = explode('-', $post_date);


                $NEW_post_data = $SDStudio_year . '-' . $OLD_post_data[1] . '-' . $OLD_post_data[2];

                // Обрабатываем дату
                // 2017-02-03 18:31:00

//                s($post_date);
//                s($SDStudio_year);
//                s($OLD_post_data);
//                s($NEW_post_data);
                /**
                 * Применяем обновление даты
                 */
                $single_post->post_title = $single_post->post_title . '';
                $single_post->post_date = $NEW_post_data;
                $single_post->post_date_gmt = $NEW_post_data;
                $single_post->post_status = 'future';

                    wp_update_post( $single_post );
            }
        }

        update_all_posts_year_in_data_publish();
    }
    /**
     * END
     */


}



















































//add_action ($MyOptionName, 'wmpl_save_config_file');
function wmpl_save_config_file(){
//    s('Все супер можем писать код дальше');

    // Функция обновления года
    function action_sdstudio_update_year_for_all_posts() {
        global $wpdb; // this is how you get access to the database


            /**
             * START
             * SDStudio_import_post_status
             * null_import
             */



//Обновление всех постов
            function update_all_posts_year_in_data_publish() {
                $args = [
                    'post_type' => 'post',
                    'post_status' => ['publish','draft'],
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'sds_update_this_post_year',
                            'field'    => 'slug',
                            'terms' => 'sdstudio_avtoobnovlenie_goda_da',
                            'operator' => 'IN',
                        ),
                    ),
                    'numberposts' => -1
                    // Для еденичной проверки
//                    'post__in' => array(16783)
                ];
                $all_posts = get_posts($args);
//                s($all_posts);

                /**
                 * И погнали обрабатывать посты
                 */
                foreach ($all_posts as $single_post){

                    $post_id = $single_post->ID;
                    $post_date = $single_post->post_date;

                    // Обрабатываем дату
                    // 2017-02-03 18:31:00
//                    s($post_date);
//                    s(explode('-',$post_date));

                    $content = $single_post->post_content;

                    $single_post->post_title = $single_post->post_title.'';

                    // Удаляем все черновики
//                if (!empty($_POST['OPT_1_RemoveAllDraftPosts'])) {
//                    if (!empty($_POST['OPT_1_RemoveAllDraftPosts']) && $_POST['OPT_1_RemoveAllDraftPosts'] == 'RemovAllDraft_ENABLE') {
//                        if ($single_post->post_status == 'draft'){
//                            $single_post->post_status = 'trash';
//                        };
//                    }
//                    // Удаляем все опубликованные
//                    if (!empty($_POST['OPT_2_RemoveAllPublishPosts']) && $_POST['OPT_2_RemoveAllPublishPosts'] == 'RemovAllPublish_ENABLE') {
//                        if ($single_post->post_status == 'publish'){
//                            $single_post->post_status = 'trash';
//                        };
//                    }

//                    wp_update_post( $single_post );
                }
            }
            update_all_posts_year_in_data_publish();

            /**
             * END
             */
//            $informer = 'Все записи успешно перемещены в корзину';
//            echo $informer;
//        }

        wp_die(); // this is required to terminate immediately and return a proper response
    }
    action_sdstudio_update_year_for_all_posts();
}

?>