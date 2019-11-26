	<?php 


	/* Template Name: Blog-Template */ 

	get_header('blog');

	?>
<div role="main" class="main">

	<section class="page-header" >
	<div class="container">
	<div class="row align-items-center">
	<?php 
	$blog = new WP_Query( array( 'post_type' => 'post','order' => 'desc','posts_per_page' => 1) );
	if ( $blog->have_posts() ) :
	while ($blog->have_posts()) : $blog->the_post();
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
	$bimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'full'); ?>
	<div class="col-md-8 text-left">
	<span class="tob-title text-color-primary d-block">Latest Blog</span>
	<h1 class="font-weight-bold"><?=$blog->post->post_title;?></h1>
	<p class="lead" style="padding-bottom: 20px;"><?php echo substr($blog->post->post_content,0,180);?></p>
	<a class="btn btn-secondary btn-5 btn-fs-5 mb-2" href="<?=site_url()?>/index.php/<?=$blog->post->post_name?>">Read More</a>
	</div>
	<div class="col-md-4">
	<div class="image-frame">
	<img src="<?=$bimage[0]?>" class="img-fluid" alt="">
	</div>
	</div>
	<?php  endwhile;wp_reset_postdata();endif; ?>
	</div>
	</div>
	</section>


	<?php

	$post_type = $_GET['post_type'];

	if ( isset( $post_type ) && !empty($post_type) ) {
	// if so, load that template
	get_template_part( 'search', $post_type );

	// and then exit out
	exit;
	}

	?>	


	<div class="container1">
	<div class="accordion accordion-default accordion-toggle accordion-style-1 mb-0" role="tablist">

	<div class="row align-items-left mb-0">


	<div class="col-md-2" data-appear-animation="fadeInLeftShorter" style="background-color: #ffffff; padding-top: 15px; padding-right: 0px; padding-top: 18px;">

	<?php $i=o;  $categories = get_categories(); 
$categoryList = explode('.',$_COOKIE['cat_id']);

	foreach ($categories as $cat) {
      if(empty($cat->parent) && $cat->parent == 0){   
	?>
	<div class="card">
	<div class="card-header accordion-header" role="tab" id="categories" style="" >
	<h3 class="text-3 mb-0" style="padding-left: 18px;">
	<a href="<?=site_url()?>/index.php/blog-detail?cat_id=<?=$cat->cat_ID?>" data-toggle="collapse" target="_blank" style=" color:#00c19e; font-size: 1.1rem;"  data-target="#toggleCategories_<?=$i?>" aria-expanded="false" aria-controls="toggleCategories"><?=$cat->name;?></a>
	</h3>
	</div>
	<div id="toggleCategories_<?=$i?>" class="accordion-body collapse show" aria-labelledby="categories">
	<div class="card-body">
	<ul id="portfolioLoadMoreFilter" type="none" class="sort-source" data-sort-id="portfolio" data-option-key="filter" data-plugin-options="{'layoutMode': 'fitRows', 'filter': '*'}">
	<?php $args = array('child_of' => $cat->term_id); $sub_categories = get_categories( $args ); foreach( $sub_categories as $sub_cat){ ?>
	<li class="nav-item mb-1" style="line-height: 2px;" >
            <input class="checkbox11" name="selector[]" type="checkbox" <?php if (in_array($sub_cat->cat_ID, $categoryList)){ echo "checked"; } ?> value="<?=$sub_cat->cat_ID?>">
            <label><a class="nav-link anchor_move" target="_blank" href="<?=site_url()?>/index.php/blog-detail?cat_id=<?=$sub_cat->cat_ID?>"><?=$sub_cat->name?></a></label>
        </li>

	<?php }?>
	</ul>
	</div>
	</div>
	</div>
	<?php $i++; } }?>




	<div class="card" id="posttags">
	<div class="card-header accordion-header" role="tab" id="tags" style="">
	<h3 class="text-3 mb-0" style="padding-left: 18px;">
	<a href="#" data-toggle="collapse" data-target="#toggleTags" style=" color:#00c19e; font-size: 1.1rem;"   aria-expanded="false" aria-controls="toggleTags">Tags</a>
	</h3>
	</div>
	<div id="toggleTags" class="accordion-body collapse show" role="tabpanel" aria-labelledby="tags" style="padding-bottom: 15px; padding-left:30px;">
	<div class="card-body">
	<ul class="list-inline">
	<?php $tags = get_tags(array('hide_empty' => false));  
	foreach ($tags as $key => $value) {   ?>
	<li class="list-inline-item"><a href="<?=site_url()?>/index.php/blog-detail?post_tag=<?=$value->name?>" class="badge badge-dark badge-sm badge-pill px-3 py-2 mb-2"><?php echo $value->name;?></a></li>
	<?php } ?>
	</ul>
	</div>
	</div>
	</div>
	</div>


	<div class="col-md-10" style="padding-left: 50px; padding-right: 50px;">

	<div class="accordion accordion-default accordion-toggle accordion-style-1" role="tablist" >
	<div class="card" style="margin-bottom: 40px; margin-top: 40px; margin-left:140px;">
	<div id="toggleSidebarSearch" class="accordion-body accordion-body-show-border-top collapse show" role="tabpanel" aria-labelledby="sidebarSearchForm" >


	<form id="sidebarSearchForm" class="sidebar-search" action="https://www.smaartt.com/blog/" method="get">
	<div class="input-group" style=" width: 80%; border-bottom: 1.3px solid #e8e8e8; ">
	<input type="text" class="form-control line-height-1 bg-light-5" style="" placeholder="<?php echo "Search …"?>" value="<?php echo $_GET['sea'] ?>" name="sea" >
	<!-- <input type="hidden" name="post_type" value="post" /> -->

	<!----<span class="input-group-btn" style="background-color: #00c19e; width: 120px; border-radius: 5px; margin-left: -10px; z-index: 1; margin-bottom:5px; ">
	<button class="btn btn-transparent" type="submit" style="background-color: #00c19e; margin-top: 5px; margin-left: 30px; margin-bottom: 2px;">
	---->
	<img class="fas fa-search" src="<?=get_template_directory_uri()?>/img/search.png" style="height: 30px; width: 35px; margin-bottom: 1px;"></img>

	</div>
	</form>

	</div>
	</div>
	</div>
	<div class="sort-destination-loader sort-destination-loader-showing mb-4">
	<div id="portfolioLoadMoreWrapper" class="portfolio-list sort-destination" data-sort-id="portfolio" data-ajax-url="ajax/portfolio-overlay-ajax-load-more.html" data-total-pages="3">
   <div class="row">
	<?php if (empty($_COOKIE['cat_id'])) {
	 if( isset( $_REQUEST['sea'] ) && !empty($_REQUEST['sea']) ) {
	        $blog = new WP_Query( array(
	        's' => $_REQUEST['sea'],
	        'post_type' => 'post',
	        ));
	       }
	        else{ $blog = new WP_Query( array( 'post_type' => 'post','order' => 'desc','posts_per_page' => -1) ) ; } 
	     }else{
        $cat =  $_COOKIE['cat_id'];
        $cat = str_replace('.', ',', $cat);

        //var_dump($cat);exit;
     $blog = new WP_Query( array( 'category__and' => $categoryList ) ); 
	      }  
	$i=0;
	if ( $blog->have_posts() ) :
	while ($blog->have_posts()) : $blog->the_post();
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'full');
	if(!empty($image)){
	$src= $image[0];
	}else{
	$src = get_template_directory_uri().'/img/projects/generic/project.jpg';
	} 
	?>
	<div class="col-md-6 col-lg-4 p-0 isotope-item brands  blogBox moreBox" style="display: none;"  id="blog_<?=$i?>" >
	<div class="portfolio-item hover-effect-3d appear-animation" data-appear-animation="fadeInUpShorter" data-plugin-options="{'accY' : -50}">
	<a href="<?=site_url()?>/index.php/<?=$blog->post->post_name?>">
	<div class="card1" >
	<img src="<?=$src?>" alt="Avatar" style="width:100%;height: 185px;">
	<div class="container2" style="margin-bottom: 1px;padding-left: 18px;font-size: 18px;">
	
	<p><?=substr($blog->post->post_title,0,70).'....';   ?></p> 
        <h6 class="light-green " > <?php the_category(','); ?></h6>
        
	</div>
	</div>
	</a>
	</div>
	</div>

	<?php $i++; endwhile;wp_reset_postdata();endif; ?>

</div>

	</div>
	</div>
	<div class="col-12 d-flex justify-content-center" style="padding-left: 0px; padding-bottom: 3rem;">
	<div id="portfolioLoadMoreLoader" class="portfolio-load-more-loader">
	<div class="bounce-loader">
	<div class="bounce1"></div>
	<div class="bounce2"></div>
	<div class="bounce3"></div>
	</div>
	</div>

	<button id="portfolioLoadMore" type="button" class="btn btn-secondary btn-rounded btn-wide-5 btn-icon-effect-2 outline-none font-weight-semibold text-0">
	<span>LOAD MORE</span>
	<i class="fas fa-ellipsis-h"></i>
	</button>
	</div>
	</div>

	</div>
	</div>
	</div>
	

</div>
	<?php get_footer();?>