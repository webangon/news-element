<?php
use News_Element\Khobish_Helper;
    if( $wp_query->have_posts() ) :
        $post_count = 0;while( $wp_query->have_posts() ) :
        $wp_query->the_post();$post_count++;
        if ($post_count % 2 == 1){
          $cls = 'khbeven';
        } else {
          $cls = 'khbodd';
        } 

        ?>

            <div class="anim-fade <?php echo $cls;?>">
                <div class="inrwrp">
                  <article class="post-item khobish-flex-inr <?php echo Khobish_Helper::xl_post_format_icon();?>">

                      <div class="thumbwrp">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="ft-thumbwrap">
                              <a href="<?php the_permalink();?>">
                                <span class="icon"></span>
                                <?php the_post_thumbnail($imgf);?>
                              </a>
                            </div>
                        <?php endif; ?>
                      </div>                     
                      
                      <div class="excerptwrp">
                        <div class="excerpt-wrap">
                          <?php Khobish_Helper::ae_build_postmeta($metaf,$excerptf);?>                        
                        </div> 
                      </div>                                
                  </article>                      
                </div>
            </div>

           <?php

        endwhile;
        wp_reset_postdata();
    endif;
?>
