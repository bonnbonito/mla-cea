<?php

$tomorrow = date( 'Y-m-d H:i:s', strtotime( '+1 day' ) );

$query = new WP_Query(
	array(
		'post_type'      => 'event',
		'posts_per_page' => -1,
		'order'          => 'ASC',
		'orderby'        => 'meta_value',
		'meta_key'       => 'event_date',
		'meta_type'      => 'DATETIME',
		'meta_query'     => array(
			array(
				'key'     => 'event_date',
				'value'   => $tomorrow,
				'compare' => '>=',
				'type'    => 'DATETIME',
			),
		),
	)
);

if ( $query->have_posts() ) {
	?>
<style>
:root {
	--filter-color: #c20201;
}
</style>
<div class="grid gap-4 w-full mb-5 md:grid-cols-[1fr_33%]">
	<div class="p-6 rounded-md bg-[#eee]">
		<h4 class="filter-title text-base block mb-5 pb-2">
			FILTERS
		</h4>

		<div class="flex gap-3 flex-wrap">
			<?php

			$my_ids = wp_list_pluck( $query->posts, 'ID' );

			$categories = get_terms(
				array(
					'taxonomy'   => 'event-category',
					'object_ids' => $my_ids,
					'orderby'    => 'name',
					'order'      => 'ASC',
				)
			);

			?>
			<div class="filter-btn text-xs uppercase text-white weight-light rounded-[5px] px-4 py-[7px] cursor-pointer active"
				data-category="all">ALL
			</div>
			<?php

			foreach ( $categories as $category ) {
				/** if $category->name is All, continue */
				if ( $category->name == 'All' ) {
					continue;
				}
				?>
			<div class="filter-btn text-xs uppercase text-white weight-light rounded-[5px] px-4 py-[7px] cursor-pointer"
				data-category="<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?>
			</div>
				<?php
			}
			?>
		</div>
	</div>
	<div class="p-6 rounded-md bg-[#eee]">
		<h4 class="filter-title text-base block mb-5 pb-2">
			SEARCH
		</h4>

		<input type="text" id="filter-text-search" class="w-full p-2 rounded-md" placeholder="SEARCH">
	</div>
</div>


<div class="grid md:grid-cols-3 gap-4 md:gap-3 mt-20 mb-5">

	<?php
	while ( $query->have_posts() ) {
		$query->the_post();
		$categories     = get_the_terms( get_the_ID(), 'event-category' );
		$category_names = array();
		$category_slugs = array();
		foreach ( $categories as $category ) {
			$category_names[] = $category->name;
			$category_slugs[] = $category->slug;
		}

		$event_date  = get_field( 'event_date' );
		$date        = DateTime::createFromFormat( 'd/m/Y h:i a', $event_date );
		$date_format = $date->format( 'jS F Y g:i a' );



		/** Remove category name 'ALL' */
		?>
	<!-- Output your posts here -->
	<div class="filter-post-item rounded-md bg-[#eee] flex flex-col justify-between" data-title="<?php the_title(); ?>"
		data-category="all <?php echo esc_attr( implode( ' ', $category_slugs ) ); ?>">
		<div class="h-[180px] relative bg-cea-red event-loop-img">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'full' ); ?>
			<?php endif; ?>
			<span
				class="text-white uppercase p-1 tracking-[1px] text-[12px] bg-cea-red inline-block absolute top-4 right-4"><?php echo implode( ', ', $category_names ); ?></span>
		</div>

		<div class="px-4 py-6">
			<h4 class="text-[14px] uppercase font-[500] text-cea-red"><?php echo get_the_title(); ?></h4>

			<div
				class="text-cea-grey inline-block text-xs leading-4 uppercase font-[500] border-t-[2px] pt-2 border-[#E1E1E1] border-solid border-x-0 border-b-0 mb-4">
				<?php echo $date_format; ?> - <?php echo get_field( 'location' ); ?>
			</div>

			<a href="<?php the_permalink(); ?>" class="text-cea-red text-[12px] tracking-[1px] font-[500] block">VIEW
				EVENT
				></a>

		</div>




	</div>
		<?php
	}
	wp_reset_postdata();
	?>
</div>
	<?php
}
