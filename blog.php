<?php
get_header();
echo 'blog.php';
$query = new Wp_query(
	array(
		'post_type' => 'post',
		'posts_per_page' => 3,
		'order' => 'ASC'
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
get_sidebar();
get_footer();
