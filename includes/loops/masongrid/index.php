<?php
use News_Element\Khobish_Helper;
if ( $wp_query->have_posts() ) {
	  while ( $wp_query->have_posts() ) {
		$wp_query->the_post();	
		?> 

          <div class="masongrdgrid masonitm <?php echo Khobish_Helper::xl_post_format_icon();?>">
          <div class="bgholder">

          <?php if ( has_post_thumbnail() ) : ?>
              <div class="ft-thumbwrap">
                <a href="<?php the_permalink();?>">
                  <span class="icon"></span>
                  <?php the_post_thumbnail($imgf );?>
                </a>
                <div class="khboverlaythumb"><?php echo Khobish_Helper::khobish_single_category_bg();?></div> 
              </div>
          <?php endif; ?>

         
             <div class="excerpt-wrap">                          
             <?php Khobish_Helper::ae_build_postmeta($metaf,$excerptf);?>
             </div>  
                                      
              </div>
          </div>


	 <?php } wp_reset_postdata(); }?>