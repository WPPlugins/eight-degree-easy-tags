<?php defined('ABSPATH') or die("No script kiddies please!");
//shortcode option to use at 
?>
				<div  class="">
					<ul>
						<li rel="" class="">
							<h4 class="edet-shortcode-head">Shortcode</h4>
							<p><?php _e('Copy &amp; paste shortcode below directly to your pages and posts','eight-degree-easy-tags');?></p>
							<textarea style="resize: none;" rows="2" cols="32" readonly="readonly">[edet tag_id="<?php echo $post->ID; ?>"]</textarea>
						</li>
						<li rel="">
							<h4 class="edet-shortcode-head">Include Into Template</h4>
							<p><?php _e('Copy &amp; paste code below  to a template file for including eight degree easy tags into your theme.','eight-degree-easy-tags');?></p>
							<textarea style="resize: none;" rows="2" cols="32" readonly="readonly">&lt;?php echo do_shortcode("[edet tag_id='<?php echo $post->ID; ?>']"); ?&gt;</textarea>
						</li>
					</ul>
				</div>	