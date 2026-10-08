<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package indsro
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 'col-xxl-8 col-xl-8 col-lg-8' : 'col-lg-12';
?>

<div class="tx-blog-area blog-grid-area pt-120 pb-120 fix">
    <div class="container">
        <div class="row">
			<div class="<?php print esc_attr( $blog_column );?>">
				<div class="blog__wrapper blog-list-content fti-blog-grid-item-wrap">
					<?php
						if ( have_posts() ):
    					if ( is_home() && !is_front_page() ):
    				?>
					<?php
						endif;
							/* Start the Loop */
							while ( have_posts() ): the_post();
								get_template_part( 'post-formats/content', get_post_format() );
							endwhile;
						?>
						<div class="fti-pagination-wrap tx-pagination">
							<?php
								indsro_pagination( '
									<i class="fa-solid fa-angles-left fti-pagination-icon"></i>',
									'<i class="fa-solid fa-angles-right fti-pagination-icon"></i>  ',
									'',
									['class' => '']
								);
							?>
						</div>
						<?php
						else:
							get_template_part( 'post-formats/content', 'none' );
						endif;
					?>
				</div>
			</div>

			<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
			<div class="col-xxl-4 col-xl-4 col-lg-4 mt-30 mt-lg-0">
				<div class="tx-sidebarWrapper blog-grid-sidebar">
					<?php get_sidebar();?>
				</div>
			</div>
			<?php endif;?>
        </div>
    </div>
</div>

<?php
get_footer();
