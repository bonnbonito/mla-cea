<?php

function filter_posts_where( $where, $wp_query ) {
	global $wpdb;

	if ( $title_like = $wp_query->get( 'title_like' ) ) {
		$where .= " AND {$wpdb->posts}.post_title LIKE '" . esc_sql( $title_like ) . "'";
	}

	return $where;
}

$query = new WP_Query(
	array(
		'post_type'      => 'member',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	)
);

if ( $query->have_posts() ) {
	?>
<style>
:root {
	--filter-color: #058bb1;
}
</style>
<div class="grid gap-4 w-full mb-5">
	<div class="p-6 rounded-md bg-[#eee]">
		<h4 class="filter-title text-base block mb-5 pb-2">
			FILTERS
		</h4>

		<div class="flex gap-3 flex-wrap">
			<?php

			$my_ids = wp_list_pluck( $query->posts, 'ID' );

			$categories = get_terms(
				array(
					'taxonomy'   => 'category',
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
<div class="letter-filters p-6 rounded-md bg-[#eee]">
	<div class="flex gap-2 flex-wrap">
		<?php
		/** Loop from A - Z */

		for ( $i = 65; $i <= 90; $i++ ) {
			$letter = chr( $i );
			add_filter( 'posts_where', 'filter_posts_where', 10, 2 );
			/** Check if a title starting with this letter exists */
			$letter_query = new WP_Query(
				array(
					'post_type'      => 'member',
					'posts_per_page' => 1,
					'orderby'        => 'title',
					'order'          => 'ASC',
					'title_like'     => $letter . '%',
				)
			);

			$disabled = $letter_query->found_posts > 0 ? '' : ' disabled';

			wp_reset_postdata();

			remove_filter( 'posts_where', 'filter_posts_where' );

			?>
		<div class="filter-btn text-xs uppercase text-white weight-light rounded-[5px] p-3 py-2 cursor-pointer <?php echo $disabled; ?>"
			data-letter="<?php echo esc_attr( $letter ); ?>"><?php echo esc_html( $letter ); ?>
		</div>
			<?php
		}
		?>
	</div>
</div>

<div class="grid md:grid-cols-4 gap-3 mt-20 mb-5">

	<?php
	while ( $query->have_posts() ) {
		$query->the_post();
		$categories     = get_the_category();
		$category_names = array();
		$category_slugs = array();
		foreach ( $categories as $category ) {
			$category_names[] = $category->name;
			$category_slugs[] = $category->slug;
		}

		/** Remove category name 'ALL' */
		unset( $category_names[0] );
		?>
	<!-- Output your posts here -->
	<div class="filter-post-item p-6 rounded-md bg-[#eee] flex flex-col justify-between"
		data-title="<?php the_title(); ?>" data-category="<?php echo esc_attr( implode( ' ', $category_slugs ) ); ?>">
		<div>
			<h3 class="uppercase cursor-pointer" data-fancybox
				data-src="#modal-<?php echo esc_attr( get_the_ID() ); ?>">
				<?php the_title(); ?></h3>

			<div class="filter-category text-xs uppercase">
				<?php
				/** Get categories of this post seperated by / */
				echo esc_html( get_field( 'd_subh' ) );
				?>
			</div>
		</div>


		<h4 data-fancybox data-src="#modal-<?php echo esc_attr( get_the_ID() ); ?>"
			class="open-modal cursor-pointer fw-500 block mt-0">
			DETAILS
			></h4>

	</div>
		<?php
	}
	wp_reset_postdata();
	?>
</div>
	<?php

	while ( $query->have_posts() ) {
		$query->the_post();
		$image   = get_field( 'd_img' );
		$contact = get_field( 'd_contact' );
		$website = get_field( 'd_web' );
		?>
<div id="modal-<?php echo esc_attr( get_the_ID() ); ?>" class="filter-post-item p-6 rounded-md bg-[#eee]"
	style="display: none; max-width: 900px; width: 100%; background: #eee;">
	<div class="grid md:grid-cols-[230px_1fr] gap-4">
		<div class="h-[160px] flex justify-center items-center p-4 bg-white">
			<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php the_title(); ?>"
				class="object-contain max-h-[140px]">
			<?php endif; ?>
		</div>
		<div class="md:flex items-end">
			<div class="w-full">
				<h3 class="uppercase"><?php the_title(); ?></h3>
				<div class="filter-category text-xs uppercase" style="margin-bottom: 1em;">
					<?php
					/** Get categories of this post seperated by / */
					echo esc_html( get_field( 'd_subh' ) );
					?>
				</div>
				<div class="grid md:flex gap-4 justify-between items-center">
					<?php if ( $contact ) : ?>
					<h4 class="post-item-contact"><?php echo $contact; ?></h4>
					<?php endif; ?>
					<?php if ( $website ) : ?>
					<a href="<?php echo esc_url( $website ); ?>" class="website-btn text-center"
						style="color: #fff;">Visit
						Website</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<hr>
		<?php if ( get_field( 'd_content' ) ) : ?>
	<div class="filter-modal-content text-sm">
			<?php echo get_field( 'd_content' ); ?>
	</div>
	<?php endif; ?>

</div>
		<?php
	}
	wp_reset_postdata();
}
