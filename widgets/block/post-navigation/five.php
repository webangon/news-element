<?php
use News_Element\Khobish_Helper; 
use Elementor\Plugin;
?>
<div class="postnav-wrap five">
    <div class="xl-flex-row">
        <div class="xl-flex-col">
        <?php if(!empty($previous_post_id)) :
            $previous_post = get_permalink($previous_post_id );
            $previous_post_title = get_the_title($previous_post_id );
            $preth = get_the_post_thumbnail( $previous_post_id,'thumbnail');
            ?>
            <a class="prev-post" href="<?php echo $previous_post;?>">
                <?php echo $preth; ?>
                <span class="pnlable"><?php echo $settings['ptxt'];?></span> 
                <span class="link"><?php echo $previous_post_title;?></span>       
            </a>
        <?php endif; ?>
        </div>
        <div class="xl-flex-col">
        <?php if(!empty($next_post_id)) :
            $next_post= get_permalink($next_post_id );
            $next_post_title = get_the_title($next_post_id );
            $nxth = get_the_post_thumbnail( $next_post_id, 'thumbnail');
            ?>
                <a class="next-post" href="<?php echo $next_post;?>">
                    <?php echo $nxth;?>
                    <span class="pnlable"><?php echo $settings['ntxt'];?></span>
                    <span class="link"><?php echo $next_post_title;?></span> 
                </a>
        <?php endif; ?>
        </div>
    </div>
</div>
