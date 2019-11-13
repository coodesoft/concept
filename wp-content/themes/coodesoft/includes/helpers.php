<?php



function coode_prepare_content(){
  $content = get_pages();
  return coode_build_sections($content);
}

function coode_build_sections($content){
  $menu_items = [];
  $sections = [];
  foreach ($content as $key => $page) {
    $menu_items[] = [ 'name' => get_the_title($page), 'order' => $page->menu_order ];
    $content = apply_filters( 'the_content', $page->post_content );
    $content = str_replace( ']]>', ']]&gt;', $content );

    $sections[]   = [ 'webId' => strtolower(get_the_title($page)),
					  'content' =>  $content,
					  'order' => $page->menu_order,
					  'id' => $page->ID ];
  }

  return [ 'menu_items' => coode_sort_by_orderAttr($menu_items),
           'content' => coode_sort_by_orderAttr($sections) ];
}

function coode_sort_by_orderAttr($collection){
  usort($collection, function($A, $B){
      if ($A['order'] == $B['order']) return 0;
      return ($A['order'] < $B['order']) ? -1 : +1;
    });
  return $collection;
}


/* NO ESTA EN USO */
function coode_attachment_img($page_id){
	$url = [];

	$is = get_children("post_parent=$".$page_id."&post_type=attachment&post_mime_type=image/jpeg");
	foreach($is as $i) {
	  $url[] = wp_get_attachment_image_src($i->ID, 'full');
	}
	echo json_encode($url);
	return 	$url;
}
