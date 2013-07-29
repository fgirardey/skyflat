<?php
get_header();
echo 'taxonomy-techno.php';
echo '<pre>';
$taxonomies = get_terms(get_query_var('taxonomy'));
$taxs = array();
foreach ($taxonomies as $taxonomy) {
	var_dump($taxonomy->slug);
	array_push($taxs, $taxonomy->slug);
}
echo '</pre>';

$query = new Wp_query(
	array(
		'post_type' => 'portfolio',
		'posts_per_page' => 3,
		'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'techno',
				'field' => 'slug',
				'terms' => get_query_var('term')
			)
		)
	)
);
while($query->have_posts()) : $query->the_post();
	?>
		<div class="project span4">
			<?= get_the_term_list( $query->post->ID, get_query_var('taxonomy')) ?>
    		<h3 class="text-center project-name"><?php the_title(); ?></h3>
    		<div class="text-center project-description">
    			<?php the_excerpt(); ?>
    		</div>
  		</div>
	<?php
endwhile;
get_footer();
