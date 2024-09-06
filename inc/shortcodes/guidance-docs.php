<?php if ( have_rows( 't_books' ) ) : ?>
<div class="grid gap-7">
	<?php
	while ( have_rows( 't_books' ) ) :
		$htitle        = get_sub_field( 'h' );
		$dev           = get_sub_field( 'dev' );
		$excerpt       = get_sub_field( 'excerpt' );
		$more_content  = get_sub_field( 'p' );
		$preview_img   = get_sub_field( 'img' );
		$price         = get_sub_field( 'price' );
		$free          = get_sub_field( 'free' );
		$sample        = get_sub_field( 'sample' );
		$order_form    = get_sub_field( 'form' );
		$free_download = get_sub_field( 'full' );
		the_row();
		if ( $htitle ) :
			?>
	<div class="bg-white p-6 rounded-md shadow-sm md:flex flex-row gap-4">
			<?php if ( $preview_img ) : ?>
		<div class="border-4 border-[#eee] border-solid md:max-w-[180px] w-full mb-4 md:mb-0">
			<img src="<?php echo esc_url( $preview_img['url'] ); ?>" alt="<?php echo esc_attr( $htitle ); ?>"
				class="object-contain max-h-[230]">
		</div>
		<?php endif; ?>
		<div class="flex justify-between">
			<div class="block md:flex md:flex-col">
				<div class="mb-4">
					<h3 class="uppercase text-sm text-[#ff723a] pb-1"
						style="border-bottom: 2px solid #ff723a; margin-bottom: 14px;">
						<?php echo esc_html( $htitle ); ?></h3>
					<div class="text-sm leading-6"><?php echo $excerpt; ?></div>
				</div>
				<div class="mt-auto md:flex justify-between items-center gap-4">
					<div class="mb-4 md:mb-0">
						<?php if ( $order_form && $price && ! $free ) : ?>
						<a href="<?php echo esc_url( $order_form ); ?>"
							class="text-xs px-3 py-2 bg-[#ff723a] hover:bg-[#ff7b47] inline-block text-white rounded-md no-underline"
							style="color: #fff !important;" target="_blank">ORDER NOW (<?php echo $price; ?>)</a>
						<?php endif; ?>
						<?php if ( $free && $free_download ) : ?>
						<a href="<?php echo esc_url( $free_download ); ?>"
							class="text-xs px-3 py-2 bg-[#ff723a] hover:bg-[#ff7b47] inline-block text-white rounded-md no-underline"
							style="color: #fff !important;" target="_blank">DOWNLOAD NOW</a>
						<?php endif; ?>
					</div>
					<div class="flex gap-4 justify-between md:justify-end">

						<?php if ( $sample ) : ?>
						<a href="<?php echo esc_url( $sample ); ?>"
							class="font-[500] text-xs text-[#ff723a] hover:text-[#ff723a]" target="_blank">VIEW
							SAMPLE ></a>
						<?php endif; ?>

						<?php if ( ! $dev ) : ?>
						<h3 style="margin: 0;" class="uppercase cursor-pointer text-xs text-[#ff723a]" data-fancybox
							data-src="#modal-<?php echo get_row_index(); ?>">FIND OUT MORE ></h3>
						<?php endif; ?>
					</div>
				</div>

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

while ( have_rows( 't_books' ) ) :
		the_row();
		$htitle        = get_sub_field( 'h' );
		$dev           = get_sub_field( 'dev' );
		$excerpt       = get_sub_field( 'excerpt' );
		$more_content  = get_sub_field( 'p' );
		$preview_img   = get_sub_field( 'img' );
		$price         = get_sub_field( 'price' );
		$free          = get_sub_field( 'free' );
		$sample        = get_sub_field( 'sample' );
		$order_form    = get_sub_field( 'form' );
		$free_download = get_sub_field( 'full' );

	if ( $htitle ) :
		?>
<div id="modal-<?php echo get_row_index(); ?>" class="filter-post-item p-6 rounded-md bg-[#eee]"
	style="display: none; max-width: 900px; width: 100%; background: #eee; max-height: 600px;">
	<div class="block overflow-y-auto">
		<h2 class="text-black text-[24px] mb-6 uppercase"><?php echo esc_html( $htitle ); ?></h2>
		<div class="mb-8"><?php echo $more_content; ?></div>
		<?php if ( $order_form ) : ?>
		<a href="<?php echo esc_url( $order_form ); ?>"
			class="text-xs px-3 py-2 bg-[#ff723a] hover:bg-[#ff7b47] inline-block text-white rounded-md no-underline"
			style="color: #fff !important;" target="_blank">ORDER NOW (<?php echo $price; ?>)</a>
		<?php endif; ?>
	</div>
</div>

		<?php
			endif;
		endwhile;
