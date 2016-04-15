<?php
/*
Template Name: People Directory
*/
?>	

<?php get_header(); 
	$theme_option = flagship_sub_get_global_options();
	$roles = get_terms('role'); 
	$filters = get_terms('filter', array(
						'orderby'       => 'ID', 
						'order'         => 'ASC',
						'hide_empty'    => true, 
						));
	$role_slugs = array();
	$filter_slugs = array();
	foreach($roles as $role) {
		$role_slugs[] = $role->slug;
	}
	$role_classes = implode(' ', $role_slugs);
	foreach($filters as $filter) {
		$filter_slugs[] = $filter->slug;
	}
	$filter_classes = implode(' ', $filter_slugs);
	?>

<div class="row wrapper radius10">
<div class="small-12 columns">
	<main class="content row" role="main">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h1 class="page-title"><?php the_title();?></h1>
		<?php endwhile; endif; ?>
		<?php $theme_option = flagship_sub_get_global_options();
				if ( $theme_option['flagship_sub_directory_search']  == '1' ) { get_template_part('parts', 'directory-search'); } ?>
	</main>



	<section class="row" id="fields_container">
		<ul class="small-12 columns" id="directory">
		<?php foreach($roles as $role) {
			$role_slug = $role->slug;
			$role_name = $role->name;
				$people_query = new WP_Query(array(
						'post_type' => 'people',
						'role' => $role_slug,
						'filter' => $program_slug,
						'meta_key' => 'ecpt_people_alpha',
						'orderby' => 'meta_value',
						'order' => 'ASC',
						'posts_per_page' => '-1'));        	
			
			if ($people_query->have_posts()) : ?>
				<li class="person sub-head quicksearch-match <?php echo $role->slug; ?>"><h2 class="black capitalize"><?php echo $role_name; ?></h2></li>
			<?php while ($people_query->have_posts()) : $people_query->the_post(); ?>
				<li class="person <?php echo get_the_directory_filters($post);?> <?php echo get_the_roles($post); ?>">
					<div class="row">
						<div class="small-12 columns">
							
							<?php if ( has_post_thumbnail()) :?>
								<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field">
									<?php the_post_thumbnail('directory', array('class' => 'padding-five floatleft hide-for-small'));?>
								</a> 
							<?php endif; ?>			    
								<h4 class="no-margin"><a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php the_title(); ?></a></h4>

								<?php if ( get_post_meta($post->ID, 'ecpt_position', true) ) : ?><h5><?php echo get_post_meta($post->ID, 'ecpt_position', true); ?></h5><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'ecpt_degrees', true) ) : ?><?php echo get_post_meta($post->ID, 'ecpt_degrees', true); ?><?php endif; ?>
								<p class="contact no-margin">
									<?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?>
										<span class="icon-mobile"><?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?></span>
									<?php endif; ?>
									<?php if ( get_post_meta($post->ID, 'ecpt_fax', true) ) : ?>
										<span class="icon-printer"><?php echo get_post_meta($post->ID, 'ecpt_fax', true); ?></span>
									<?php endif; ?>
									<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : ?>
										<span class="icon-mail"><a href="mailto:<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>">
										
										<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?> </a></span>
									<?php endif; ?>
									<?php if ( get_post_meta($post->ID, 'ecpt_office', true) ) : ?>
										<span class="icon-location"><?php echo get_post_meta($post->ID, 'ecpt_office', true); ?></span>
									<?php endif; ?>
								</p>
						<?php if ( get_post_meta($post->ID, 'ecpt_expertise', true) ) : ?>
							<p><strong>Research Interests:&nbsp;</strong>
								<?php echo get_post_meta($post->ID, 'ecpt_expertise', true); ?>
							</p>
						<?php endif; ?>
					</div>
				</li>		
		<?php endwhile; endif; } wp_reset_postdata(); ?>
		<!-- Page Content -->
		
	<?php if ( $theme_option['flagship_sub_directory_search']  == '1' ) { ?>
	<div class="row" id="noresults">
		<div class="small-4 columns centered">
		</div>
	</div>
	<?php } ?>
</ul>
</section>
	<div class="row">
		<div class="small-12 columns">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();  the_content(); endwhile; endif; ?>
		</div>
	</div>	
</div>
</div> <!-- End content wrapper -->
<?php get_footer(); ?>