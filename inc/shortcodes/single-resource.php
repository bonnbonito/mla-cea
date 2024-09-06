<?php if ( have_rows( 'fce' ) ) : ?>
<div class="block m-auto max-w-[900px] text-center fce">
	<?php
	while ( have_rows( 'fce' ) ) :
		the_row();
		?>
	<div class="mb-12">
		<?php if ( get_row_layout() == 'text' ) : ?>
			<?php echo get_sub_field( 'text' ); ?>
			<?php
		elseif ( get_row_layout() == 'cta' ) :
			?>
		<h3><?php echo get_sub_field( 'heading' ); ?></h3>
		<div class="mb-4"><?php echo get_sub_field( 'message' ); ?></div>
			<?php if ( get_sub_field( 'external' ) ) : ?>
		<a href="<?php echo esc_url( get_sub_field( 'destination' ) ); ?>"
			class="text-xs  px-3 py-2 bg-[#c20201] hover:bg-[#c20201] inline-block text-white hover:text-white rounded-md no-underline"
			target="_blank" rel="nofollow"><?php echo get_sub_field( 'button' ); ?></a>
		<?php else : ?>
		<a href="<?php echo esc_url( get_sub_field( 'destination' ) ); ?>"
			class="text-xs  px-3 py-2 bg-[#c20201] hover:bg-[#c20201] inline-block text-white rounded-md no-underline hover:text-white"><?php echo get_sub_field( 'button' ); ?></a>

		<?php endif; ?>

		<?php endif; ?>
	</div>
	<?php endwhile; ?>
</div>
<?php endif; ?>
