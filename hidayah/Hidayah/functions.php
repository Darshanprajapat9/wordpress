<?php  

/* style and script add  */
function hidayah_scripts(){

wp_enqueue_style('style' ,get_stylesheet_uri());

wp_enqueue_style('bootstrap-style', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css');
wp_enqueue_style('bootstrap-style', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css');

wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.js');


}
add_action( 'wp_enqueue_scripts', 'hidayah_scripts' );

/* navigation*/

function hidayah_theme_setup(){

     add_theme_support( 'post-thumbnails' );
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_image_size('single-img', 600 , 550 ,array('center','center'));
    

    register_nav_menus( array(
        'primary'   => __( 'Primary Menu', 'hidayah' )
    
    ) );
}
add_action('after_setup_theme','hidayah_theme_setup');


/*just widgets */

function mytheme_widgets_init(){
    
   

    register_sidebar( array(
		'name'          => __( 'footer Sidebar 1', 'hidayah' ),
		'id'            => 'footer-1',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
	
	) );

    register_sidebar( array(
		'name'          => __( 'footer Sidebar 2', 'hidayah' ),
		'id'            => 'footer-2',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		
	) );

    register_sidebar( array(
		'name'          => __( 'footer sidebar', 'hidayah' ),
		'id'            => 'footer-3',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		
	) );

	

}
add_action('widgets_init' ,'mytheme_widgets_init');

/* custom post */

function custom_post_type() {
	register_post_type('movies',
		array(
			'labels'      => array(
				'name'          => __('Movies', 'textdomain'),
				'singular_name' => __('movie', 'textdomain'),
			),
				'public'      => true,
				'has_archive' => true,
				'supports'            => array( 'title', 'editor',   'thumbnail', 'custom-fields', ),
		)
	);
}
add_action('init', 'custom_post_type');



/*  custom metabox */
 
   add_action( 'add_meta_boxes', 'mytheme_add_meta_box');  //add_meta_boxes is hook name and mytheme_add_meta_box is function name

   add_action('save_post','wp_metabox_postdata');  //save custome post data
 
function mytheme_add_meta_box(){

	$screens = ['post','page','Movies'];   // at per post,page,movies  show in metabox
	
	foreach($screens as  $screen ){
		//add_meta_box($id , $title , $callback , null , 'advanced' , 'default' , null);
		add_meta_box('wpdev_meta_box','Movies data' , 'wpdev_movieblock', $screen , 'advanced' , 'default' , null ); //what showing  metabox 
	}

}
function wpdev_movieblock($post){

	global $post;
	
	$price = get_post_meta($post->ID ,'_price',true);
	$date = get_post_meta($post->ID ,'_date',true);
	
	echo "<input type='number' name='wp_metabox_price' class='from-control'   value='{$price}' />";
	echo "<input type='date' name='wp_metabox_date' class='from-control'  value='{$date}'  />";
}
function wp_metabox_postdata($post_id){
	
	if(array_key_exists('wp_metabox_price',$_POST)){
		update_post_meta($post_id , '_price',$_POST['wp_metabox_price']);
    }
	if(array_key_exists('wp_metabox_date',$_POST)){
		update_post_meta($post_id , '_date',$_POST['wp_metabox_date']);
	}
}
/*
function hcf_register_meta_boxes() {
    add_meta_box( 'hcf-1', __( 'Hello Custom Field', 'hcf' ), 'Movies', 'post' );
}
add_action( 'add_meta_boxes', 'hcf_register_meta_boxes' );

function hcf_display_callback( $post ) {
    echo "Hello Custom Field";
}
*/
?>
