<?php
$query = new WP_Query(
	array(
		'post_type'      => 'resource',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	)
);

if ( $query->have_posts() ) {
	?>
<style>
:root {
	--filter-color: #fb9900;
}
</style>
<div class="grid md:grid-cols-[1fr_33%] gap-4 w-full mb-5">
	<div class="p-6 rounded-md bg-[#eee]">
		<h4 class="filter-title text-base block mb-5 pb-2">
			FILTERS
		</h4>

		<div class="flex gap-4 flex-wrap">
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
				echo esc_html( implode( '/', $category_names ) );
				?>
			</div>
		</div>


		<a href="<?php echo esc_url( get_permalink() ); ?>" class="view-btn">VIEW ></a>

	</div>
		<?php
	}
	wp_reset_postdata();
	?>
</div>
<?php } ?>
