<?php
    add_theme_support( 'woocommerce' );
    add_theme_support("custom-background");
    add_theme_support("post-thumbnails");
    
    add_action( 'wp_enqueue_scripts', 'flexi_scripts_styles');
    
    function flexi_scripts_styles() {
        wp_enqueue_script( 'mobilemenu', get_template_directory_uri() . '/lib/js/jquery.mobilemenu.js', array('jquery') );
    }

    if ( ! function_exists( '_wp_render_title_tag' ) ) {
        function flxi_slug_render_title() {
            echo '<title>' . wp_title( '-', false, 'right' ) . '</title>';
        }
        add_action( 'wp_head', 'flxi_slug_render_title' );
    }
    
    function flexi_title_setup() {
       add_theme_support( 'title-tag' );
    }
    add_action( 'after_setup_theme', 'flexi_title_setup' );

    add_action('wp_footer', 'themater_menu_js'); 
    
    function themater_menu_js()
    {

       $return = "<script type='text/javascript'>\n";
            $return .= '/* <![CDATA[ */' . "\n";
        
            $return .= "if (jQuery('#pagemenucontainer').length > 0) {
               jQuery('#pagemenucontainer').mobileMenu({
                    defaultText: 'Menu',
                    className: 'menu-primary-responsive',
                    containerClass: 'menu-primary-responsive-container',
                    subMenuDash: '&ndash;'
                });
            } else if (jQuery('#pagemenu').length > 0) {
                jQuery('#pagemenu').mobileMenu({
                    defaultText: 'Menu',
                    className: 'menu-primary-responsive',
                    containerClass: 'menu-primary-responsive-container',
                    subMenuDash: '&ndash;'
                });
            } \n";
            
             $return .= "if (jQuery('#navcontainer').length > 0) {
                jQuery('#navcontainer').mobileMenu({
                    defaultText: 'Navigation',
                    className: 'menu-secondary-responsive',
                    containerClass: 'menu-secondary-responsive-container',
                    subMenuDash: '&ndash;'
                });
            } else if (jQuery('#nav').length > 0) {
                jQuery('#nav').mobileMenu({
                    defaultText: 'Navigation',
                    className: 'menu-secondary-responsive',
                    containerClass: 'menu-secondary-responsive-container',
                    subMenuDash: '&ndash;'
                });
            } else if (jQuery('.navcontainer').length > 0) {
                jQuery('.navcontainer').mobileMenu({
                    defaultText: 'Navigation',
                    className: 'menu-secondary-responsive',
                    containerClass: 'menu-secondary-responsive-container',
                    subMenuDash: '&ndash;'
                });
            } \n";
 
        $return .= '/* ]]> */' . "\n";
        $return .= '</script>' . "\n";
            echo $return;
    }
?>