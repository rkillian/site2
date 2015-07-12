<?php
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 185, 170, true );

function main_image() {
$files = get_children('post_parent='.get_the_ID().'&post_type=attachment
&post_mime_type=image&order=desc');
  if($files) :
    $keys = array_reverse(array_keys($files));
    $j=0;
    $num = $keys[$j];
    $image=wp_get_attachment_image($num, 'large', true);
    $imagepieces = explode('"', $image);
    $imagepath = $imagepieces[1];
    $main=wp_get_attachment_url($num);
		$template=get_template_directory();
		$the_title=get_the_title();
    print "<img src='$main' alt='$the_title' class='frame' />";
  endif;
}

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Menu',
		'before_widget' => '', // Removes <li>
		'after_widget' => '</div>', // Removes </li>
		'before_title' => '<h2>',
		'after_title' => '</h2><div class="content">',
	));


function polaroids_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'polaroids' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'polaroids' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'polaroids' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'polaroids' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'polaroids' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'polaroids' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}


//Required by WordPress
	add_theme_support('automatic-feed-links');
	
	//COMMENTS SCRIPT
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	
	//CONTENT WIDTH
		if ( ! isset( $content_width ) ) $content_width = 1200;
	
	//MENU
		//Register the main menu
			if ( function_exists( 'register_nav_menu' ) ) {
				register_nav_menu( 'main-menu', __('Main menu','polaroids') );
			}
	

	
//FILTERS

	//Output a custom title suffix based on phrase length
	//This is a feature that improves SEO by selecting a title that is as long
	//as possible, but that doesn't exceed the character limit displayed in search
	//engines. If no short enough suffix is found, the default is used (blog title)
		
		//Sort the array of suffixes by length
			function sort_suffixes($a,$b){
				return strlen($b)-strlen($a);
			}
			
		//Return the title_suffix
			function make_title($separator = "|"){
				$available_suffixes = get_option('polaroids_dynamic_suffixes',array(get_bloginfo('description')));
				$max_title_length = 65; //The maximum length of the title.
				
				usort($available_suffixes,'sort_suffixes');
				
				//Set the default suffix (the blog's name alone)
					$suffix = ' ' . get_bloginfo('description');
					
				//If it's not the frontpage and this feature is enabled, find an appropriate suffix in the array
					if(!is_front_page() && get_option('polaroids_use_dynamic_suffix',false)){
						foreach( $available_suffixes as $available_suffix ){
							//If the length of this suffix + title is short enough, make it the final suffix
							if ( strlen(utf8_decode((wp_title($separator,false,'right') . get_bloginfo('name') . ' | ' . $available_suffix))) <= $max_title_length ){
								$suffix = $available_suffix;
								break;//Keep the longest title only
							}
						}
					}
					
				echo( wp_title($separator,false,'right') . get_bloginfo('name') . ' | ' . $suffix );
			}

	//Output a custom description for the meta description tag
	//If the user fills in the description post meta, then that will be used as the blog description.
	//Otherwise, if there is an excerpt for the post, that will be used. Finally, if none of these are
	//set, then the bloginfo description will be used. If disabled, the default behavior will be used.		
		function make_description(){
		//Fill the description tags with a custom description, an excerpt or the blog description
			$description = get_bloginfo('description');//Default value
			if ( get_option('polaroids_use_dynamic_descriptions',false) ){
				if( isset($post) && get_post_meta($post->ID,'description',true) != ''){
					$description = get_post_meta($post->ID,'description',true);
				}
				elseif(is_single() && get_the_excerpt()!==''){
					$description = get_the_excerpt();
				}
			}			
			echo $description;
		}
		
	//Use the "x days ago" date format
		if( get_option('polaroids_use_human_readable_dates',false) ){
			function time_ago_date($date){
				return sprintf( _x("Posted %s ago",'The %s parameter is a date like "5 days" or "3 minutes"','polaroids'), human_time_diff(get_the_time('U'), current_time('timestamp')) );
			}
			add_filter('the_date','time_ago_date');
		}

	//Remove inline CSS placed by WordPress
		function my_remove_recent_comments_style() {
			add_filter( 'show_recent_comments_widget_style', '__return_false' );
		}
		add_action( 'widgets_init', 'my_remove_recent_comments_style' );
		
	//Add a label next to the media upload button, to make it easy to understand
		function custom_admin_js() {
			echo '
				<script type="text/javascript">
					var elem = document.getElementById("content-add_media");
					elem.innerHTML = "<img src=\''.get_bloginfo('template_directory').'/img/mediaupload.png\'/>'.__('Click to add pictures or videos','polaroids').'";</script>
			';
		}
		add_action('admin_footer', 'custom_admin_js');
		
	//Remove h1 tags and automatically show the kitchen sink
		function change_mce_options( $init ) {
			$init['theme_advanced_blockformats'] = 'p,code,h2,h3,h4,h5,h6';
			$init['theme_advanced_disable'] = 'forecolor';
			$init['wordpress_adv_hidden'] = false;
			return $init;
		}
		add_filter('tiny_mce_before_init', 'change_mce_options');
//ADMIN

	//Load the site's CSS in the editor
		add_editor_style('style.css');
		

	//Hide specific admin menus from non-admin users (if activated)
		if(!current_user_can('administrator')){ //Only hide menus for non-admins
			function remove_menus () {
				global $menu; //The WordPress admin menu. Contains a multi-dimensional array
				$menus_to_hide = array(); //The array of menus to hide, really.
				
				if(get_option('polaroids_hide_posts_menu',false)) 		array_push($menus_to_hide,__('Posts'));
				if(get_option('polaroids_hide_pages_menu',false)) 		array_push($menus_to_hide,__('Pages'));
				if(get_option('polaroids_hide_comments_menu',false)) 		array_push($menus_to_hide,__('Comments'));
				if(get_option('polaroids_hide_media_menu',false)) 		array_push($menus_to_hide,__('Media'));
				if(get_option('polaroids_hide_links_menu',false)) 		array_push($menus_to_hide,__('Links'));
				if(get_option('polaroids_hide_profile_menu',false)) 		array_push($menus_to_hide,__('Profile'));
				if(get_option('polaroids_hide_tools_menu',false)) 		array_push($menus_to_hide,__('Tools'));
				
				end ($menu);
				while (prev($menu)){
					$value = explode(' ',$menu[key($menu)][0]);
					if(in_array($value[0] != NULL?$value[0]:"" , $menus_to_hide)){unset($menu[key($menu)]);}
				}
			}
			add_action('admin_menu', 'remove_menus');
		}
		
	//Disable the admin bar for logged in users
		if(get_option('polaroids_hide_admin_bar',false)==true){
			add_filter( 'show_admin_bar', '__return_false' ); 
		}
		
	//Hide the admin bar logo for logged in users
		function annointed_admin_bar_remove() {
			  global $wp_admin_bar;

			  /* Remove their stuff */
			  $wp_admin_bar->remove_menu('wp-logo');
		}
		if(get_option('polaroids_hide_admin_bar_logo',false)==true){
			add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);
		}
		
	//Add the plugin options page
		add_action('admin_menu', 'polaroids_barebones_menu');
		function polaroids_barebones_menu() {
			add_theme_page('Theme options', 'Theme options', 'manage_options', 'polaroids', 'polaroids_theme_options');
		}
		function polaroids_theme_options() {
			//Display the theme options
				include('theme-options.php');
		}

	//Hide the description and URL fields for attachments, as well as "Insert into post"
		function hide_attachment_fields($form_fields, $post) {
			if(!current_user_can('administrator')){
				if(get_option('polaroids_hide_attachment_caption',false)==true){
					$form_fields['post_excerpt']['value'] = '';
					$form_fields['post_excerpt']['input'] = 'hidden';
				}
				if(get_option('polaroids_hide_attachment_description',false)==true){
					$form_fields['post_content']['value'] = '';
					$form_fields['post_content']['input'] = 'hidden';
				}
				if(get_option('polaroids_hide_attachment_link',false)==true){
					$form_fields['url']['value'] = '';
					$form_fields['url']['input'] = 'hidden';
				}
			}
			return $form_fields;
		}
		add_filter("attachment_fields_to_edit", "hide_attachment_fields", null, 2);
		
	//Hide file upload tabs
		function remove_media_library_tab($tabs) {
			if (!current_user_can('administrator') && get_option('polaroids_hide_attachment_library',false)==true && isset($_REQUEST['post_id'])) {
				unset($tabs['library']);
			}
			return $tabs;
		}
		add_filter('media_upload_tabs', 'remove_media_library_tab');

//LOCALIZATION
	
	//Enable localization
		load_theme_textdomain('polaroids',get_template_directory() . '/languages');
		
		
//UTILITY
	
	//URL validator
		function is_valid_url($URL) {
			$v = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
			return (bool)preg_match($v, $URL);
		}
?>