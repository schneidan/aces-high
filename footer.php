    </div>
  </div>
		<div id="footer">Copyright &copy; <a href="<?php echo home_url(); ?>"><strong><?php bloginfo('name'); ?></strong></a></div>
</div>
<?php
	 wp_footer();
	echo get_theme_option("footer")  . "\n";
?>
</body>
</html>