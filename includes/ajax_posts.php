<?php
use News_Element\Khobish_Helper;

function khobish_filter_tax($ajax_parameters = ''){
	
	$current_tax = '';
	$isAjaxCall = false;
	
	//var_dump(json_decode($ajax_parameters));
	// SET CURRENT PAGE
	if (empty($ajax_parameters)) {
		
		$isAjaxCall = true;
		
        $ajax_parameters = array (
            'khobish_fn_page'=> '',
			'khobish_fn_cat'=> '',
        );
	
		if (!empty($_POST['khobish_fn_page'])) {
			$ajax_parameters['khobish_fn_page'] = $_POST['khobish_fn_page'];
		}
		if (!empty($_POST['khobish_fn_cat'])) {
            $ajax_parameters['khobish_fn_cat'] = $_POST['khobish_fn_cat'];
			$current_tax = $ajax_parameters['khobish_fn_cat'];
        }else{
			$current_tax = '';
		}
		
		if($ajax_parameters['khobish_fn_page'] != ''){
			$paged = $ajax_parameters['khobish_fn_page'];	
		}else{
			$paged = 1;
		} 
		
	}
		
		if(is_array($_POST['xlxtra_data'])){ 
 
			$per_page = $_POST['xlxtra_data']['per_page'];
			$template = $_POST['xlxtra_data']['template'];
			$metaf = $_POST['xlxtra_data']['metaf'];
			$metar = $_POST['xlxtra_data']['metar'];
			$metas = $_POST['xlxtra_data']['metas'];
			$imgf = $_POST['xlxtra_data']['imgf'];
			$imgr = $_POST['xlxtra_data']['imgr'];
			$imgs = $_POST['xlxtra_data']['imgs'];
			$excerptf = $_POST['xlxtra_data']['excerptf'];
			$excerptr = $_POST['xlxtra_data']['excerptr'];
			$excerpts = $_POST['xlxtra_data']['excerpts'];
			$col_num = $_POST['xlxtra_data']['column'];
			$post_format = $_POST['xlxtra_data']['post_format'];
			$break = $_POST['xlxtra_data']['break'];

	        $order = $_POST['xlxtra_data']['order'];
	        $order_by = $_POST['xlxtra_data']['orderby'];
	        $offset =  (int)( $paged - 1 ) * $per_page  + (int)$_POST['xlxtra_data']['offset'];

			//use for related posts
			$usage = isset($_POST['xlxtra_data']['usage']) ? $_POST['xlxtra_data']['usage'] : '';
			$pid = isset($_POST['xlxtra_data']['pid']) ? $_POST['xlxtra_data']['pid'] : '';
		}		
		
		$cat = explode(',' , $current_tax);
		
		if ($usage == 'related'){

			if ($cat[0]=='author'){

				$authorid = get_post_field( 'post_author', $pid );
				//$query_args['author'] = $authorid;
				//$query_args['post__not_in'] = $pid;

				$query_args = array(
					'post_type' 			=> 'post',
					'post_status' 			=> 'publish',
					'author' 				=> $authorid,
					'posts_per_page' 		=> $per_page,
					'post__not_in' => array($pid),
					'paged'					=> $paged,			
				);				

			}

			if ($cat[0]=='related'){

	            $postcat = wp_get_post_categories( $pid );
	            $all_cat = implode(',' , $postcat);
	            $query_args = array(
	                'post_type' => 'post',
	                'paged' => $paged,
	                'posts_per_page' => $per_page,
	                'post__not_in' => array($pid),
	                'tax_query' => array(
	                    array(
	                        'taxonomy' => 'category',
	                        'field' => 'term_id',
	                        'terms' => $all_cat,
	                    ) , 
	                ) ,
	            );  
			}


		} elseif ($usage == 'trending'){

		      $posts = wp_most_popular_get_popular( array(

		       'limit' => $per_page, 
		       'post_type' => 'post',
		       'range' => $cat[0], 

		      ) );

		} else {

			$query_args = array(
				'post_type' 			=> 'post',
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> $per_page,
				'paged'					=> $paged,
		        'cat' => $cat,	
	            'order' => $order,
	            'orderby'   => $order_by,	
	            'offset'=> $offset,	        		
			); 

		}

		if ($post_format){
            $post_format = (explode(',' , $post_format));
            $fpost_format = preg_filter('/^/', 'post-format-', $post_format);

            $query_args['tax_query'] = array(
                array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms' => $fpost_format,
                //'operator' => 'NOT IN',
                //'terms' => array('post-format-quote',''),
                )
            );            			
		}

		$wp_query = new WP_Query($query_args);
		$max_page = $wp_query->max_num_pages;
		$post_count = $wp_query->post_count;
		$post_found = $wp_query->found_posts;
		$list = $buffy = '';
		$i = 0;
		ob_start();
		require dirname(__FILE__) .'/loops/'. $template .'.php';
		$list .= ob_get_clean();

		if ( $list != NULL ) {
				$buffy .= $list; 
		}

	
	//pagination
    $hide_prev = false;
    $hide_next = false;
    if ($ajax_parameters['khobish_fn_page'] == 1) {
        $hide_prev = true; //hide link on page 1
    }
    if ($ajax_parameters['khobish_fn_page'] >= $max_page) {
        $hide_next = true; //hide link on last page
    }

	$buffyArray = array(
        'xl_fn_data' 			=> $buffy,
		'khobish_fn_hide_prev' 		=> $hide_prev,
        'khobish_fn_hide_next' 		=> $hide_next
    );


    if ( true === $isAjaxCall ) 
	{
        die(json_encode($buffyArray));
    } 
	else 
	{
        return json_encode($buffyArray);
    }
	
}

function xl_vid_playlist() {
	$xlurl = addslashes($_REQUEST['xlurl']);
	echo wp_oembed_get($xlurl);    	
	exit();
}