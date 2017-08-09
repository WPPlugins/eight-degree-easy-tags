<?php
defined('ABSPATH') or die('No script kiddies please!');
$is_autosave = wp_is_post_autosave( $post_id );
//check for nonce validity 
$is_revision = wp_is_post_revision( $post_id );
$is_valid_nonce = ( isset( $_POST['edet_nonce'] ) && wp_verify_nonce( $_POST['edet_nonce'], 'edet_save' ) ) ? 'true' : 'false';
if($is_autosave || $is_revision || $is_valid_nonce){

      $edet_stored_meta=array();


      if(isset($_POST['tag_enable'])){
            $edet_properties['tag_enable'] = sanitize_text_field($_POST['tag_enable']);
      }

      if(isset($_POST['tag_layout'])){
            $edet_properties['tag_layout'] = sanitize_text_field($_POST['tag_layout']);

      }

      if(isset($_POST['tag_unit'])){
            $edet_properties['tag_unit'] = sanitize_text_field($_POST['tag_unit']);

      }

      if(isset($_POST['tag_description'])){
            $edet_properties['tag_description'] = sanitize_text_field($_POST['tag_description']);

      }

      if(isset($_POST['tag_number'])){
            $edet_properties['tag_number'] = sanitize_text_field($_POST['tag_number']);

      }

      if(isset($_POST['tag_order_by'])){
            $edet_properties['tag_order_by'] = sanitize_text_field($_POST['tag_order_by']);

      }

      if(isset($_POST['tag_order'])){
            $edet_properties['tag_order'] = sanitize_text_field($_POST['tag_order']);

      }

      if(isset($_POST['tag_separator'])){
            $edet_properties['tag_separator'] = sanitize_text_field($_POST['tag_separator']);

      }

      if(isset($_POST['tag_text_alignment'])){
            $edet_properties['tag_text_alignment'] = sanitize_text_field($_POST['tag_text_alignment']);
      }

      if(isset($_POST['tag_min_text_size'])){
            $edet_properties['tag_min_text_size'] = absint($_POST['tag_min_text_size']);
            $edet_properties['tag_min_text_size'] = sanitize_text_field($_POST['tag_min_text_size']);
      }


      if(isset($_POST['tag_max_text_size'])){
            $edet_properties['tag_max_text_size'] = absint($_POST['tag_max_text_size']);
            $edet_properties['tag_max_text_size'] = sanitize_text_field($_POST['tag_max_text_size']);

      }


      if(isset($_POST['tag_text_case'])){
            $edet_properties['tag_text_case'] = sanitize_text_field($_POST['tag_text_case']);

      }

      if(isset($_POST['tag_template'])){
            $edet_properties['tag_template'] = sanitize_text_field($_POST['tag_template']);
      }

      $edet_properties['tag_do'] = array();
      if(isset($_POST['tag_do'])){
            foreach($_POST['tag_do'] as $tag_excludes =>$tag_exclude){
                  $edet_properties['tag_do'][$tag_excludes]=$tag_exclude;
            }
      }

      if(isset($_POST['tag_link'])){
            $edet_properties['tag_link'] = sanitize_text_field($_POST['tag_link']);

      }
      

      $edet_properties['tag_taxonomy'] = array();

      if(isset($_POST['tag_taxonomy'])){
            foreach ($_POST['tag_taxonomy'] as $tag_taxonomies => $tag_taxonomy) {
                  $edet_properties['tag_taxonomy'][$tag_taxonomies] = $tag_taxonomy;
            }
      }

      if(isset($_POST['tag_filter'])){
            $edet_properties['tag_filter'] = sanitize_text_field($_POST['tag_filter']);
      }

      if(isset($_POST['tag_text_style'])){
            $edet_properties['tag_text_style'] = sanitize_text_field($_POST['tag_text_style']);

      }


      if(isset($_POST['tag_text_align'])){
            $edet_properties['tag_text_align'] = sanitize_text_field($_POST['tag_text_align']);

      }

      if(isset($_POST['tag_text_weight'])){
            $edet_properties['tag_text_weight'] = sanitize_text_field($_POST['tag_text_weight']);

      }

      if(isset($_POST['tag_inc_exc'])){
            $edet_properties['tag_inc_exc'] = sanitize_text_field($_POST['tag_inc_exc']);

      }



      $edet_stored_meta=update_post_meta( $post_id, 'edet_properties', $edet_properties );
}else{
      die('No script kiddies please!');
}



