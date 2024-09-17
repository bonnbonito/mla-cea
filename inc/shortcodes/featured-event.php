<?php
$featured_event = get_field( 'event_featured' );

if ( ! $featured_event ) {
	return;
}



foreach ( $featured_event as $post ) :
	setup_postdata( $post );
	$event_date      = get_field( 'event_date' );
		$date        = DateTime::createFromFormat( 'd/m/Y h:i a', $event_date );
		$date_format = $date->format( 'jS F Y g:i a' );
	?>
<div class="featured-event flex gap-4 items-start">
	<div class="grow flex gap-4">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="event-image shadow-md p-2 bg-white">
			<?php the_post_thumbnail( 'medium' ); ?>
		</div>
		<?php endif; ?>
		<div class="p-4 max-w-[415px]">
			<h4 class="text-[16px] uppercase font-[500] text-cea-red"><?php echo get_the_title(); ?></h4>

			<div
				class="text-cea-grey text-xs leading-4 uppercase font-[500] border-t-[2px] pt-2 border-[#E1E1E1] border-solid border-x-0 border-b-0 mb-4">
				<?php echo $date_format; ?> - <?php echo get_field( 'location' ); ?>
			</div>

			<a href="<?php the_permalink(); ?>" class="text-cea-red text-[12px] tracking-[1px] font-[500]">VIEW EVENT
				></a>

		</div>
	</div>
	<span class="text-white uppercase p-1 text-sm bg-cea-red inline-block ">Featured Event</span>
</div>
	<?php
	endforeach;
	wp_reset_postdata();
