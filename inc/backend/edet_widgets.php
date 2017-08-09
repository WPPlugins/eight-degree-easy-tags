<?php
defined('ABSPATH') or die("No script kiddies please!");
class edet_widget_class extends WP_Widget {

 function __construct() {
  parent::__construct('edet_widget_class',
   'Eight Degree Easy Tag', 
   array('description' => __('Use widget to  sidebars, footers, etc.', 'eight-degree-easy-tags')));
}
function widget($args, $instance) {

  echo $args['before_widget'];
  echo '<div class="">';
  if (!empty($instance['title'])) {
    echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
  }
  $select_id = isset($instance['select_id'])?$instance['select_id']:'';
  echo do_shortcode("[edet tag_id='". $select_id."']");
  echo '</div>';
  echo $args['after_widget'];
}
function form($instance) {
  global $post;
  $edet_widget_title = isset($instance['title'])?$instance['title']:'';
  $edet_widget_id = isset($instance['select_id'])?$instance['select_id']:'';
  ?>
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'eight-degree-easy-tags'); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($edet_widget_title); ?>"/>

  </p>
  <p>
    <label for="<?php echo $this->get_field_id('select_id'); ?>"><?php _e('Choose Tag:', 'eight-degree-easy-tags'); ?></label>
    <select name="<?php echo $this->get_field_name('select_id'); ?>" class='widefat' id="<?php echo $this->get_field_id('select_id'); ?>" type="text">
     <?php 
     $select_id = get_terms('select_id',array('order'=>'ASC','orderby'=>'id'));
     $args = array(
      'post_type'     => 'edet_post_prop',
      'post_status'   => 'publish',
      'posts_per_page'=>  -1  );
     $edet_posts = get_posts( $args );
     if(!empty($edet_posts))
     {
      foreach($edet_posts as $edet_post)
      { 
        ?>
        <option value="<?php echo $edet_post->ID;?>" <?php if($edet_post->ID==$edet_widget_id){?>selected="selected"<?php }?>><?php echo esc_attr($edet_post->post_title);?>

        </option>
        <?php 
      }
    }
    ?>
  </select>
</p>
<?php
}

function update($new_instance, $old_instance) {
  $instance = $old_instance;
  $instance['title'] = isset($new_instance['title'])?strip_tags($new_instance['title']):'';
  $instance['select_id'] = isset($new_instance['select_id'])?strip_tags($new_instance['select_id']):'';
  return $instance;
}

}


