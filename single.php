<?php get_header(); ?>
	<div class="span-24" id="contentwrap">	
			<div class="span-18">
				<div id="content">	
					<?php if (have_posts()) : ?>	
						<?php while (have_posts()) : the_post(); ?>
                        <div class="postwrap">
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
							<h2 class="title"><?php the_title(); ?></h2>
							<div class="postdate">Posted by <strong><?php the_author() ?></strong> on  <?php the_time('F jS, Y') ?> <?php if (current_user_can('edit_post', $post->ID)) { ?> | <?php edit_post_link('Edit', '', ''); } ?></div>
			
							<div class="entry">
								<?php if(function_exists('social_warfare')):
								    social_warfare();
								endif;
								the_content('Read more &raquo;');
								wp_link_pages(array('before' => '<div class="page-links"><strong>Pages: </strong>', 'after' => '</div>', 'link_before' => '<span class="page-link-number">', 'link_after' => '</span>', 'next_or_number' => 'number'));
								if(function_exists('social_warfare')):
								    social_warfare();
								endif; ?>
							</div>
							<div class="postmeta">This post is <?php if(get_the_tags()) { the_tags('', ', '); } ?> in <?php the_category(', ') ?></div>
						
							<div class="navigation clearfix">
								<div class="alignleft"><?php previous_post_link('%link', '&laquo; Next Part') ?></div>
								<div class="alignright"><?php next_post_link('%link', 'Last Part &raquo;') ?></div>
							</div>
	
							<?php edit_post_link('Edit this entry','','.'); ?>
						</div><!--/post-<?php the_ID(); ?>-->

						</div>
				
				<?php endwhile; ?>
			
				<?php endif; ?>
				</div>
			</div>
		<?php get_sidebars(); ?>
	</div>
<?php get_footer(); ?>


