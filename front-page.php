<?php get_header(); 
    $theme_option = flagship_sub_get_global_options();
    $news_quantity = $theme_option['flagship_sub_news_quantity'];
    $color_scheme = $theme_option['flagship_sub_color_scheme'];
		if ( false === ( $news_query = get_transient( 'news_query' ) ) ) {
			// It wasn't there, so regenerate the data and save the transient
			$news_query = new WP_Query(array(
				'post_type' => 'post',
				'posts_per_page' => 6)); 
				set_transient( 'news_query', $news_query, 2592000 );
		} 	

?>
<?php if( get_header_image() != '' ) { ?>
<div class="row hide-for-mobile">
    <div id="slider" class="small-12 columns radius10 no-gutter">
        <div class="slide">
            <img src="<?php header_image(); ?>" class="radius10" />
        </div>
    </div>
</div>
<?php } ?>
<div class="row wrapper radius10" id="page" role="main">
	<div class="smal-12 columns">
             <div class="panel callout radius10">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <h4><?php the_title(); ?></h4>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
            </div>
	    <?php if ( $news_query->have_posts() ) : ?>
	        <div class="row">
             <h4><?php echo $theme_option['flagship_sub_feed_name']; ?></h4>
	           <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
	                <div class="small-12 medium-4 columns post-container">
	                    <div class="row">
	                        <div class="small-11 columns centered post">
        	                    <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
            	                    <?php if(has_post_thumbnail()) { ?>
            	                        <div class="row">
            	                            <div class="small-12 columns">
            	                                <?php the_post_thumbnail('rss', array('align'=>'center')); ?>
            	                            </div>
            	                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="small-12 columns">
                                            <h5><?php the_title(); ?></h5>
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </div>
        	                    </a>
	                        </div>
	                    </div>
	                </div>
	           <?php endwhile; ?>
	        </div>
        <div class="row">
		    <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><h5 class="black">View All <?php echo $theme_option['flagship_sub_feed_name']; ?></h5></a>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>
