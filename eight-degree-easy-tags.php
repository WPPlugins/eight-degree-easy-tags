<?php
defined('ABSPATH') or die('NO Script Kiddes Please!');
/*
Plugin Name: Eight Degree Easy Tags
Plugin URI: https://8degreethemes.com/wordpress-plugins/eight-degree-easy-tags/
Description: A plugin to diplay your tags with multiple style options
Version: 1.0.0
Author: 8degree Themes
Author URI: https://8degreethemes.com/
License: GPLV2 
License URI: https://www.gnu.org/licenses/gpl-2.0.en.html
Domain Path: /languages/
Text Domain: eight-degree-easy-tags
*/


//registering and initializing  plugin
include_once('inc/backend/edet_widgets.php');

if(!class_exists('EDET_Class')){
	
	class EDET_Class{
	    //priority based loading and performing hooking with plugin installation
		function __construct(){
			$this->define_constants();
			
			add_action('init',array($this, 'edet_text_domain'));
			add_action('init',array($this, 'edet_post_prop'));
			add_action('admin_menu' , array($this,'remove_edet_post_custom_fields' ));	
			add_action('admin_menu',array($this,'edet_submenu_help'));
			add_action('admin_menu' , array($this,'edet_submenu_about'));
			add_action('admin_enqueue_scripts', array($this,'edet_enqueue_backend'));
			add_action('wp_enqueue_scripts', array($this,'edet_enqueue_frontend'));
			register_activation_hook( __FILE__ , array($this,'edet_load_default'));
			add_action('add_meta_boxes', array($this,'edet_meta_boxes'));
			add_action('add_meta_boxes', array($this,'edet_shortcode_box'));
			add_action('save_post', array($this,'save_edet_fields'));
			add_action('widgets_init', array($this, 'edet_widget'));
			add_shortcode('edet', array($this,'edet_shortcode'));
			add_filter('manage_edet_post_prop_posts_columns', array($this,'set_custom_edit_edet_post_prop_columns'));
			add_action('manage_edet_post_prop_posts_custom_column', array($this,'custom_edit_edet_post_column'),10,2);
			add_filter('body_class', array($this,'edet_enabled_class'));
			add_filter('wp_generate_tag_cloud_data', array($this,'edet_tag_cloud_class_second'),10,1);
			
		}
		//text domain for translation
		function edet_text_domain(){
			load_plugin_textdomain( 'eight-degree-easy-tags', false, basename(dirname( __FILE__ )));
		}
		//path definition
		function define_constants(){
			
			defined('EDET_PATH')or    define('EDET_PATH',plugin_dir_path(__FILE__));
			defined('EDET_VERSION')or define('EDET_VERSION','1.0.0');
			defined('EDET_CSS_DIR')or define('EDET_CSS_DIR',plugin_dir_url(__FILE__).'css');
			defined('EDET_JS_DIR')or  define('EDET_JS_DIR',plugin_dir_url(__FILE__).'js');
			defined('EDET_IMG_DIR')or define('EDET_IMG_DIR',plugin_dir_url(__FILE__).'images');	
			
		}
		//call to include div class 'edet-enabled' at frontend body with plugin installation
		function edet_enabled_class( $classes ) {

			$classes[] = 'edet-enabled';
			return $classes;
		}
		//including necessary backend assets
		function edet_enqueue_backend( $hook_suffix){

			wp_enqueue_style('edet-backend-style',EDET_CSS_DIR.'/backend.css',array(),EDET_VERSION);
			wp_enqueue_script('edet-backend-style-script',EDET_JS_DIR.'/backend.js',array('jquery','wp-color-picker'),EDET_VERSION);
			wp_enqueue_style( 'wp-color-picker' );
			wp_register_style( 'font-awesome',EDET_CSS_DIR.'/font-awesome.min.css',array(),EDET_VERSION);
	        wp_enqueue_style( 'font-awesome' );
		}
		//including neccessary frontend assest
		function edet_enqueue_frontend($hook_suffix){

			wp_enqueue_style('edet-frontend-style',EDET_CSS_DIR.'/frontend.css',array(),EDET_VERSION);
			wp_enqueue_script('edet-frontend-style-script',EDET_JS_DIR.'/frontend.js',array('jquery'),EDET_VERSION);
			
		}
		//defining and registering post type
		function edet_post_prop(){
			include(EDET_PATH.'/inc/backend/edet_register_post.php');
		}
		
		function edet_submenu_help(){
				add_submenu_page( 'edit.php?post_type=edet_post_prop',
				 __('Help','eight-degree-easy-tags'),
				 __('How to use','eight-degree-easy-tags'), 
				 'manage_options','edet_help',
				 array($this,'edet_submenu_help_callback') );
		}
		function edet_submenu_help_callback(){
				include(EDET_PATH.'/inc/backend/edet_help.php');
		}
		function edet_submenu_about() {
			    
			    add_submenu_page('edit.php?post_type=edet_post_prop', 
			    	__('About','eight-degree-easy-tags'), 
			    	__('About','eight-degree-easy-tags'), 
			    	'manage_options', 
			    	'edet_about', 
			    	array($this,'edet_submenu_about_callback'));
			}
		function edet_submenu_about_callback(){
				include(EDET_PATH.'inc/backend/edet_about.php');
		}
		//creating metabox
		function edet_meta_boxes(){
			
			add_meta_box('edet_meta_boxes','Eight Degree Easy Tags',
							array($this,'edet_menu_post_callback'),
							'edet_post_prop','normal', 'high');
		}
		//including back endform into metabox 
		function edet_menu_post_callback($post){
			
			include(EDET_PATH.'/inc/backend/edet_form_elments.php');
			
		}
		//default values while post is empty
		function edet_load_default(){

			$get_defaults=$this->edet_default_settings();
			if(!get_option('edet_load_default')){
				update_option('edet_load_default',$get_defaults);

			}

		}
		//saving user submission to database
		function save_edet_fields($post_id){
			include(EDET_PATH.'/inc/backend/edet_save_settings.php');
		}
		//creating edet widget
		function edet_widget(){
			register_widget( 'edet_widget_class' );
		}
		//for printing array
		function p_a($p){
			echo"<pre>";
			print_r($p);
			echo"</pre>";
		}
		//generating shortcode for edet
		function edet_shortcode($atts){
			ob_start();
			if(function_exists('wp_tag_cloud')){
				global $post; 
				$original_post=$post;
				$args=array('post_type'=>array('edet_post_prop',),
					'post_status'=>array('publish',),
					'posts_per_page'=>1,);
				//checking for existence of custom type post 
				//and applying query according to above $args
				//for custom post type--->edet_post_prop
				$edet_query = new WP_Query($args);
				
				if ($edet_query->have_posts()) {
					while ($edet_query->have_posts()){
							$edet_query->the_post();
							$edet_post_id = get_the_ID();
					}//do shortcode according to custom post type id
					$edet_shortcode_atts = shortcode_atts( array('tag_id' => $edet_post_id), $atts );
					$edet_filter_prop_result = get_post_meta($edet_shortcode_atts['tag_id'],'edet_properties',true);
					//condition check from tirgger hooks to provide additonal style and css for frontend
					$show_count = isset($edet_filter_prop_result['tag_filter'])?1:0;
					if($show_count){
						add_filter('wp_generate_tag_cloud_data', array($this,'edet_tag_cloud_class'));
						add_filter('wp_generate_tag_cloud',array($this,'edet_set_wp_generate_tag_cloud'), 10, 3);

					}
					//check to display tag cloud
					$tag_enable = isset($edet_filter_prop_result['tag_enable'])?1:0;

					//include or exclude
					if(isset($edet_filter_prop_result['tag_inc_exc'])){
					$all=array();
					$exclude=array();
					$include=array();
					switch(true){
					case   $edet_filter_prop_result['tag_inc_exc']=="tag_all":
							$all['all']=$edet_filter_prop_result['tag_do'];
							$exclude['exclude_ex']=NULL;
							$include['include_in']=NULL;									
						break;
					case   $edet_filter_prop_result['tag_inc_exc']=="tag_exclude":
						# code...
							$exclude['exclude_ex']=$edet_filter_prop_result['tag_do'];
							$all['all']=NULL;
							$include['include_in']=NULL;
						break;
					case $edet_filter_prop_result['tag_inc_exc']=="tag_include":
						# code...
							$include['include_in']=$edet_filter_prop_result['tag_do'];
							$exclude['exclude_ex']=NULL;
							$all['all']=NULL;
						break;
					default;
						$all['all']=$edet_filter_prop_result['tag_do'];
						$exclude['exclude_ex']=NULL;
						$include['include_in']=NULL;
					}
					}
					else{
						$all['all']=$edet_filter_prop_result['tag_do'];
					}
					
					//passing arguments from user setup
					$args=array(
						'smallest'									=> $edet_filter_prop_result['tag_min_text_size'],
						'largest' 									=> $edet_filter_prop_result['tag_max_text_size'],
						'unit' 										=> $edet_filter_prop_result['tag_unit'],
						'number' 									=> $edet_filter_prop_result['tag_number'],
						'format' 									=> $edet_filter_prop_result['tag_layout'],
						'separator'	 								=> $edet_filter_prop_result["tag_separator"],
						'orderby' 									=> $edet_filter_prop_result['tag_order_by'],
						'order' 									=> $edet_filter_prop_result['tag_order'],
						'exclude' 									=> $exclude['exclude_ex'],
						'filter'									=> $show_count,
				    	'include' 									=> $include['include_in'],
						'topic_count_text_callback' 				=> array($this,'edet_tag_text_callback'),
						'link' 										=> $edet_filter_prop_result['tag_link'],
						'taxonomy'									=> $edet_filter_prop_result['tag_taxonomy'],
						'echo'										=>$tag_enable
							);
						?>
							<?php if(isset($edet_filter_prop_result['tag_enable'])==1){
								?>
								<div class="edet-text-description">
								<?php esc_attr_e($edet_filter_prop_result['tag_description']);?>
								</div>
								<?php
								}?>
							
							<div class="edet-tag-cloud-<?php esc_attr_e($edet_filter_prop_result['tag_layout']);?>">
							<input type="hidden" class="edet-font-data" 
									edet-data-font-transform="<?php esc_attr_e($edet_filter_prop_result['tag_text_case']);?>" 
									edet-data-alignment="<?php esc_attr_e($edet_filter_prop_result['tag_text_align']);?>" 
									edet-data-font-weight="<?php esc_attr_e($edet_filter_prop_result['tag_text_weight']);?>" 
									edet-data-font-style="<?php esc_attr_e($edet_filter_prop_result['tag_text_style']);?>" 
									 />

								<div id="edet-<?php esc_attr_e($edet_shortcode_atts['tag_id']);?>" class="edet-tag-cloud-wrapper <?php esc_attr_e($edet_filter_prop_result['tag_template']);?>">
									<?php
									$var_edet_tag = wp_tag_cloud($args);
									?>
								</div>
								
							</div>
							<?php
				}else{		//passing arguments with default values while edet not set
							$edet_filter_prop_result=$this->edet_default_settings();
							$args=array(
								'smallest'					=> $edet_filter_prop_result['tag_min_text_size'],
								'largest' 					=> $edet_filter_prop_result['tag_max_text_size'],
								'unit' 						=> $edet_filter_prop_result['tag_unit'],
								'number' 					=> $edet_filter_prop_result['tag_number'],
								'format' 					=> $edet_filter_prop_result['tag_layout'],
								'separator'	 				=> $edet_filter_prop_result["tag_separator"],
								'orderby' 					=> $edet_filter_prop_result['tag_order_by'],
								'order' 					=> $edet_filter_prop_result['tag_order'],
								'filter'					=> 0,
				        		'topic_count_text_callback' => array($this,'edet_tag_text_callback_default'),
								'link' 						=> $edet_filter_prop_result['tag_link'],
								'taxonomy'					=> $edet_filter_prop_result['tag_taxonomy'],
								'echo' 						=> 1,
								);
								?>

								<div class="edet-text-description">
								<?php esc_attr_e($edet_filter_prop_result['tag_description']);?>
								</div>
								<div class="edet-tag-cloud-flat">
									<div id="edet-default-id" class="edet-tag-cloud-wrapper edetCustomClass   template-10 ">
										<?php	//default tag cloud handler
										$var_edet_tag=wp_tag_cloud($args );
										?>
									</div>
								</div>
								<div class="edet-text-description">
								<?php esc_attr_e($edet_filter_prop_result['tag_description']);?>
								</div>	
								<?php
					}
							$post=$original_post;
							setup_postdata( $post );
							wp_reset_postdata();
				}
				$form_html = ob_get_contents();
				ob_end_clean();
				return $form_html;

		}

		//defines custom  title for wp list table
		function set_custom_edit_edet_post_prop_columns($columns){
				$columns['shortcode']= __('Use Shortcodes','eight-degree-easy-tags');
				$columns['template']= __('Include into Template','eight-degree-easy-tags');
				return $columns;
		}
		//adds column contents for added custom type post
		function custom_edit_edet_post_column($column,$post_id){
			if($column=='shortcode'){
				$id=$post_id;
				?>
				<textarea name="" style="" rows="2" cols="20" readonly="readonly" >[edet tag_id="<?php echo $post_id;?>"]</textarea>
				<?php
			}
				if($column=='template'){
					?>
					<textarea name="" style="" rows="2" cols="49" readonly="readonly">&lt;?php echo do_shortcode("[edet tag_id='<?php echo $post_id; ?>']"); ?&gt;</textarea>
						<?php
				}
		}
		//defines shortcode meta box
		function edet_shortcode_box(){
				add_meta_box( 'edet_shortcode_usage_option',
					__('EDET Shortcodes','eight-degree-easy-tags'), 
					array($this,'edet_shortcode_box_callback'), 
					'edet_post_prop', 'side' );
		}
		//edet shortcode call back
		function edet_shortcode_box_callback($post){
				wp_nonce_field( basename( __FILE__ ), 'edet_shortcode_usage_option' );
				$edet_stored_meta = get_post_meta( $post->ID,'edet_properties',true );
				include(EDET_PATH.'/inc/backend/edet_shortcode_options.php');
		}
		//Setting up default values for a default tag cloud
		function edet_default_settings(){
       		
			$edet_properties=array();

			$edet_properties['tag_enable']			= 1;
			$edet_properties['tag_description']		=__('EDET Tags' ,'eight-degree-easy-tags');
			$edet_properties['tag_layout']			='flat';
			$edet_properties['tag_unit']			='pt' ;
			$edet_properties['tag_number']			='20';
			$edet_properties['tag_order_by']		='count' ;
			$edet_properties['tag_order']			='asc' ;
			$edet_properties['tag_separator']		="\n" ;
			$edet_properties['tag_text_alignment']	='middle' ;
			$edet_properties['tag_min_text_size']	='10' ;
			$edet_properties['tag_max_text_size']	='30' ;
			$edet_properties['tag_text_case']		='lower' ;
			$edet_properties['tag_template']		='Template6' ;
			$edet_properties['tag_link']			='link' ;
			$edet_properties['tag_taxonomy']		=array('post_tag') ;
			$edet_properties['tag_filter']			=1;

			return $edet_properties;

		}

		//adds a custom css class--->tagcount in span of tag term
		function edet_set_wp_generate_tag_cloud($content, $tags, $args){ 

				$count=0;
				$output=preg_replace_callback('(</a\s*>)', 
					function($match) use ($tags, &$count) {
						return "<span class=\"tagcount\">"."<span>".$tags[$count++]->count."</span>"."</span></a>";  
					}
					, $content);

				return $output;
		}										

		//adds a custom css class--->edetCustomClass
		function edet_tag_cloud_class($tags_data) {
				foreach ($tags_data as $key => $tag) {
						$tags_data[$key]['class'] =  $tags_data[$key]['class'] ." edetCustomClass";
				}
					return $tags_data;
		}


		//adds a css class-->edetCustomClassSecond
		function edet_tag_cloud_class_second($tags_data_second){

				foreach($tags_data_second as $key_second =>$tag_second){
						$tags_data_second[$key_second]['class']= $tags_data_second[$key_second]['class']." edetCustomClassSecond";
				}
				return $tags_data_second;

		}

		//to hide wp_tag_cloud default topic count display
		function edet_tag_text_callback( $count ) {
			return Null;
		}
		
		//to show edet style of topic count
		function edet_tag_text_callback_default( $count){
			return sprintf( _n( '%s edet on this topic !', '%s edets on this topic !', $count,'eight-degree-easy-tags' ), number_format_i18n( $count ) );

		}
		//removes slug metabox for edet cpt
		function remove_edet_post_custom_fields() {
			remove_meta_box( 'slugdiv' , 'edet_post_prop' , 'normal' ); 
		}
		

	}	//end of class EDET_Class
		//creating an object for the class
		$edet_obj =new EDET_Class();
		

}



