<?php get_header(); 
    $theme_option = flagship_sub_get_global_options();
    $news_quantity = $theme_option['flagship_sub_news_quantity'];
    $color_scheme = $theme_option['flagship_sub_color_scheme'];
        if ( false === ( $latest_post_query = get_transient( 'latest_post_query' ) ) ) {
        // It wasn't there, so regenerate the data and save the transient
        $latest_post_query = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 1)); 
            set_transient( 'latest_post_query', $latest_post_query, 2592000 );
        } 
        if ( false === ( $news_query = get_transient( 'news_query' ) ) ) {
            // It wasn't there, so regenerate the data and save the transient
            $news_query = new WP_Query(array(
                'post_type' => 'post',
                'offset' => 1,
                'posts_per_page' => 3)); 
               set_transient( 'news_query', $news_query, 2592000 );
        }   

        ?>

<main>
    <?php if( get_header_image() != '' ) { ?>
    <div class="row hide-for-mobile" aria-label="hero image area">
        <div id="slider" class="small-12 columns radius10 no-gutter">
            <div class="slide">
                <img src="<?php header_image(); ?>" class="radius10" alt="header image"/>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="row wrapper radius10" id="page">
    	<div class="small-12 columns">
            <?php if ( $latest_post_query->have_posts() ) : ?>
                    <div class="small-12 medium-6 columns">
                        <h3>Latest <?php echo $theme_option['flagship_sub_feed_name']; ?></h3>
                <?php while ($latest_post_query->have_posts()) : $latest_post_query->the_post(); ?>
                        <div class="row post-container">
                          <article class="small-11 columns centered post news-item" aria-labelledby="post-<?php the_ID(); ?>" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                                <div class="row featured">
                                    <?php the_post_thumbnail('large'); array('class'  => "floatleft", 'itemprop' => 'image'); ?>
                                </div>
                                    <h1 itemprop="headline">
                                        <a href="<?php the_permalink();?>" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a>
                                    </h1>
                                    <div class="entry-content" itemprop="text"> 
                                        <?php the_excerpt(); ?>
                                    </div>
                            </article>
                        </div>
                <?php endwhile; ?>
                    </div>
            <?php endif; ?>
                <div class="small-12 medium-6 columns panel callout radius10 last">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <h1 class="page-title home">About the <?php echo get_bloginfo ( 'description' ); ?> <?php echo get_bloginfo( 'title' ); ?></h1>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
                </div>
        </div>
        <?php if ( $news_query->have_posts() ) : ?>
            <div class="row">
                 <h3><?php echo $theme_option['flagship_sub_feed_name']; ?></h3>
    	           <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
    	                <div class="small-12 medium-4 columns post-container">
    	                    <div class="row">
    	                       <article class="small-11 columns centered post news-item" aria-labelledby="post-<?php the_ID(); ?>" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
            	                   <?php if(has_post_thumbnail()) { ?>
            	                        <div class="row">
            	                            <div class="small-12 columns">
                                                <?php the_post_thumbnail('rss'); array('class'  => "floatleft", 'itemprop' => 'image'); ?>
            	                            </div>
            	                        </div>
                                    <?php } ?>
                                        <div class="row">
                                            <div class="small-12 columns">
                                                <h1 itemprop="headline">
                                                    <a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title();?></a>
                                                </h1>
                                                <div class="entry-content" itemprop="text"> 
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>
                                        </div>
    	                        </article>
    	                    </div>
    	                </div>
    	           <?php endwhile; ?>
            </div>
            <div class="row">
        	    <h5>
                    <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">
                        View All <?php echo $theme_option['flagship_sub_feed_name']; ?>
                    </a>
                </h5>
        	</div>
    	<?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
