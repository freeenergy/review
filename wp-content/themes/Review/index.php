<?php
global $helper,$wp_query,$posts, $post, $sorting_pages, $current_custom_page;
get_header();
?>
		<div class="header_search">
			<div class="searchbar">
               <!--<div class="logo">
					<a href="<?php echo HOME_URL; ?>">
					<?php
					$curr_logo = '/images/logo.png';
					$curr_logo = explode('/',get_option(SETTING_LOGO));
					?>
					<?php
					if(count($curr_logo) > 1 && $curr_logo[0] == 'images')
					{
					?>
						<img src="<?php echo TEMPLATE_URL.'/'.$curr_logo[0].'/'.$curr_logo[1]; ?>" title="<?php _e('Current Logo','re');?>" alt=""/>									
					<?php
					}else
					{
					?>
						<img src="<?php echo WP_CONTENT_URL .'/uploads/re/'.$curr_logo[0]; ?>" title="<?php _e('Current Logo','re');?>" alt=""/>
					<?php
					}
					?>
				</a>
			</div>-->
				<div class="search-box">
				 <?php include PATH_PAGES . DS . 'search_form.php' ?>
				 
				 <div class="review_link"><a href="#home" >All Agencies</a></div>
				 				 
				 <div class="review_linkn"><a class="" 
				<?php if (is_user_logged_in())
{ ?> href="/wp-admin/post-new.php?post_type=product" <?php }
else
{ ?> href="/?action=register" <?php }
?> 
>Add an Agency</a></div>
<div id="addHelp" style="
    background: rgb(47, 147, 255);
    height: 79px;
    display: block;
    width: 249px;
    position: relative;
    top: 38px;
    left: 310px;
    float: left;
    padding: 14px;
    border-radius: 7px;
    font-size: 14px !important;
    border: 1px solid rgb(236, 245, 255);
    color: white;
	display:none;
">If you would like to leave a review and do not see the agency you hired listed, you can add it. Upon approval you will be notified and will be able to write your review.</div>
				</div>
		  </div>
		</div>
</div>


	<!-- Body start here -->	 
	<div id="container_top">
	     <div class="nav-container" style="height: auto;">
	     <nav class="" style="top: 0px;">
		     <ul>
			     <li><div id="icon"></div>
			          <div id="textFirst">Search for reviews by our users of different creative agencies, so you can best decide on who you should hire, you can also sort by different filters.</div></li>
			     <li><div id="iconSecond"></div>
			          <div id="textSecond">If a creative agency you hired is not listed, you can add it, an employee of Agencycheck.net will manually review your submission and approve it.</div></li>
			     <li><div id="iconThird"></div>
			           <div id="textThird">You can rate an agency you added or a company in our database. <i>You may remain completely anonymous,</i> if the review is negative the agency will be able to give their side of the story.</div></li>
		     </ul>
          </nav>
          </div>
	</div>
	<div id="container">
		<div class="container_res">
			<div class="container_main">				
				<div class="col_right">
					 <!-- Notification Sidebar -->
						  <?php
						  if ( is_active_sidebar( 'homepage-widget-area' ) ) {
							  dynamic_sidebar( 'homepage-widget-area' );
						  }
						  ?> 
					 <!-- End Notification Sidebar -->					                                          
					<div class="clear"></div>
					<?php
						/**
						**James: Get Latest Products
						*/
						global $wp_query;
						wp_reset_query();
					?>
					<?php                     
					if ( have_posts() ) 
						  {
								/**
								 * get default widget
								 */
								$default_sort = get_option(SETTING_SORTING_DEFAULT) ? get_option(SETTING_SORTING_DEFAULT) : __('recent-products', 're');
								$sort_type = !empty( $_GET['sort_type'] ) ? $_GET['sort_type'] : $default_sort;
								$sort_lists = get_option( SETTING_SORTING_TYPES );
						  ?>
					<div class="col">
						<div class="section-title" style="">
								<?php if ( !empty( $sort_lists) )  {?>
									 <div class="sort-area" style="float: right">
										  <span class="label"><?php _e('View agencies by', 're') ?>:</span>
										  <div class="sorting-wrapper">
												 <div class="sorting">
														<form id="sorting_form" action="<?php bloginfo('wpurl') ?>" method='GET'>
																<select name="sort_type">
																		  <?php foreach( $sort_lists as $id => $type ) {
																				  $selected = $sort_type == $type ? 'selected="selected"' : '';
																				  ?>
																		  <option value="<?php echo $type ?>" <?php echo $selected ?>><?php echo $sorting_pages[$type]['name'] ?></option>
																		  <?php } ?>
																</select>
														</form>
												 </div>
										  </div>
									 </div>
								<?php } ?>
						<h1 class="blue2"><?php echo $sorting_pages[$sort_type]['name'] ?></h1>								
						</div>
						<?php
								while(have_posts()) {
								the_post(); 
								$post_id = get_the_ID();			
						?> 					
						<div class="col_box">
							<div class="box_border">  
								<div class="col_box2">
									<div class="vote" style="background:none; width:27px;"></div>                                    
									<div class="avatar">
										<?php
													 if( has_post_thumbnail() ){
														  echo '<div class="index-thumb">';
														  echo the_post_thumbnail('featuredImageCropped');
														  //tgt_the_product_thumb(URL_UPLOAD.'/'.$image_thumb[0]['thumb'],104,84);											
														  echo '</div>';
													 }
													 else
													 {
														  echo '<a href="'.get_permalink($post_id).'">';
														  echo '<img src="'.TEMPLATE_URL.'/images/no_image.jpg" style="width:104px;height:84px;" alt=""/>';
														  echo '</a>';	
													 }
													 ?> 
													 <div class="vote_star">
														  <div class="star" style="">
																<?php
                                                                                //$rating = get_post_meta ( $post->ID , get_showing_rating(),true);
                                                                                $rating = get_post_meta ($post_id, PRODUCT_EDITOR_RATING, true);
                                                                                //$rating = get_post_meta ($post_id, PRODUCT_RATING, true);
                                                                                tgt_display_rating( $rating, 'top_rating_'.$post->ID, true, 'star-disabled' );
																?>
														  </div>	
													 </div>
													 <div class="clear"></div>                                        
													 <p><a href="<?php echo get_permalink($post_id); ?>"> <?php echo tgt_comment_count( 'No Revew', '%d Review', '%d Reviews', $post->comment_count); ?> </a></p>
									</div>
									
									<div class="text">
										<div class="title">
											<div class="title_left">
												<h1><a href="<?php echo get_permalink($post_id); ?>">
												<?php						
												if(strlen($post->post_title) > 32)
												{
													echo substr($post->post_title,0,31).'...';
												}else
													echo $post->post_title;
												?>													
												</a></h1>
												<p>
												<?php
												//list tags					
													 $tags = get_the_tags();
													 $tag_link_arr = array();
													 if($tags != '')
													 {
														  foreach($tags as $tags_item)	
																$tag_link_arr[] = '<a href="'.get_tag_link($tags_item->term_id).'">'.$tags_item->name.'</a>';
													 }
													 else
													 {
														  $tag_link_arr[] = __('No tags','re');
													 }
													 echo '<span class="tag-list">';
													 echo implode(',',$tag_link_arr);
													 echo '</span>';
												?>
												</p>
											</div> 
										</div>
										
										<div class="content_text">
											<p><?php echo tgt_limit_content(get_the_content(), 34); ?> <a href="<?php echo get_permalink($post_id); ?>"><?php _e('more','re'); ?>&nbsp;&raquo;</a></p>
											
											<div class="box_butt" style="float:left; margin-top:15px;">
												<?php
																	 $product_website = '#';
																	 if(get_post_meta($post_id,'tgt_product_url',true) != '') {
																		 $product_website = $product_website =  tgt_get_the_product_link($post_id);
																	 ?>
																	 <p class="blue">
																		  <a href="<?php echo esc_url_raw($product_website); ?>"  target="_blank"><?php _e('Visit Website','re'); ?></a>
																	 </p>	 
																<?php } ?>
											</div>
										</div>
									</div>
								</div>
							 </div>                             
							 
						  </div>
						 <?php
							}
						?>
					</div>                   
					<?php
					}else
			echo '<font color="#FF0000" style="font-style:italic">'.__('No Result Found Here !','re').'</font>';
			?>       
			<div class="clear"></div>
				 <?php
                         global $wp_query, $wpdb; 
                         $max = $wp_query->max_num_pages;
                         $paged = ( isset($_GET['paged']) ) ? $_GET['paged'] : 1;
                         function query_ajax_products($paged){
	//add_filter('posts_join' , 'filter_join_top_product');
	//add_filter('posts_groupby' , 'filter_groupby_top_product');

	$args = array( 'post_type' => 'product' ,
						'posts_per_page' => 1,
						'paged' => $paged );	
	

	$queries = query_posts( $args );
	

		$result = array();
		$result = array();
		
			foreach( $queries as $product ){
			
					$result[] = $product;
							
			}
		
		$queries = $result;
	
	
	//remove_filter('posts_join' , 'filter_join_top_product');
	//add_filter('posts_groupby' , 'filter_groupby_top_product');
	//echo '<pre>';
	//print_r($queries);
	//echo '</pre>';
	return $queries;
}
 
				 
 		
					$top_products = query_ajax_products($paged);
					if ( !empty( $top_products ) ) { ?>
					<div class="section-title">
						<h1 class="blue2"><?php _e('All agencies','re'); ?></h1>
                         </div>
					<div class="col infinite-scroll">
							<?php
								$i = 0;
								foreach( $top_products as $post ) {
									 the_post( $post );
									 $post_id = $post->ID;
									 $image_thumb = get_post_meta ( $post->ID ,'tgt_product_images',true);
							?> 
						<div class="col_box">
							<?php if($i == 0) { ?>
								<div class="vote">
									<p><?php echo $i+1; ?></p>  
								</div>
							<?php } else { ?>
								<div class="vote" style="background:url('<?php echo TEMPLATE_URL; ?>/images/icon_vote2.png') no-repeat scroll center center transparent;">                        
									<p><?php echo $i+1; ?></p>  
								</div>
							<?php } ?>
							<div class="avatar">
								<?php
								if( has_post_thumbnail ($post_id) ){
									 $thumb_url =  wp_get_attachment_image_src( get_post_thumbnail_id($post_id), array( 104, 84) );
									 echo '<div class="index-thumb">';								  
									 echo the_post_thumbnail('featuredImageCropped');				  
									 echo '</div>';
								} else {
									echo '<img src="'.TEMPLATE_URL.'/images/no_image.jpg" style="width:104px;height:84px;" alt=""/>';
								} ?> 								
								<div class="vote_star" style="text-align: center">	
									<div class="star" style="">
									<?php
									//$rating = get_post_meta ( $post->ID , get_showing_rating(),true);
									$rating = get_post_meta ($post_id, PRODUCT_EDITOR_RATING, true);
									tgt_display_rating( $rating, 'top_rating_'.$post->ID, true, 'star-disabled' );
									?>	
									</div>
										
									
								</div>
								<div class="clear"></div>
								
								<p>
									<a href="<?php echo get_permalink ( $post->ID); ?>">
										<?php echo tgt_comment_count( 'No Review', '%d Review', '%d Reviews', $post->comment_count); ?>
									</a>
								</p>
							</div>
							
							<div class="text">
								<div class="title">
									<div class="title_left">
										<h1><a href="<?php echo get_permalink ( $post->ID); ?>">
										<?php
									  	$the_post = get_post( $post->ID , ARRAY_A);
									  	$title = $post->post_title;
									  	$content = $post->post_content;
									  	if(strlen($title) > 32) {
										  	echo substr($title,0,31).'...'; 
										}else{
											echo $title;
										}
										?>										
										</a></h1>
										<p>
										<?php
										//list tags					
										$tags = get_the_tags();
										$tag_link_arr = array();
										if($tags != '') {
											foreach($tags as $tags_item)	
											$tag_link_arr[] = '<a href="'.get_tag_link($tags_item->term_id).'">'.$tags_item->name.'</a>';
										} else {
											$tag_link_arr[] = __('No tags','re');												
										}
										echo '<span class="tag-list">';
										echo implode(',',$tag_link_arr);
										echo '</span>';
										?>										
										</p>
									</div>                                    
									
								</div>
								
								<div class="content_text">
									<p><?php echo tgt_limit_content($content, 34); ?> <a href="<?php echo get_permalink($post_id); ?>"><?php _e('more','re'); ?>&nbsp;&raquo;</a></p>
									
									<div class="box_butt" style="float:left; margin-top:15px;">
									<?php
													 $product_website = '#';
													 if(get_post_meta($post_id,'tgt_product_url',true) != '') {
														 $product_website =  tgt_get_the_product_link($post_id);
													 ?>
										<p class="blue">
														  <a href="<?php echo esc_url_raw($product_website); ?>"  target="_blank"><?php _e('Visit Website','re'); ?></a>
													 </p>
													 <?php } ?>
									</div>
								</div>
							</div>
						</div> 
						<?php $i++;
						} ?>
						<!------Pagination link start---->
                              <div class="load-more">
                                  <?php if ($paged) { $page_no = $paged+1; ?>
                                      <a href="<?php  bloginfo('url'); ?>/?paged=<?php echo $page_no; ?>" class="jscroll-next jscroll-next-parent"><img src="<?php bloginfo('template_directory'); ?>/images/ajax-loader.gif" alt="Load More"></a>				        
                                  <?php } else if ($max == $paged ) { $page_no = $paged; ?>
                                      <a href="<?php  bloginfo('url'); ?>/?paged=<?php echo $page_no; ?>" class="jscroll-next next jscroll-next-parent" onclick="return false"><img src="<?php bloginfo('template_directory'); ?>/images/ajax-loader.gif" alt="Load More"></a>				        
                                  <?php } ?>
                              </div><!--load-more ends here-->
					</div>	
					<?php } ?>
               <!--<div id="content">
                    <div class="section-title"><h1 class="blue2">All Agencies</h1></div>
                   <?php
                    if(isset($_GET['paged'])){
                         $paged = $_GET['paged'];
                    }else{ $paged = 1; }
                    $new_query = new WP_Query();
                    $new_query->query('post_type=product&showposts=4'.'&paged='.$paged);
                    while ($new_query->have_posts()) : $new_query->the_post(); ?>

                    <div class="agency_img"><?php the_post_thumbnail('thumbnail', array('class' => '')); ?> </div>
                    <p><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
                    <div class="agency_desc"><?php the_excerpt(); ?></div>
                    
               <?php endwhile; ?>
                   <div id="pagination">
                   <?php next_posts_link('&laquo; Older Entries', $new_query->max_num_pages) ?>
                   <?php previous_posts_link('Newer Entries &raquo;') ?>
                   </div>
               </div><!-- #content -->
               
               
				</div>
					<!-- SIDEBAR GOES HERE -->
								
					<!-- SIDEBAR END HERE -->
				<div class="clear"></div>
<script>
jQuery(function($) {
    $('#content').on('click', '#pagination a', function(e){
        e.preventDefault();
        var link = $(this).attr('href');
        $('#content').fadeOut(500, function(){
            $(this).load(link + ' #content', function() {
                $(this).fadeIn(500);
            });
        });
    });

     $('.infinite-scroll').jscroll({
         loadingHtml: '<img src="http://review.devserver2012.com/wp-content/themes/Review/images/ajax-loader.gif" alt="Loading..." />',
         padding: 20,
         nextSelector: 'a.jscroll-next:last',
         contentSelector: '.infinite-scroll',
         autoTrigger: true,

     });
});
</script>

			</div>
		</div>
	</div>
	
	<!--body end here-->
<script type="text/javascript">
jQuery(document).ready(function(){
	 jQuery('.star-disabled').rating();
	 jQuery('.rating input[type=radio]').rating();
	 jQuery('#sorting_form').each(function(){
		  var current = jQuery(this),
				select = current.find('select[name=sort_type]');
		  select.change(function(){
				current.submit();
		  });
	 });
});
</script>
<?php
	get_footer();
?>

<script>

	jQuery(function($) {
	$( document ).ready(function() {
	
	
	$(".review_link").click(function(){
		$("html, body").animate({ scrollTop: "2350px" });
					
});	
									
	$('#icon').click(function() {
		$( '.box_search input' ).css("border", "3px solid rgb(255, 108, 108)");
		$("html, body").animate({ scrollTop: "0px" });
		$( '.box_search input' ).focus();
		$('.ava_search').show();
});

	$('#iconSecond').click(function() {
		$('#addHelp').show();
		$("html, body").animate({ scrollTop: "0px" });

});


						});
						});
</script>						
