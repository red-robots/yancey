<?php 
/*
 * Custom Post Types 
 * DASH ICONS = https://developer.wordpress.org/resource/dashicons/
 * Example: 'menu_icon' => 'dashicons-admin-users'
*/

add_action('init', 'js_custom_init', 1);
function js_custom_init() {
    
    //'supports'  => array('title','editor','thumbnail')

    $post_types = array(
      array(
        'post_type' => 'portfolio',
        'menu_name' => 'Portfolio',
        'plural'    => 'Portfolio',
        'single'    => 'Portfolio',
        'menu_icon' => 'dashicons-format-gallery',
        'supports'  => array('title','editor')
      ),
    );
    
    if($post_types) {
        foreach ($post_types as $p) {
            $p_type = ( isset($p['post_type']) && $p['post_type'] ) ? $p['post_type'] : ""; 
            $single_name = ( isset($p['single']) && $p['single'] ) ? $p['single'] : "Custom Post"; 
            $plural_name = ( isset($p['plural']) && $p['plural'] ) ? $p['plural'] : "Custom Post"; 
            $menu_name = ( isset($p['menu_name']) && $p['menu_name'] ) ? $p['menu_name'] : $p['plural']; 
            $menu_icon = ( isset($p['menu_icon']) && $p['menu_icon'] ) ? $p['menu_icon'] : "dashicons-admin-post"; 
            $supports = ( isset($p['supports']) && $p['supports'] ) ? $p['supports'] : array('title','editor','custom-fields','thumbnail'); 
            $taxonomies = ( isset($p['taxonomies']) && $p['taxonomies'] ) ? $p['taxonomies'] : array(); 
            $parent_item_colon = ( isset($p['parent_item_colon']) && $p['parent_item_colon'] ) ? $p['parent_item_colon'] : ""; 
            $menu_position = ( isset($p['menu_position']) && $p['menu_position'] ) ? $p['menu_position'] : 20; 
            
            if($p_type) {
                
                $labels = array(
                    'name' => _x($plural_name, 'post type general name'),
                    'singular_name' => _x($single_name, 'post type singular name'),
                    'add_new' => _x('Add New', $single_name),
                    'add_new_item' => __('Add New ' . $single_name),
                    'edit_item' => __('Edit ' . $single_name),
                    'new_item' => __('New ' . $single_name),
                    'view_item' => __('View ' . $single_name),
                    'search_items' => __('Search ' . $plural_name),
                    'not_found' =>  __('No ' . $plural_name . ' found'),
                    'not_found_in_trash' => __('No ' . $plural_name . ' found in Trash'), 
                    'parent_item_colon' => $parent_item_colon,
                    'menu_name' => $menu_name
                );
            
            
                $args = array(
                    'labels' => $labels,
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true, 
                    'show_in_menu' => true, 
                    'show_in_rest' => true,
                    'query_var' => true,
                    'rewrite' => true,
                    'capability_type' => 'post',
                    'has_archive' => false, 
                    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
                    'menu_position' => $menu_position,
                    'menu_icon'=> $menu_icon,
                    'supports' => $supports
                ); 
                
                register_post_type($p_type,$args); // name used in query
                
            }
            
        }
    }
}



/* ##########################################################
 * Add new taxonomy, make it hierarchical (like categories)
 * Custom Taxonomies
*/
add_action( 'init', 'build_taxonomies', 0 ); 
function build_taxonomies() {

  $post_types = array(
    array(
      'post_type' => array('portfolio'),
      'menu_name' => 'Artwork Category',
      'plural'    => 'Artwork Categories',
      'single'    => 'Artwork Category',
      'taxonomy'  => 'artwork-category'
    )
  );


  if($post_types) {
    foreach($post_types as $p) {
      $p_type = ( isset($p['post_type']) && $p['post_type'] ) ? $p['post_type'] : ""; 
      $single_name = ( isset($p['single']) && $p['single'] ) ? $p['single'] : "Custom Post"; 
      $plural_name = ( isset($p['plural']) && $p['plural'] ) ? $p['plural'] : "Custom Post"; 
      $menu_name = ( isset($p['menu_name']) && $p['menu_name'] ) ? $p['menu_name'] : $p['plural'];
      $taxonomy = ( isset($p['taxonomy']) && $p['taxonomy'] ) ? $p['taxonomy'] : "";
      $rewrite = ( isset($p['rewrite']) && $p['rewrite'] ) ? $p['rewrite'] : $taxonomy;
      $query_var = ( isset($p['query_var']) && $p['query_var'] ) ? $p['query_var'] : true;
      $show_admin_column = ( isset($p['show_admin_column']) ) ? $p['show_admin_column'] : true;
      $default_term = ( isset($p['default_term']) ) ? $p['default_term'] : '';

      $labels = array(
        'name' => _x( $menu_name, 'taxonomy general name' ),
        'singular_name' => _x( $single_name, 'taxonomy singular name' ),
        'search_items' =>  __( 'Search ' . $plural_name ),
        'popular_items' => __( 'Popular ' . $plural_name ),
        'all_items' => __( 'All ' . $plural_name ),
        'parent_item' => __( 'Parent ' .  $single_name),
        'parent_item_colon' => __( 'Parent ' . $single_name . ':' ),
        'edit_item' => __( 'Edit ' . $single_name ),
        'update_item' => __( 'Update ' . $single_name ),
        'add_new_item' => __( 'Add New ' . $single_name ),
        'new_item_name' => __( 'New ' . $single_name ),
      );

      if($default_term) {

        register_taxonomy($taxonomy, $p_type, array(
          'hierarchical' => true,
          'labels' => $labels,
          'show_admin_column' => $show_admin_column,
          'query_var' => $query_var,
          'show_ui' => true,
          'show_in_rest' => true,
          'public' => true,
          '_builtin' => true,
          'default_term' => array( 'name' => $default_term['name'], 'slug' => $default_term['slug'] ),
          'rewrite' => array( 'slug' => $rewrite ),
        ));

      } else {
        register_taxonomy($taxonomy, $p_type, array(
          'hierarchical' => true,
          'labels' => $labels,
          'show_admin_column' => $show_admin_column,
          'query_var' => $query_var,
          'show_ui' => true,
          'show_in_rest' => true,
          'public' => true,
          '_builtin' => true,
          'rewrite' => array( 'slug' => $rewrite ),
        ));
      }

    }
  }

}


// Add the custom columns to the position post type:
add_filter( 'manage_posts_columns', 'set_custom_cpt_columns' );
function set_custom_cpt_columns($columns) {
    global $wp_query;
    $query = isset($wp_query->query) ? $wp_query->query : '';
    $post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
    
    if($post_type=='portfolio') {
        unset($columns['date']);
        unset($columns['taxonomy-artwork-category']);
        $columns['title'] = __( 'Name', 'bellaworks' );
        $columns['image'] = __( 'Image', 'bellaworks' );
        $columns['taxonomy-artwork-category'] = __( 'Category', 'bellaworks' );
        $columns['date'] = __( 'Date', 'bellaworks' );
    }
    // else if($post_type=='events') {
    //     unset($columns['date']);
    //     $columns['title'] = __( 'Title', 'bellaworks' );
    //     $columns['image'] = __( 'Photo', 'bellaworks' );
    //     $columns['date'] = __( 'Date', 'bellaworks' );
    // }
    // else if($post_type=='communities') {
    //     unset($columns['date']);
    //     unset($columns['taxonomy-community-status']);
    //     unset($columns['taxonomy-community-location']);
    //     $columns['title'] = __( 'Name', 'bellaworks' );
    //     $columns['units'] = __( 'Total Units', 'bellaworks' );
    //     $columns['taxonomy-community-location'] = __( 'Location', 'bellaworks' );
    //     $columns['taxonomy-community-status'] = __( 'Category', 'bellaworks' );
    //     $columns['date'] = __( 'Date', 'bellaworks' );
    // }
    
    return $columns;
}

//Add the data to the custom columns for the book post type:
add_action( 'manage_posts_custom_column' , 'custom_post_column', 10, 2 );
function custom_post_column( $column, $post_id ) {
    global $wp_query;
    $query = isset($wp_query->query) ? $wp_query->query : '';
    $post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
    
    if($post_type=='portfolio') {
        switch ( $column ) {
          case 'image' :
            $img = get_field('main_photo',$post_id);
            $img_src = ($img) ? $img['sizes']['medium'] : '';
            $the_photo = '<span class="tmphoto" style="display:inline-block;width:50px;height:50px;background:#e2e1e1;text-align:center;border:1px solid #CCC;overflow:hidden;">';
            if($img_src) {
               $the_photo .= '<span style="display:block;width:100%;height:100%;background:url('.$img_src.') top center no-repeat;background-size:cover;transform:scale(1.2)"></span>';
            } else {
                $the_photo .= '<i class="dashicons dashicons-format-image" style="font-size:25px;position:relative;top:13px;left: -3px;opacity:0.3;"></i>';
            }
            $the_photo .= '</span>';
            echo $the_photo;
            break;
        }
    }
    // else if($post_type=='events') {
    //     switch ( $column ) {
    //       case 'image' :
    //         $img = get_field('main_photo',$post_id);
    //         $img_src = ($img) ? $img['sizes']['medium'] : '';
    //         $the_photo = '<span class="tmphoto" style="display:inline-block;width:50px;height:50px;background:#e2e1e1;text-align:center;border:1px solid #CCC;overflow:hidden;">';
    //         if($img_src) {
    //            $the_photo .= '<span style="display:block;width:100%;height:100%;background:url('.$img_src.') top center no-repeat;background-size:cover;transform:scale(1.2)"></span>';
    //         } else {
    //             $the_photo .= '<i class="dashicons dashicons-format-image" style="font-size:25px;position:relative;top:13px;left: -3px;opacity:0.3;"></i>';
    //         }
    //         $the_photo .= '</span>';
    //         echo $the_photo;
    //         break;
    //     }
    // }
    
}


/*
Taxonomy Custom Column
manage_edit-$taxonomy_columns filter.
*/
add_filter("manage_edit-artwork-category_columns", 'theme_columns'); 
function theme_columns($theme_columns) {
    $new_columns = array(
      'cb' => '<input type="checkbox" />',
      'name' => __('Name'),
      'tax_image' => __('Image'),
      'slug' => __('Slug'),
      'posts' => __('Posts')
    );
    return $new_columns;
}


add_filter("manage_artwork-category_custom_column", 'manage_theme_columns', 10, 3);
function manage_theme_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'artwork-category');
    switch ($column_name) {
        case 'tax_image': 
            $photo = get_field('category_image',$theme); 
            $out = '<span class="tmphoto" style="display:inline-block;width:50px;height:50px;background:#e2e1e1;text-align:center;">';
            if($photo) {
                $out .= '<span style="display:block;width:100%;height:100%;background:url('.$photo['url'].');background-size:cover;background-position:center"></span>';
            } else {
                $out .= '<i class="dashicons dashicons-businessman" style="font-size:33px;position:relative;top:8px;left:-6px;opacity:0.3;"></i>';
            }
            $out .= '</span>';
            break;
 
        default:
            break;
    }
    return $out;    
}






