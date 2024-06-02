<?php
    use News_Element\Khobish_Helper;
    if( $wp_query->have_posts() ) :
        $post_count = 0;while( $wp_query->have_posts() ) :
            $wp_query->the_post();$post_count++;
            ?>

                <div class="inrwrp">
                    <article class="post-item <?php echo Khobish_Helper::xl_post_format_icon();?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="ft-thumbwrap">
                          <a href="<?php the_permalink();?>">
                            <?php the_post_thumbnail($imgf);?>
                          </a>
                          <?php Khobish_Helper::counter($per_page,$paged,$post_count);?>
                        </div>
                    <?php endif; ?>
 
                      <div class="excerpt-wrap">
                        <?php Khobish_Helper::ae_build_postmeta($metaf,$excerptf);?>                       
                      </div>

                    </article> 
                </div>
            <?php   
        endwhile;
        wp_reset_postdata();
    endif;
?>