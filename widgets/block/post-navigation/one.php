<?php
use News_Element\Khobish_Helper; 

?> 
<div class="postnav-wrap one">
    <div class="xl-flex-row">
        <div class="xl-flex-col fw-col-sm-6 text-right">
        <?php if(!empty($previous_post_id)) :
            $previous_post = get_permalink($previous_post_id );
            $previous_post_title = get_the_title($previous_post_id );
            ?>
            <a class="prev-post" href="<?php echo esc_url($previous_post);?>">
                <span class="fa fa-angle-left"></span>
                <span class="link"><?php echo $previous_post_title;?></span>       
            </a>
        <?php endif; ?>
        </div>
        <div class="xl-flex-col fw-col-sm-6">
        <?php if(!empty($next_post_id)) :
            $next_post= get_permalink($next_post_id );
            $next_post_title = get_the_title($next_post_id );?>
                <a class="next-post" href="<?php echo esc_url($next_post);?>">
                    <span class="fa fa-angle-right"></span>
                    <span class="link"><?php echo $next_post_title;?></span>
                </a>
        <?php endif; ?>
        </div>
    </div> 
</div>
