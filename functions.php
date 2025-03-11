<?php

// -----------------------------------------------------
// {;} Admin Dashboard Widgets
// -----------------------------------------------------
add_action( 'wp_dashboard_setup', 'seo_dashboard_add_widgets' );
function seo_dashboard_add_widgets() {
    wp_add_dashboard_widget(
        'dd_dashboard_widget_news',
        __( '<img src="/wp-content/themes/dewebdeveloper/assets/images/favicon-small-logo.svg"> De Web Developer Status', 'dd' ),
        'dd_dashboard_widget_news_handler'
    );
}

function dd_dashboard_widget_news_handler() {
    echo '
    <style>
        #dd_dashboard_widget_news .hndle.ui-sortable-handle { max-width: 188px !important; }
    </style>
    <iframe class="dwd-notificaties" src="https://repository.dwsdgroep.nl/notificaties/notificaties-wordpress.php" style="border:0px #ffffff none;" name="myiFrame" scrolling="yes"
    frameborder="1" marginheight="0px" marginwidth="0px" height="550px" width="100%" allowfullscreen></iframe>
    ';
}

// -----------------------------------------------------
// {;} Styles en Scripts
// -----------------------------------------------------
function childtheme_parent_styles() {
    // Laad de stylesheet van het ouderthema
    wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'childtheme_parent_styles' );

// Admin Dashboard styling
function admin_style() {
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/wp-admin/wp-admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

// Login pagina styling
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/wp-admin/wp-admin.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

// Favicon voor admin pagina
function favicon4admin() {
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo('wpurl') . '/wp-content/themes/dewebdeveloper/wp-admin/images/favicon.ico" />';
}
add_action( 'admin_head', 'favicon4admin' );


// -----------------------------------------------------
// {;} Admin Bar en Menu Instellingen
// -----------------------------------------------------
function custom_button_example($wp_admin_bar){
    $args = array(
        'id' => 'custom-button',
        'title' => '<img src="/wp-content/themes/dewebdeveloper/assets/images/favicon-small-logo.svg"> <script src="//code.tidio.co/sb4sxgsslwdf4dfikklvsz4lpitkrbdh.js" async></script>',
        'href' => '/wp-admin/admin.php?page=page%3Ddistributie',
        'meta' => array(
            'class' => 'custom-button-class'
        )
    );
    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'custom_button_example', 50);

// Menu pagina toevoegen
function my_admin_menu() {
    add_menu_page(
        __( '<img src="/wp-content/themes/dewebdeveloper/assets/images/favicon-small-logo.svg"> Distributie', 'my-textdomain' ),
        __( '<img src="/wp-content/themes/dewebdeveloper/assets/images/favicon-small-logo.svg"> Distributie', 'my-textdomain' ),
        'manage_options',
        'page=distributie',
        'my_admin_page_contents',
        'dashicons-schedule',
        3
    );
}
add_action( 'admin_menu', 'my_admin_menu' );

// Admin pagina inhoud (iframe)
function my_admin_page_contents() {
    echo '<div class="distributie-pagina">
            <iframe src="/wp-content/themes/dewebdeveloper/distributie/" style="border:0px #ffffff none;" name="myiFrame" scrolling="yes"
            frameborder="1" marginheight="0px" marginwidth="0px" height="1300px" width="100%" allowfullscreen></iframe>
          </div>';
}

// ++ Repository pagina (Linker menu)
function my_admin_menu_repository() {
    add_menu_page(
        __('Repository', 'my-textdomain'), // Paginatitel
        '<img src="' . get_stylesheet_directory_uri() . '/assets/images/favicon-small-logo.svg"> Repository', // Menu-item met icoon
        'manage_options',
        'repository', // Unieke slug voor de pagina
        'my_admin_page_contents_repository', // Callback-functie voor de inhoud
        'dashicons-archive', // WordPress Dashicon
        3 // Menupositie
    );
}
add_action('admin_menu', 'my_admin_menu_repository');

// Functie om de inhoud van de Repository pagina weer te geven
function my_admin_page_contents_repository() {
    ?>
    <div class="repository-pagina">
        <iframe
            src="https://repository.dwsdgroep.nl/"
            style="border:0; width:100%; height:1300px;"
            frameborder="0"
            scrolling="yes"
            allowfullscreen>
        </iframe>
    </div>
    <?php
}

// Voeg een specifieke CSS-class toe aan de body van de admin-pagina als we op de Repository-pagina zijn
function add_repository_body_class($classes) {
    if (isset($_GET['page']) && $_GET['page'] === 'repository') {
        $classes .= ' repository-page'; // Voeg 'repository-page' class toe
    }
    return $classes;
}
add_filter('admin_body_class', 'add_repository_body_class');



// -----------------------------------------------------
// {;} Overige instellingen en configuraties
// -----------------------------------------------------

// SVG als veilige bestendtype
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    return array_merge($file_types, $new_filetypes);
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

// Custom menu registratie
function wpb_custom_new_menu() {
    register_nav_menu('my-custom-menu',__( 'My Custom Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

// FontAwesome integratie
add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
function enqueue_load_fa() {
    wp_enqueue_style( 'load-fa', get_stylesheet_directory_uri() . '/fontawesome-v6/css/all.css' );
}

// -----------------------------------------------------
// {;} Footer
// -----------------------------------------------------
function storefront_credit() {
    echo '<div class="site-info">
            © ' . date("Y") . ' ' . get_bloginfo( 'name' ) . '. Alle rechten voorbehouden. Ontwikkeling door <a href="https://www.dewebdeveloper.nl" target="_blank" title="De Web Developer - Amsterdam" rel="author">
            De Web Developer <img src="/wp-content/themes/dewebdeveloper/assets/images/favicon-small-logo.svg" alt="Webdesign en webdevelopment Amsterdam"></a>
          </div>';
}
