<?php
	use News_Element\Khobish_Helper;
    $metaf = Khobish_Helper::king_buildermeta_to_string($settings['metaf']);
    $imgf = $settings['imgf'];
    $excerptf = $settings['excerptf']['size'];
    $per_page = $settings['post_perpage']['size'];
    $paged = '';
    $query_args = Khobish_Helper::hero_slide_query($settings,'query');

    $stylecls = $settings['bordr'].' '.$settings['style'].' '.$settings['tline'];
	$wp_query = new WP_Query($query_args);
	echo'<div class="khbcounter-a line-clip '.$stylecls.'">';
        require dirname(__FILE__) .'/'. $settings['style'] .'.php'; 
    echo '</div>';?>
	

