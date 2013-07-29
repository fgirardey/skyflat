<?php
do_action('skyflat-before-header');
get_header();
echo 'single-portfolio.php';
$taxo = get_query_var('techno');
$taxo_list = skyflat_get_terms_list('techno');

var_dump(get_query_var('portfolio'));

$query = new Wp_query(
	array(
		'post_type' => 'portfolio',
		'portfolio' => get_query_var('portfolio'),
		'techno' => $taxo,
		'order' => 'ASC'
	)
);
echo '<pre>';
//var_dump($query);
echo '</pre>';
while($query->have_posts()) : $query->the_post();
	?>
		<div class="project span4">
			<?= get_the_term_list( $query->post->ID, 'techno') ?>
    		<h3 class="text-center project-name"><?php the_title(); ?></h3>
    		<div class="text-center project-description">
    			<?php the_excerpt(); ?>
    		</div>
  		</div>
	<?php
endwhile;
get_footer();

