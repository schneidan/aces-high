<div class="span-6 last">
	<div class="sidebar left-sidebar">
		<div id="topsearch" class="widget">
            <?php get_search_form(); ?> 
        </div>
		<?php if(get_theme_option('socialnetworks') != '') {
			?>
    			<div class="addthis_toolbox widget">   
    			    <div class="custom_images">
    			            <a class="addthis_button_twitter"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/twitter.png" width="32" height="32" alt="Twitter" /></a>
    			            <a class="addthis_button_delicious"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/delicious.png" width="32" height="32" alt="Delicious" /></a>
    			            <a class="addthis_button_facebook"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/facebook.png" width="32" height="32" alt="Facebook" /></a>
    			            <a class="addthis_button_digg"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/digg.png" width="32" height="32" alt="Digg" /></a>
    			            <a class="addthis_button_stumbleupon"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/stumbleupon.png" width="32" height="32" alt="Stumbleupon" /></a>
                            <a class="addthis_button_favorites"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/favorites.png" width="32" height="32" alt="Favorites" /></a>
    			            <a class="addthis_button_more"><img src="<?php bloginfo('template_directory'); ?>/images/socialicons/more.png" width="32" height="32" alt="More" /></a>
    			    </div>
    			    <script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js?pub=xa-4a65e1d93cd75e94"></script>
    			</div>
    			<?php
    		}
    	?>
        
        
        <?php if(get_theme_option('video') != '') {
			?>
			<div class="sidebarvideo widget">
				<ul> <li><h2 style="margin-bottom: 10px;">Featured Video</h2>
				<div class="sidebarvideoyoutube"><iframe width="260" height="240" src="//www.youtube.com/embed/<?php echo get_theme_option('video'); ?>" frameborder="0" allowfullscreen></iframe></div>
				</li>
				</ul>
			</div>
		<?php
		}
		?>
        
        <?php
		if(get_theme_option('rssbox') == 'true') {
			?>
    			<div class="rssbox widget">
    				<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/rss.png"  alt="RSS Feed" title="RSS Feed" style="vertical-align:middle; margin-right: 5px;"  /></a><a href="<?php bloginfo('rss2_url'); ?>"><?php echo get_theme_option('rssboxtext'); ?></a>
    			</div>
    			<?php
    		}
    	?>
    	
    	<?php
    		if(get_theme_option('twitter') != '') {
    			?>
    			<div class="twitterbox widget">
    				<a href="<?php echo get_theme_option('twitter'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/twitter.png"  alt="<?php echo get_theme_option('twittertext'); ?>" title="<?php echo get_theme_option('twittertext'); ?>" style="vertical-align:middle; margin-right: 5px;"  /></a><a href="<?php echo get_theme_option('twitter'); ?>"><?php echo get_theme_option('twittertext'); ?></a>
    			</div>
    			<?php
    		}
    	?>
        
    	
			<ul>
				<?php 
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 1') ) : ?>
	
					
				
					<li><h2><?php _e('Recent Posts'); ?></h2>
				               <ul>
						<?php wp_get_archives('type=postbypost&limit=5'); ?>  
				               </ul>
					</li>
					
					<li id="tag_cloud"><h2>Tags</h2>
						<?php wp_tag_cloud('largest=16&format=flat&number=20'); ?>
					</li>
				
					<li> 
						<h2>Calendar</h2>
						<?php get_calendar(); ?> 
					</li>
					
				
				
				<?php include (TEMPLATEPATH . '/recent-comments.php'); ?>
				<?php if (function_exists('get_recent_comments')) { get_recent_comments(); } ?>
				
				<li><h2>Meta</h2>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
						<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
						<?php wp_meta(); ?>
					</ul>
					</li>
						
					
					
				<?php endif; ?>
			</ul>
	
		</div>
	</div>
	
</div>
