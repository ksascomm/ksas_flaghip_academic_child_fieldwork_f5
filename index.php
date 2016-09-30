<?php get_header();    $theme_option = flagship_sub_get_global_options(); ?>
<div class="row wrapper radius10" id="page">
	<div class="small-12 columns">
	<?php locate_template('parts/nav-breadcrumbs.php', true, false);?>
		<main class="content archive">
			<h1 class="page-title"><?php echo $theme_option['flagship_sub_feed_name']; ?></h1>
			<?php 
				$paged = (get_query_var('paged')) ? (int) get_query_var('paged') : 1;
				if ( false === ( $news_archive_query = get_transient( 'news_archive_query_' . $paged ) ) ) {
					if ($news_query_cond === 1) {
						$news_archive_query = new WP_Query(array(
							'post_type' => 'post',
							'tax_query' => array(
								array(
									'taxonomy' => 'category',
									'field' => 'slug',
									'terms' => array( 'books' ),
									'operator' => 'NOT IN'
								)
							),
							'posts_per_page' => 10,
							'paged' => $paged)); 
					} else {
						$news_archive_query = new WP_Query(array(
							'post_type' => 'post',
							'posts_per_page' => 10,
							'paged' => $paged
							)); 
					}
						set_transient( 'news_archive_query_' . $paged, $news_archive_query, 2592000 );
				} 	

			while ($news_archive_query->have_posts()) : $news_archive_query->the_post(); ?>
			<article id="post-<?php the_ID(); ?>">
				<header class="entry-header">
					<h3 class="uppercase black"><?php the_time( get_option( 'date_format' ) ); ?></h3>
					<h2>
						<a href="<?php the_permalink(); ?>" title="<?php the_title();?>">	
							<?php the_title();?>
						</a>
					</h2>
				</header><!-- .entry-header -->		
				<div class="entry-content">
						<?php if ( has_post_thumbnail()) { ?> 
							<?php the_post_thumbnail('thumbnail', array('class'	=> "floatleft")); ?>
						<?php } ?>
					<?php the_excerpt(); ?>
					<hr>
				</div>	
			</article>		
				<?php endwhile; ?>
			<div class="row">
				<?php flagship_pagination($news_archive_query->max_num_pages); ?>		
			</div>
		</main>	
	</div>	<!-- End main content (left) section -->
</div> <!-- End #landing -->
<?php get_footer(); ?>