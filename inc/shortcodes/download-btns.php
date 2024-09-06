<div class="doc-repeater-btns flex justify-between items-center">
	<?php print_r( get_sub_field( 'h' ) ); ?>
	<div>
		<?php if ( get_sub_field( 'free' ) ) : ?>
		<a href="<?php get_sub_field( 'full' )['url']; ?>">DOWNLOAD NOW</a>
		<?php endif; ?>

	</div>
</div>
