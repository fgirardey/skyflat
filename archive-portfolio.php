<?php
get_header();
echo 'archive-portfolio.php';
$taxo = skyflat_get_terms_list('techno');

var_dump($taxo);

$query = new Wp_query(
	array(
		'post_type' => 'portfolio',
		'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'techno',
				'field' => 'slug',
				'terms' => $taxo
			)
		)
	)
);
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

