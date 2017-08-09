<?php
defined('ABSPATH') or die('No script kiddies please!');
wp_nonce_field( 'edet_save', 'edet_nonce' );

$edet_stored_meta = get_post_meta( $post->ID,'edet_properties',true );

?>				
<div class="edet-outer-wrapper"><!-- Outer most div wrapper -->	
	<ul><!-- First Menu Block items here  -->
		<li><a href="#" class="edettogglelink edet-menu "><h2 class="edet-menu-head edet-menu-open ">Tags Properties</h2></a></li>
		<div class="two-col-special-a edet-toggle-field" style="display: block;">
			<div class="edet-checkbox">
				<label for="edetEnable" class="edet-checkbox-label"><?php esc_attr_e( 'Enable', 'eight-degree-easy-tags' ); ?></label>
				<input type="checkbox" name="tag_enable" id="edetEnable" <?php if(isset($edet_stored_meta['tag_enable'])) echo 'checked';?> />
				<span class="edet-options-span"><?php esc_attr_e('(Enable Tag Functionality)','eight-degree-easy-tags');?></span>	
			</div>

			<div class="edet-text_input">
				<label for="tagDescription"  class="edet-text-input-label"><?php esc_attr_e( 'Description', 'eight-degree-easy-tags' ); ?></label>
				<textarea name="tag_description" id="tagDescription"  class="edet-text-input-input" ><?php if(!empty($edet_stored_meta['tag_description'])){
					echo esc_attr($edet_stored_meta['tag_description']);
				}
				?></textarea>  		

				<span class="edet-text-input-span"><?php esc_attr_e( '(Describe here about your tag)', 'eight-degree-easy-tags' ); ?></span>             
			</div>

			<div class="edet-options">
				<label for="tagTemplate" class="edet-options-label"><?php esc_attr_e( 'Tag Template', 'eight-degree-easy-tags' ); ?></label>
				<select name="tag_template" id="tagTemplate" class="edet-options-select edet-template-change">
					<?php 
					for($e=1;$e<=15;$e++){
						?>
						<option class="edet-options-select-<?php esc_attr_e($e);?>"  value="template-<?php esc_attr_e($e);?>" 
							<?php if(!empty($edet_stored_meta['tag_template'])){selected($edet_stored_meta['tag_template'],esc_attr("template-".$e));}  ?>>
							<?php _e('Template-','eight-degree-easy-tags'); esc_attr_e($e); ?>
						</option>
						<?php
					} 
					?>
				</select>
				
				<div class="edet-enabled clearfix">
					<div id="edet-279" class="edet-tag-cloud-wrapper ">
						<a href="#" class="tag-link-49 edetCustomClassSecond edetCustomClass tag-link-position-1" >tag1<span class="tagcount"><span>1</span></span></a>
						<a href="#" class="tag-link-49 edetCustomClassSecond edetCustomClass tag-link-position-2" >tag2<span class="tagcount"><span>1</span></span></a>
						<a href="#" class="tag-link-49 edetCustomClassSecond edetCustomClass tag-link-position-3" >tag3<span class="tagcount"><span>1</span></span></a>

					</div>
				</div>
				
				<span class="edet-options-span"><?php _e('(Choose template for changing tags styles)','eight-degree-easy-tags');?></span>
			</div>
			<div class="edet-options">
				<label for="tagCase" class="edet-options-label"><?php esc_attr_e( 'Letter Case', 'eight-degree-easy-tags' ); ?></label>
				<select name="tag_text_case" class="edet-options-select" id="tagCase">
					<option  value="lowercase"<?php if(!empty($edet_stored_meta['tag_text_case'])) selected($edet_stored_meta['tag_text_case'],'lowercase');?>><?php _e('Lowercase','eight-degree-easy-tags')?>
					</option>
					<option  value="uppercase"<?php if(!empty($edet_stored_meta['tag_text_case'])) selected($edet_stored_meta['tag_text_case'],'uppercase');?>><?php _e('Capitalize','eight-degree-easy-tags')?>
					</option>
					<option value="capitalize"<?php if(!empty($edet_stored_meta['tag_text_case'])) selected($edet_stored_meta['tag_text_case'],'capitalize');?>><?php _e('Uppercase','eight-degree-easy-tags')?>
					</option>
				</select>
				<span class="edet-options-span"><?php _e('(Choose tag font for upper or lower case)','eight-degree-easy-tags');?></span>
			</div>

			<div class="edet-options">
				<label for="tagfontstyle" class="edet-options-label"><?php esc_attr_e( 'Font Style', 'eight-degree-easy-tags' ); ?></label>   		
				<select name="tag_text_style" class="edet-options-select" id="tagfontstyle">
					<option  value="normal"<?php if(!empty($edet_stored_meta['tag_text_case'])) selected($edet_stored_meta['tag_text_style'],'normal');?>><?php _e('Normal','eight-degree-easy-tags')?>	
					</option>
					<option  value="italic"<?php if(!empty($edet_stored_meta['tag_text_case'])) selected($edet_stored_meta['tag_text_style'],'italic');?>><?php _e('Italic','eight-degree-easy-tags')?>
					</option>
					<option  value="oblique"<?php if(!empty($edet_stored_meta['tag_text_case'])) selected($edet_stored_meta['tag_text_style'],'oblique');?>><?php _e('Oblique','eight-degree-easy-tags')?>
					</option>
				</select>
				<span class="edet-options-span"><?php _e('(Choose tag font style)','eight-degree-easy-tags');?></span>
			</div>

			<div class="edet-options">
				<label for="tagAlignment" class="edet-options-label"><?php esc_attr_e( 'Text Alignment', 'eight-degree-easy-tags' ); ?></label>
				<select name="tag_text_align" class="edet-options-select" id="tagAlignment">
					<option value="right"<?php if(!empty($edet_stored_meta['tag_text_align'])) selected($edet_stored_meta['tag_text_align'],'right');?>><?php _e('Right','eight-degree-easy-tags')?>
					</option>
					<option  value="center"<?php if(!empty($edet_stored_meta['tag_text_align'])) selected($edet_stored_meta['tag_text_align'],'center');?>><?php _e('Center','eight-degree-easy-tags')?>						
					</option>
					<option value="left"<?php if(!empty($edet_stored_meta['tag_text_align'])) selected($edet_stored_meta['tag_text_align'],'left');?>><?php _e('Left','eight-degree-easy-tags')?>
					</option>
				</select>
				<span class="edet-options-span"><?php _e('(Choose for text alignment)','eight-degree-easy-tags');?></span>
			</div>

			<div class="edet-options">
				<label for="tagWeight" class="edet-options-label"><?php esc_attr_e( 'Text Weight', 'eight-degree-easy-tags' ); ?></label>
				<select name="tag_text_weight" class="edet-options-select" id="tagWeight">
					<option value="normal"<?php if(!empty($edet_stored_meta['tag_text_weight'])) selected($edet_stored_meta['tag_text_weight'],'normal');?>><?php _e('Normal','eight-degree-easy-tags')?>
					</option>
					<option value="bold"<?php if(!empty($edet_stored_meta['tag_text_weight'])) selected($edet_stored_meta['tag_text_weight'],'bold');?>><?php _e('Bold','eight-degree-easy-tags')?>
					</option>
				</select>
				<span class="edet-options-span"><?php _e('(Choose Text weight)','eight-degree-easy-tags');?></span>
			</div>

		</div>

		<!-- Second Menu Block items here -->
		<li><a href="#" class="edettogglelink edet-menu "><h2 class="edet-menu-head ">Tags Options</h2></a></li>
		<div class="two-col-special-b edet-toggle-field" style="display: none;">			
			<div class="edet-text-input tagMinTextSize">
				<label for="tagMinTextSize" class="edet-text-input-label"><?php esc_attr_e( 'Minimum Text Size', 'eight-degree-easy-tags' ); ?></label>
				<input type="number" class="edet-text-input-input" name="tag_min_text_size" id="tagMinTextSize" value="<?php if(!empty($edet_stored_meta['tag_min_text_size'])){
					echo esc_attr($edet_stored_meta['tag_min_text_size']);
				}?>"  />
				<span class="edet-text-input-span"><?php esc_attr_e( '(Minimum size of text for tag, eg:8)', 'eight-degree-easy-tags' ); ?></span>
			</div>
			<div class="edet-text-input tagMaxTextSize">
				<label for="tagMaxTextSize" class="edet-text-input-label"><?php esc_attr_e( 'Maximum Text Size', 'eight-degree-easy-tags' ); ?></label>
				<input type="number" class="edet-text-input-input" name="tag_max_text_size" id="tagMaxTextSize" value="<?php if(!empty($edet_stored_meta['tag_max_text_size'])){
					echo esc_attr($edet_stored_meta['tag_max_text_size']);
				}?>"  />
				<span class="edet-text-input-span"><?php esc_attr_e( '(Maximum size of text for tag, eg:22)', 'eight-degree-easy-tags' ); ?></span>
			</div>        	

			<div class="edet-options">
				<label for="tagUnit" class="edet-options-label"><?php esc_attr_e( 'Tag unit', 'eight-degree-easy-tags' ); ?></label>
				<select name="tag_unit" id="tagUnit" class="edet-options-select">
					<option value="pt" <?php if ( ! empty ( $edet_stored_meta['tag_unit'] ) ) { selected( $edet_stored_meta['tag_unit'], 'pt' );} ?>><?php _e( 'pt')?> 	
					</option>
					<option value="px" <?php if ( ! empty ( $edet_stored_meta['tag_unit'] ) ) {selected( $edet_stored_meta['tag_unit'], 'px' );} ?>><?php _e( 'px')?>
					</option>
					<option  value="%" <?php if ( ! empty ( $edet_stored_meta['tag_unit'] ) ) {selected( $edet_stored_meta['tag_unit'], '%' );} ?>><?php _e( '%')?>
					</option>
					<option  value="em" <?php if ( ! empty ( $edet_stored_meta['tag_unit'] ) ) {selected( $edet_stored_meta['tag_unit'], 'em' );} ?>><?php _e( 'em')?>
					</option>
				</select>
				<span class="edet-options-span"><?php _e('(Change unit as per your need)','eight-degree-easy-tags');?></span>
			</div>

			<div class="edet-options">
				<label for="tagNumber" class="edet-options-label"><?php _e( 'Tag number ', 'eight-degree-easy-tags' ); ?></label>
				<select name="tag_number" class="edet-options-select" id="tagNumber" value="<?php esc_attr($edet_stored_meta['tag_number']); ?>">
					<?php
					for($i=1;$i<25;$i++)							
						{ ?>
					<option value="<?php echo $i;?>"<?php if(!empty($edet_stored_meta['tag_number'])){selected($edet_stored_meta['tag_number'], $i);}?>><?php echo $i;?>								 
					</option>
					<?php
				}
				?>
			</select>
			<span class="edet-options-span"><?php _e('(Numbers of tag to display)','eight-degree-easy-tags');?></span>                   
		</div>

		<div class="edet-options">
			<label for="tagLayout" class="edet-options-label"><?php esc_attr_e( 'Tag Layout', 'eight-degree-easy-tags' ); ?></label>	
			<select name="tag_layout" id="tagLayout" class="edet-options-select">
				<option  value="flat" <?php if ( ! empty ( $edet_stored_meta['tag_layout'] ) ) { selected( $edet_stored_meta['tag_layout'], 'flat' );} ?>><?php _e( 'Flat', 'eight-degree-easy-tags' )?>          	
				</option>
				<option  value="list" <?php if ( ! empty ( $edet_stored_meta['tag_layout'] ) ) {selected( $edet_stored_meta['tag_layout'], 'list' );} ?>><?php _e( 'List', 'eight-degree-easy-tags' )?>          	
				</option>
			</select>
			<span class="edet-options-span"><?php _e('(Tag layouts flat or list)','eight-degree-easy-tags');?></span>                	
		</div>

		<div class="edet-text-input">
			<label for="tagSeparator" class="edet-text-input-label"><?php esc_attr_e( 'Tag Seperator', 'eight-degree-easy-tags' ); ?></label>            		
			<input type="text" class="edet-text-input-input" name="tag_separator" id="tagSeparator" value="<?php if(!empty($edet_stored_meta['tag_separator'])){
				echo esc_attr($edet_stored_meta['tag_separator']);
			}?>" />
			<span class="edet-text-input-span"><?php esc_attr_e( '(Character as tag separator)', 'eight-degree-easy-tags' ); ?></span>                 
		</div>

		<div class="edet-options">
			<label for="tagOrder" class="edet-options-label"><?php esc_attr_e( 'Order Tag: By', 'eight-degree-easy-tags' ); ?></label>		                
			<select name="tag_order_by" id="tagOrder" class="edet-options-select">
				<option  value="name"<?php if(!empty($edet_stored_meta['tag_order_by'])) selected($edet_stored_meta['tag_order_by'],'name');?>><?php _e('Name','eight-degree-easy-tags')?>								
				</option>							
				<option  value="count"<?php if(!empty($edet_stored_meta['tag_order_by'])) selected($edet_stored_meta['tag_order_by'],'count');?>><?php _e('Count','eight-degree-easy-tags')?>								
				</option>
			</select>
			<span class="edet-options-span"><?php _e('(Order your tags according to Name or Count)','eight-degree-easy-tags');?></span>			            
		</div>

		<div class="edet-options">
			<label for="tagSort" class="edet-options"><?php esc_attr_e( 'Sort Tags: By', 'eight-degree-easy-tags' ); ?></label>        		
			<select name="tag_order" id="tagSort" class="edet-options-select">
				<option value="ASC"<?php if(!empty($edet_stored_meta['tag_order'])) selected($edet_stored_meta['tag_order'],'ASC');?>><?php _e('Ascending','eight-degree-easy-tags')?>		
				</option>
				<option value="RAND"<?php if(!empty($edet_stored_meta['tag_order'])) selected($edet_stored_meta['tag_order'],'RAND');?>><?php _e('Random','eight-degree-easy-tags')?>		
				</option>
				<option value="DESC"<?php if(!empty($edet_stored_meta['tag_order'])) selected($edet_stored_meta['tag_order'],'DESC');?>><?php _e('Descending','eight-degree-easy-tags')?>						
				</option>
			</select>
			<span class="edet-options-span"><?php _e('(Sort the tags in an ascending, random or descending order)','eight-degree-easy-tags');?></span> 
		</div>

		<div class="edet-options">
			<label for="tagLink" class="edet-options"><?php esc_attr_e( 'Set Link ', 'eight-degree-easy-tags' ); ?></label>            		
			<select name="tag_link" id="tagLink" class="edet-options-select">
				<option  value="view"<?php if(!empty($edet_stored_meta['tag_link'])) selected($edet_stored_meta['tag_link'],'view');?>><?php _e('View','eight-degree-easy-tags')?>						
				</option>
				<option  value="edit"<?php if(!empty($edet_stored_meta['tag_link'])) selected($edet_stored_meta['tag_link'],'edit');?>><?php _e('Edit','eight-degree-easy-tags')?></option>
			</select>
			<span class="edet-options-span"><?php _e('(Set tag to link or edit tag)','eight-degree-easy-tags');?></span>
		</div>

		<div class="edet-checkbox">
			<label for="tagCount" class="edet-checkbox-label"><?php esc_attr_e( 'Show count', 'eight-degree-easy-tags' ); ?></label>
			<input type="checkbox" class="edet-checkbox-input" id="tagCount" name="tag_filter" <?php if(isset($edet_stored_meta['tag_filter'])) echo 'checked';?>/>
			<span class="edet-options-span"><?php _e('(Check to show count of tag)','eight-degree-easy-tags');?></span>
		</div>	
	</div>

	<!-- Third Menu Block items here -->
	<li><a href="#" class="edettogglelink edet-menu "><h2 class="edet-menu-head">Tags Include/Exclude</h2></a></li>
	<div class="two-col-special-c edet-toggle-field" style="display: none;">
		
		<!--Retrieving all existing taxonomy types along custom registered taxonomy -->
		<div class="edet-list-container">
			<label for="tagTaxonomy" class="edet-list"><?php esc_attr_e( 'Choose Taxonomy ', 'eight-degree-easy-tags' ); ?></label>
			<span class="edet-checkbox-span">
				<?php _e('(Check taxonomy type for displaying in tag cloud)','eight-degree-easy-tags');?></span>
				<?php	
				$edet_taxonomies = get_taxonomies();
				if ( ! empty( $edet_taxonomies ) ) : ?>
				<ul class="two-col-special">
					
					<div class="edet-options">
						<label for="" class="edet-options"><?php esc_attr_e( 'Taxonomy', 'eight-degree-easy-tags' ); ?></label>        		
						<select name="tag_taxonomy[]" id="" class="edet-options-select" >
							<?php
							$i=0;
							foreach ( $edet_taxonomies as $edet_taxonomy ) {
								$i++;
								if($edet_taxonomy=='post_tag'||$edet_taxonomy=='category'):
									?>

								<option value="<?php esc_attr_e($edet_taxonomy);?>" class="edet-list-box-input edet-taxonomy-select" id="tagTaxonomy-<?php esc_attr_e($i);?>"
									<?php if(in_array($edet_taxonomy, $edet_stored_meta['tag_taxonomy'])) {echo 'selected=selected';}?>>		
									<?php 
									switch ($edet_taxonomy) {
										case 'category':
										# code...
										esc_html_e( 'Category' );
										break;
										case 'post_tag':
										# code...
										esc_html_e( 'Posts' );
										break;
										default:
										# code...
										break;
									}
									?>
								</option>
								<?php
								endif;
							}
							?>
						</select>
					</div>
					<span class="edet-options-span"><?php _e('( Taxonomy Selection)','eight-degree-easy-tags');?></span>
				</ul>
				<?php 
				endif;
				?>
			</div>

			<div class="edet-list-container edet-taxonomy-terms edet-terms-post tagTaxonomy-2 edet-taxonomy post_tag">
				<h2 class="edet-list"><?php esc_attr_e( 'Choose terms for taxonomy type:[post_tag] ', 'eight-degree-easy-tags' ); ?></h2>
				<span class="edet-checkbox-span"><?php _e('(Check to exclude or include tag terms of Posts)','eight-degree-easy-tags');?></span>
				<!-- gets all tems of  post_tag taxonomy-->
				<?php
				$edet_terms=array('post_tag');
				$get_terms=get_terms( $edet_terms, 'orderby=count&hide_empty=0');
				if ( ! empty( $get_terms ) && ! is_wp_error( $get_terms ) ){
					?>
					<ul class="two-col-special">
						<?php
						$i=0;
						foreach ( $get_terms as $keys=>$get_term ) {
							$i++;
							$terms_count[]=count($get_terms);
							?>
							<li>
								<label for="edet-post-term-<?php esc_attr_e($i);?>">
									<input type="checkbox" class="" name="tag_do[]" id="edet-post-term-<?php esc_attr_e($i);?>" value="<?php esc_attr_e($get_term->term_id);?>"
									<?php if(in_array($get_term->term_id, $edet_stored_meta['tag_do'])) {echo 'checked=checked';}?>/>
									<span><?php esc_attr_e($get_term->name,'eight-degree-easy-tags');?></span>	
								</label>

							</li>														
							<?php
						}    
						?>
					</ul>
					<?php

				}
				else{
					?>
					<h5><?php echo "Currently this taxonomy is empty!";?></h5>
					<?php
				}
				?>
			</div>
			<!--gets all terms of category type taxonomy -->
			<div class="edet-list-container edet-taxonomy-terms edet-terms-category tagTaxonomy-1 edet-taxonomy category">
				<h2 class="edet-list"><?php esc_attr_e( 'Choose terms for taxonomy type:[category] ', 'eight-degree-easy-tags' ); ?></h2>
				<span class="edet-checkbox-span"><?php _e('(Check to exclude or include Category terms in your tag cloud)','eight-degree-easy-tags');?></span>
				<?php
				$edet_terms=array('category');
				$get_terms=get_terms( $edet_terms, 'orderby=count&hide_empty=0');
				if ( ! empty( $get_terms ) && ! is_wp_error( $get_terms ) ){
					?>
					<ul class="two-col-special">
						<?php
						$i=0;
						foreach ( $get_terms as $keys=>$get_term ) {
							$i++;
							$terms_count[]=count($get_terms);
							?>
							<li>
								<label for="edet-cat-term-<?php esc_attr_e($i);?>">
									<input type="checkbox" class="" name="tag_do[]" id="edet-cat-term-<?php esc_attr_e($i);?>" value="<?php esc_attr_e($get_term->term_id);?>" 
									<?php if(in_array($get_term->term_id, $edet_stored_meta['tag_do'])) {echo 'checked';}?>/>
									<span><?php esc_attr_e($get_term->name,'eight-degree-easy-tags');?></span>	
								</label>

							</li>														
							<?php
						}
						?>
					</ul>
					<?php
				}
				else{
					?>
					<h5><?php echo "Currently this taxonomy is empty!";?></h5>
					<?php
				}
				?>
			</div>

			<div class="edet-radio-wrap">				
				<h1 class="edet-radio-title"><?php esc_attr_e('Exclude/Include','eight-degree-easy-tags');?></h1>
				<input type="radio" name="tag_inc_exc" id="edet-include-all" value="tag_all" <?php echo "checked=checked";?> />
				<label class="edet-radio-option" for="edet-include-all">Include all available</label>
				<input type="radio" name="tag_inc_exc" id="edet-include-only" value="tag_exclude" <?php if(!empty($edet_stored_meta['tag_inc_exc'])=="tag_exclude"){ checked( $edet_stored_meta['tag_inc_exc'], 'tag_exclude' );} ?> />
				<label class="edet-radio-option" for="edet-include-only">Exclude Checked</label>
				<input type="radio" name="tag_inc_exc" id="edet-exclude-only" value="tag_include" <?php if(!empty($edet_stored_meta['tag_inc_exc'])=="tag_include"){ checked( $edet_stored_meta['tag_inc_exc'], 'tag_include' );} ?> /> 
				<label class="edet-radio-option" for="edet-exclude-only">Include Checked</label>
			</div>
		</div>
	</ul>
</div>









































































