<?php
/*
 * Template Name: Home Page
 * Description: Page d'accueil
 */
?>
<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Skyflat
 */

get_header(); ?>
<?php putRevSlider('homepage','homepage'); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="container">
				<div class="main projects row-fluid">
					<?php
						$query = new Wp_query(
							array(
								'post_type' =>'sticky',
								'posts_per_page' => 3,
								'order' => 'ASC'
							)
						);
						while($query->have_posts()) : $query->the_post();
							?>
								<div class="project col-lg-4 col-sm-12">
					      			<div class="text-center entypo <?= get_post_meta($post->ID, "_icon", true); ?>">
					      				<i class="entypo-large"></i>
					      			</div>
					        		<h3 class="text-center project-name"><?php the_title(); ?></h3>
					        		<div class="text-center project-description">
					        			<?php the_excerpt(); ?>
					        		</div>
					      		</div>
							<?php
						endwhile;
					?>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>