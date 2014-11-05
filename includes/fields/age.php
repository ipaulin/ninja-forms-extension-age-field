<?php

/**
 * Register new Ninja Forms field
 */
function ninja_forms_register_field_age()
{
	$args = array(
		'name'               =>  __( 'Age', 'ninja-forms' ),
		'sidebar'            =>  'template_fields',
		'edit_function'      =>  'ninja_forms_field_age_edit',
		'display_function'   =>  'ninja_forms_field_age_display',
		'save_function'      =>  '',
		'group'              =>  'standard_fields',
		'edit_label'         =>  true,
		'edit_label_pos'     =>  true,
		'edit_req'           =>  true,
		'edit_custom_class'  =>  true,
		'edit_help'          =>  true,
		'edit_desc'          =>  true,
		'edit_meta'          =>  false,
		'edit_conditional'   =>  true,
		'conditional'        =>  array(
			                        'value' => array(
				                       'type' => 'text',
			                        ),
		                         ),
		'pre_process'        =>  'ninja_forms_field_age_pre_process',
	);

	ninja_forms_register_field( '_age', $args );
}

add_action( 'init', 'ninja_forms_register_field_age' );


/**
 * Edit field in admin
 */
function ninja_forms_field_age_edit( $field_id, $data )
{
	$plugin_settings = nf_get_settings();
	
	$date_format = "m/d/Y";
	
	$custom = '';
	
	// Default Value
	if( isset( $data['default_value'] ) ) {
		$default_value = $data['default_value'];
	} else {
		$default_value = '';
	}
	if( $default_value == 'none' ) {
		$default_value = '';
	}

	?>
	<div class="description description-thin">
		<span class="field-option">
		<label for="">
			<?php _e( 'Default Value' , 'ninja-forms'); ?>
		</label><br />
			<select id="default_value_<?php echo $field_id;?>" name="" class="widefat ninja-forms-_text-default-value">
				<option value="" <?php if( $default_value == '') { echo 'selected'; $custom = 'no'; } ?>><?php _e( 'None', 'ninja-forms' ); ?></option>
				<option value="_custom" <?php if($custom != 'no') { echo 'selected'; } ?>><?php _e( 'Custom', 'ninja-forms' ); ?> -></option>
			</select>
		</span>
	</div>
	<div class="description description-thin">

		<label for="" id="default_value_label_<?php echo $field_id;?>" style="<?php if( $custom == 'no' ) { echo 'display:none;'; } ?>">
			<span class="field-option">
			<?php _e( 'Default Value' , 'ninja-forms' ); ?><br />
			<input type="text" class="widefat code" name="ninja_forms_field_<?php echo $field_id; ?>[default_value]" id="ninja_forms_field_<?php echo $field_id; ?>_default_value" value="<?php echo $default_value; ?>" />
			</span>
		</label>

	</div>

	<?php
}


/**
 * Display field on front-end
 */
function ninja_forms_field_age_display( $field_id, $data )
{
	global $current_user;
	$field_class = ninja_forms_get_field_class( $field_id );

	if( isset( $data['default_value'] ) ) {
		$default_value = $data['default_value'];
	} else {
		$default_value = '';
	}

	if( isset( $data['label_pos'] ) ) {
		$label_pos = $data['label_pos'];
	} else {
		$label_pos = "left";
	}

	if( isset( $data['label'] ) ) {
		$label = $data['label'];
	} else {
		$label = '';
	}

	if( isset( $data['mask'] ) ) {
		$mask = $data['mask'];
	} else {
		$mask = '';
	}	

	$mask_class = 'ninja-forms-datepicker';
	
	?>
	<input id="ninja_forms_field_<?php echo $field_id; ?>" data-mask="<?php echo $mask; ?>"   name="ninja_forms_field_<?php echo $field_id; ?>" type="text" class="<?php echo $field_class; ?> <?php echo $mask_class; ?>" value="<?php echo $default_value; ?>" rel="<?php echo $field_id; ?>" />
	<?php

}


/**
 * Pre process field value
 *
 * @param int $field_id  Field ID
 * @param string $user_value  Field value
 */
function ninja_forms_field_age_pre_process( $field_id, $user_value )
{
	global $ninja_forms_processing;
		
	$user_value = explode( "/", $user_value );

	$age  = ( date( "md", date( "U", mktime( 0, 0, 0, $user_value[0], $user_value[1], $user_value[2] ) ) ) > date( "md" ) ? ( ( date( "Y" ) - $user_value[2] ) - 1 ) : ( date( "Y" ) - $user_value[2] ) );
		
	$ninja_forms_processing->update_field_value( $field_id, $age );

}