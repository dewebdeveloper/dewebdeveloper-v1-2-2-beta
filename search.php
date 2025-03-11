<?php
/**
 * Deze template is voor het weergeven van de zoekresultaten.
 *
 * @package dewebdeveloper
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<div class="wrapper">
		<div class="contentarea clearfix">
			<div id="banner-vervolgpaginas"></div>
			<div class="content">
					<ul>
							<?php if ( have_posts() ) : ?>

					<header class="page-header">
							<p><?php printf( __( 'Resultaten voor: %s', 'dewebdeveloper' ), get_search_query() ); ?></p>
					</header><!-- .page-header -->

											<?php
											// Start loop.
											while ( have_posts() ) : the_post();
											?>
											<div class="search-box-flex">
											<li><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2></li>
											<div class="h-thumbnail"><?php the_post_thumbnail('medium') ?></div>
											<div class="h-omschrijving"><?php echo substr(get_the_excerpt(), 0, 200); ?></div>
													<div class="h-readmore">
															<a href="<?php the_permalink(); ?>"><button>Lees meer</button></a>
													</div>
												</div>
											<?php
											endwhile;
							else :
							// In geval van geen zoekresultaat, include de "Geen resultaat" template.
							get_template_part( 'content', 'none' );
							endif;
							?>
					</ul>

			</div>
		</div>
	</div>
<?php get_footer(); ?>
