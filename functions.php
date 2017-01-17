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

function themater_menu_js() {

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

class aces_high_widget extends WP_Widget
{
    public function __construct()
    {
            parent::__construct(
                'aces_high_widget',
                __('Aces High Card widget', 'aces_high_widget'),
                array('description' => __('Branding reinforcement FTW!', 'aces_high_widget'), )
            );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        echo '<img src="' . get_bloginfo('template_url').'/images/aces-high-joker-card.png" style="width:100%;">';
        echo $args['after_widget'];
    }
}
function register_aces_high_widget() { register_widget('aces_high_widget'); }
add_action( 'widgets_init', 'register_aces_high_widget' );

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
    	'id' => 'sidebar-1',
    	'name' => 'Sidebar 1',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(
	array(
		'id' => 'sidebar-2',
    	'name' => 'Sidebar 2',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}

$themename = "GamesMania";
$shortname = str_replace(' ', '_', strtolower($themename));

function get_theme_option($option)
{
	global $shortname;
	return stripslashes(get_option($shortname . '_' . $option));
}

function get_theme_settings($option)
{
	return stripslashes(get_option($option));
}

function cats_to_select()
{
	$categories = get_categories('hide_empty=0'); 
	$categories_array[] = array('value'=>'0', 'title'=>'Select');
	foreach ($categories as $cat) {
		if($cat->category_count == '0') {
			$posts_title = 'No posts!';
		} elseif($cat->category_count == '1') {
			$posts_title = '1 post';
		} else {
			$posts_title = $cat->category_count . ' posts';
		}
		$categories_array[] = array('value'=> $cat->cat_ID, 'title'=> $cat->cat_name . ' ( ' . $posts_title . ' )');
	  }
	return $categories_array;
}

$options = array (
			
	array(	"type" => "open"),
	
	array(	"name" => "Contact Form Email",
		"desc" => "The messages submitted from the contact form will be sent to this email address.",
		"id" => $shortname."_contact_form_email",
		"std" =>  get_option('admin_email'), 
		"type" => "text"),	

    array(	"name" => "Logo Image",
		"desc" => "Enter the logo image full path. Leave it blank if you don't want to use logo image.",
		"id" => $shortname."_logo",
		"std" =>  get_bloginfo('template_url') . "/images/logo.png",
		"type" => "text"),
            
      array(	"name" => "Background Image",
		"desc" => "Enter the background image full path. Leave it blank if you don't want to use background image.",
		"id" => $shortname."_background",
		"std" =>  get_bloginfo('template_url') . "/images/background.jpg",
		"type" => "text"),
        
    array(	"name" => "Featured Posts Enabled?",
			"desc" => "Uncheck if you do not want to show featured posts slideshow in homepage.",
			"id" => $shortname."_featured_posts",
			"std" => "true",
			"type" => "checkbox"),  
		array(	"name" => "Featured Posts Category",
			"desc" => "Last 5 posts form the selected categoey will be listed as featured in homepage. <br />The selected category should contain at last 2 posts with images. <br /> <br /> <b>How to add images to your featured posts slideshow?</b> <br />
            <b>&raquo;</b> If you are using WordPress version 2.9 and above: Just set \"Post Thumbnail\" when adding new post for the posts in selected category above. <br /> 
            <b>&raquo;</b> If you are using WordPress version under 2.9  you have to add custom fields in each post on the  category  you set as featured category. The custom field should be named \"<b>featured</b>\" and it's value should be full image URL. <a href=\"https://flexithemes.com/public/featured_custom_field.jpg\" target=\"_blank\">Click here</a> for a screenshot. <br /> <br />
            In both situation, the image sizes should be: Width: <b>485 px</b>. Height: <b>280 px.</b>",
			"id" => $shortname."_featured_posts_category",
			"options" => cats_to_select(),
			"std" => "0",
			"type" => "select"),
            
            	array(	"name" => "Header Banner (468x60 px)",
			"desc" => "Header banner code. You may use any html code here, including your 468x60 px Adsense code.",
            "id" => $shortname."_ad_header",
            "type" => "textarea",
			"std" => '<a href="https://flexithemes.com/wp-content/pro/b468.php" target="_blank"><img src="https://flexithemes.com/wp-content/pro/b468.gif" alt="Check for details" /></a>'
			),
	array(	"name" => "Sidebar 125x125 px Ads",
		"desc" => "Add your 125x125 px ads here. You can add unlimited ads. Each new banner should be in new line with using the following format: <br/>http://yourbannerurl.com/banner.gif, http://theurl.com/to_link.html",
        "id" => $shortname."_ads_125",
            "type" => "textarea",
			"std" => 'https://flexithemes.com/wp-content/pro/b125-1.gif, https://flexithemes.com/wp-content/pro/b125-1.php
https://flexithemes.com/wp-content/pro/b125-2.gif, https://flexithemes.com/wp-content/pro/b125-2.php
https://flexithemes.com/wp-content/pro/b125-3.gif, https://flexithemes.com/wp-content/pro/b125-3.php
https://flexithemes.com/wp-content/pro/b125-4.gif, https://flexithemes.com/wp-content/pro/b125-4.php'
			),
	
           
        array(	"name" => "Twitter",
			"desc" => "Enter your twitter account url here.",
			"id" => $shortname."_twitter",
			"std" => "http://twitter.com/WPTwits",
			"type" => "text"),
			
	array(	"name" => "Twitter Text",
			"desc" => "",
			"id" => $shortname."_twittertext",
			"std" => "Follow Us on Twitter!",
			"type" => "text"),	
            
        array(	"name" => "Rss Box",
			"desc" => "Show RSS subscription box above sidebar(s)?",
			"id" => $shortname."_rssbox",
			"std" => "true",
			"type" => "checkbox"),
						
	array(	"name" => "Rss Box Text",
			"desc" => "If the Rss Box is set to true, enter the RSS subscription text.",
			"id" => $shortname."_rssboxtext",
			"std" => "Subscribe to Our RSS feed!",
			"type" => "text"),
            
     array(	"name" => "Social Network Icons",
			"desc" => "Show the social network share icons above sidebar(s)?",
			"id" => $shortname."_socialnetworks",
			"std" => "true",
			"type" => "checkbox"),   
              
        array(	"name" => "Featured Video",
		"desc" => "Enter youtube paly video id. Example: http://www.youtube.com/watch?v=<b>SxNJTWZVOQk</b>.",
		"id" => $shortname."_video",
            "type" => "text",
			"std" => "jV0FwIKN17s"
			),
	array(	"name" => "Twitter",
			"desc" => "Enter your twitter account url here.",
			"id" => $shortname."_twitter",
			"std" => "http://twitter.com/WPTwits",
			"type" => "text"),
              
		array(	"name" => "Sidebar 1 Bottom Banner. Max width 125 px. Recommended 120x600 px banner",
		"desc" => "Sidebar 1 Bottom Banner code.",
        "id" => $shortname."_ad_sidebar1_bottom",
            "type" => "textarea",
			"std" => '<div style="text-align:center;"><a href="https://flexithemes.com/wp-content/pro/b160.php" target="_blank"><img src="https://flexithemes.com/wp-content/pro/b160.gif" alt="Check for details" /></a></div>'
			),
	
        
        array(	"name" => "Sidebar 2 Bottom Banner. Max width 260 px. Recommended 250x250 px banner",
		"desc" => "Sidebar 2 Bottom Banner code.",
        "id" => $shortname."_ad_sidebar2_bottom",
            "type" => "textarea",
			"std" => '<div style="text-align:center;"><a href="https://flexithemes.com/wp-content/pro/b260.php" target="_blank"><img src="https://flexithemes.com/wp-content/pro/b260.gif" alt="Check for details" /></a></div>'
			),
	
        
        array(	"name" => "Head Scrip(s)",
		"desc" => "The content of this box will be added immediately before &lt;/head&gt; tag. Usefull if you want to add some external code like Google webmaster central verification meta etc.",
        "id" => $shortname."_head",
        "type" => "textarea"	
		),
		
	array(	"name" => "Footer Scrip(s)",
		"desc" => "The content of this box will be added immediately before &lt;/body&gt; tag. Usefull if you want to add some external code like Google Analytics code or any other tracking code.",
        "id" => $shortname."_footer",
        "type" => "textarea"	
		),
					
	array(	"type" => "close")
	
);

 function ahjw_add_page_break_button( $buttons, $id ){
    if ( 'content' != $id )
        return $buttons;
    array_splice( $buttons, 13, 0, 'wp_page' );
    return $buttons;
}
add_filter( 'mce_buttons', 'ahjw_add_page_break_button', 1, 2 );

function mytheme_add_admin() {
    global $themename, $shortname, $options;
	$get_page = isset($_GET['page']) ? $_GET['page'] : '';
    if ( $get_page == basename(__FILE__) ) {
        
        $get_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
        if ( $get_action == 'save' ) {

                foreach ($options as $value) {
                    if( isset( $value['id'] ) ) {
                        $get_value = isset( $_REQUEST[ $value['id'] ] ) ?  $_REQUEST[ $value['id'] ] : '';
                        if( !empty( $get_value ) ) { 
                            update_option( $value['id'], $get_value ); 
                        } else {
                            delete_option( $value['id'] ); 
                        } 
                    } 
                }
                echo '<meta http-equiv="refresh" content="0;url=themes.php?page=functions.php&saved=true">';
                die;

        } 
    }

    add_theme_page($themename . " Theme Options", "".$themename . " Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin_init() {

    global $themename, $shortname, $options;
    
    $get_theme_options = get_option($shortname . '_options');
    if($get_theme_options != 'yes') {
    	$new_options = $options;
    	foreach ($new_options as $new_value) {
    	    if( isset( $new_value['id'] ) && isset( $new_value['std'] ) ) {
    	        update_option( $new_value['id'],  $new_value['std'] ); 
    	    }
         	
		}
    	update_option($shortname . '_options', 'yes');
    }
}

if(!function_exists('get_sidebars')) {
	function get_sidebars()
	{
		 get_sidebar();
	}
}
	

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( isset( $_REQUEST['saved'] ) ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> Theme Options</h2>
<div style="border-bottom: 1px dotted #000; padding-bottom: 10px; margin: 10px;">Leave blank any field if you don't want it to be shown/displayed.</div>
<form method="post">



<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table width="100%" border="0" style=" padding:10px;">
		
        
        
		<?php break;
		
		case "close":
		?>
		
        </table><br />
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="padding:5px 10px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;

		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:100%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo get_theme_settings( $value['id'] ); ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:100%; height:140px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php echo get_theme_settings( $value['id'] ); ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%">
				<select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
					<?php 
						foreach ($value['options'] as $option) { ?>
						<option value="<?php echo $option['value']; ?>" <?php if ( get_theme_settings( $value['id'] ) == $option['value']) { echo ' selected="selected"'; } ?>><?php echo $option['title']; ?></option>
						<?php } ?>
				</select>
			</td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><?php if(get_theme_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
        <?php 		break;
	
 
} 
}
?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>

<?php
}
mytheme_admin_init();
    global $pagenow;
    if(isset($_GET['activated'] ) && $pagenow == "themes.php") {
        wp_redirect( admin_url('themes.php?page=functions.php') );
        exit();
    }

add_action('admin_menu', 'mytheme_add_admin');

function sidebar_ads_125()
{
	 global $shortname;
	 $option_name = $shortname."_ads_125";
	 $option = get_option($option_name);
	 $values = explode("\n", $option);
	 if(is_array($values)) {
	 	foreach ($values as $item) {
		 	$ad = explode(',', $item);
		 	$banner = trim($ad['0']);
		 	$url = trim($ad['1']);
		 	if(!empty($banner) && !empty($url)) {
		 		echo "<a href=\"$url\" target=\"_new\"><img class=\"ad125\" src=\"$banner\" /></a> \n";
		 	}
		 }
	 }
}

if ( function_exists('add_theme_support') ) {
    add_theme_support('post-thumbnails');
}
?>
<?php
    
    
    if ( function_exists( 'register_nav_menus' ) ) {
    	register_nav_menus(
    		array(
    		  'menu_1' => 'Menu 1',
    		  'menu_2' => 'Menu 2'
    		)
    	);
    }
?>