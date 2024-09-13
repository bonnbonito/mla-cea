<?php if ( have_rows( 't_qualifications' ) ) : ?>
<div class="grid gap-7">
	<?php
	while ( have_rows( 't_qualifications' ) ) :
		$htitle       = get_sub_field( 'h' );
		$dev          = get_sub_field( 'dev' );
		$more_content = get_sub_field( 'p' );
		the_row();
		if ( $htitle ) :
			?>
	<div class="bg-white p-6 rounded-md shadow-sm gap-4 <?php echo ( $dev ? 'mod-dev' : '' ); ?>">
		<div class="block">
			<div class="mb-4">
				<h3 class="uppercase text-sm text-[#ff723a] pb-1"
					style="border-bottom: 2px solid #ff723a; margin-bottom: 14px;">
					<?php echo esc_html( $htitle ); ?></h3>
			</div>
			<div class="text-sm leading-6">
				<?php echo $more_content; ?>
			</div>

		</div>
	</div>

			<?php
		endif;
	endwhile;
	?>
</div>

	<?php
endif;
