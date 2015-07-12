<?php 
//theme-options.php
//This is the Theme Options page in the WordPress admin area. It is meant to be included by functions.php
	
//================================================================================================================

//Handle $_POST data after the form was saved

	//Kick the user out if he doesn't have the right permissions
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.','polaroids') );
	}
	else{
		//If POST data was submitted, begin saving the options
			if ( isset($_POST['saved']) ){
			//Echo a confirmation message
				echo('<div class="updated"><p><strong>'. __('Your theme settings were saved.', 'polaroids' ) .'</strong></p></div>');
			
			//Save the theme options
						
				//Loop through the $_POST checkboxes and set the corresponding wordpress options to true if they are checked
				//This method is more compact than using if/else for each method
					$fields = array(
						'polaroids_hide_admin_bar',
						'polaroids_hide_admin_bar_logo',
						'polaroids_hide_posts_menu',
						'polaroids_hide_pages_menu',
						'polaroids_hide_media_menu',
						'polaroids_hide_links_menu',
						'polaroids_hide_comments_menu',
						'polaroids_hide_profile_menu',
						'polaroids_hide_tools_menu',
						'polaroids_hide_comments_disabled',
						'polaroids_use_human_readable_dates',
						'polaroids_use_dynamic_descriptions',
						'polaroids_use_dynamic_suffixes',
						'polaroids_hide_attachment_link',
						'polaroids_hide_attachment_description',
						'polaroids_hide_attachment_caption',
						'polaroids_hide_attachment_library'
						);
					//Loop through the checkboxes and save their value
						foreach($fields as $field) {
							update_option($field, isset($_POST[$field]));
						}

						
				//The dynamic suffixes to use
					if ( isset($_POST['polaroids_dynamic_suffixes'] ))
						update_option('polaroids_dynamic_suffixes',explode("\n", $_POST['polaroids_dynamic_suffixes'])); //Split the suffixes into an array, and store it
			}
	}
?>
<div class="wrap">
	<div id="icon-themes" class="icon32"><br/></div><h2><?php _e('Theme options','polaroids')?></h2>
	<form name="form1" method="post" action="">
		<table class="form-table">
			<tbody>
				<p>
					<?php _e(
						'Use this page to customize this theme. If you want to use WordPress\' default behavior, leave the boxes unchecked.',
						'polaroids'
					)?>
				</p>								

				
				<tr valign="top">
					<td colspan="2">
						<h3><?php _e('Dynamic meta description','polaroids')?></h3>
						<p>
							<?php _e(
								'If enabled, the meta description tag will be the post/page description, the excerpt or the blog description, in that order.',
								'polaroids'
							)?>
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_dynamic_descriptions"><?php _e("Use dynamic meta descriptions", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_dynamic_descriptions" name="polaroids_use_dynamic_descriptions" <?php echo(get_option('polaroids_use_dynamic_descriptions',false)==true?'checked':'')?>/>
					</td>
				</tr>
				
				<tr valign="top">
					<td colspan="2">
						<h3><?php _e('Human-readable dates','polaroids')?></h3>
						<p>
							<?php _e(
								'If enabled, the date will be displayed as 25 days ago.',
								'polaroids'
							)?>
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_human_dates"><?php _e("Use human-readable dates", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_human_dates" name="polaroids_use_human_readable_dates" <?php echo(get_option('polaroids_use_human_readable_dates',false)==true?'checked':'')?>/>
					</td>
				</tr>
				
				<tr valign="top">
					<td colspan="2">
						<h3><?php _e('User menus','polaroids')?></h3>
						<p>
							<?php _e(
								'You can disable Admin area menus for users that don\'t have administrator privileges to ensure your clients a more streamlined experience.',
								'polaroids'
							)?>
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_top_bar"><?php _e("Hide the admin top bar on the site", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_top_bar" name="polaroids_hide_admin_bar" <?php echo(get_option('polaroids_hide_admin_bar',false)==true?'checked':'')?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_top_bar_logo"><?php _e("Remove the logo from the top admin bar", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_top_bar_logo" name="polaroids_hide_admin_bar_logo" <?php echo(get_option('polaroids_hide_admin_bar_logo',false)==true?'checked':'')?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_posts_menu"><?php _e("Hide Posts menu", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_posts_menu" name="polaroids_hide_posts_menu" <?php echo(get_option('polaroids_hide_posts_menu',false)==true?'checked':'')?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_pages_menu"><?php _e("Hide Pages menu", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_pages_menu" name="polaroids_hide_pages_menu" <?php echo(get_option('polaroids_hide_pages_menu',false)==true?'checked':'')?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_comments_menu"><?php _e("Hide Comments menu", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_comments_menu" name="polaroids_hide_comments_menu" <?php echo(get_option('polaroids_hide_comments_menu',false)==true?'checked':'')?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_media_menu"><?php _e("Hide Media menu", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_media_menu" name="polaroids_hide_media_menu" <?php echo(get_option('polaroids_hide_media_menu',false)==true?'checked':'')?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_links_menu"><?php _e("Hide Links menu", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_links_menu" name="polaroids_hide_links_menu" <?php echo(get_option('polaroids_hide_links_menu',false)==true?'checked':'')?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_profile_menu"><?php _e("Hide Profile menu", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_profile_menu" name="polaroids_hide_profile_menu" <?php echo(get_option('polaroids_hide_profile_menu',false)==true?'checked':'')?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_tools_menu"><?php _e("Hide Tools menu", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_tools_menu" name="polaroids_hide_tools_menu" <?php echo(get_option('polaroids_hide_tools_menu',false)==true?'checked':'')?>/>
					</td>
				</tr>
				
				<tr valign="top">
					<td colspan="2">
						<h3><?php _e('File uploads','polaroids')?></h3>
						<p>
							<?php _e(
								'Check these boxes to hide fields and tabs for file attachments. Less clutter means a more streamlined experience for clients. These settings only apply to non-admins.',
								'polaroids'
							)?>
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_attachment_library"><?php _e("Hide the Media Library tab", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_attachment_library" name="polaroids_hide_attachment_library" <?php echo(get_option('polaroids_hide_attachment_library',false)==true?'checked':'')?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_attachment_caption"><?php _e("Hide the caption field", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_attachment_caption" name="polaroids_hide_attachment_caption" <?php echo(get_option('polaroids_hide_attachment_caption',false)==true?'checked':'')?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_attachment_description"><?php _e("Hide the description field", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_attachment_description" name="polaroids_hide_attachment_description" <?php echo(get_option('polaroids_hide_attachment_description',false)==true?'checked':'')?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_attachment_link"><?php _e("Hide the URL field", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_attachment_link" name="polaroids_hide_attachment_link" <?php echo(get_option('polaroids_hide_attachment_link',false)==true?'checked':'')?>/>
					</td>
				</tr>
				
			
				
				<tr valign="top">
					<td colspan="2">
						<h3><?php _e('"Comments disabled" message','polaroids')?></h3>
						<p>
							<?php _e(
								'You can hide the "Comments are disabled for this post" message at the bottom of posts by checking this option.',
								'polaroids'
							)?>
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="chk_hide_comments_disabled"><?php _e("Hide the \"Comments disabled\" message", 'polaroids' )?></label>
					</th>
					<td>
						<input type="checkbox" id="chk_hide_comments_disabled" name="polaroids_hide_comments_disabled" <?php echo(get_option('polaroids_hide_comments_disabled',false)==true?'checked':'')?>/>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="hidden" name="saved" value="true"/>
			<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e("Save Changes")?>" />
		</p>
	</form>
</div>