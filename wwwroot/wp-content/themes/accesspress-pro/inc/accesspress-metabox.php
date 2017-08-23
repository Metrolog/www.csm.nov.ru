<?php
/**
 * AccessPress Pro Custom Metabox
 *
 * @package Accesspress Pro
 */
add_action('add_meta_boxes', 'accesspress_pro_add_metabox');
function accesspress_pro_add_metabox()
{
    add_meta_box(
                 'accesspress_pro_sidebar_layout', // $id
                 'Sidebar Layout', // $title
                 'accesspress_pro_sidebar_layout_callback', // $callback
                 'post', // $page
                 'normal', // $context
                 'high'); // $priority

    add_meta_box(
                 'accesspress_pro_sidebar_layout', // $id
                 'Sidebar Layout', // $title
                 'accesspress_pro_sidebar_layout_callback', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority

    add_meta_box(
                 'accesspress_pro_sidebar_layout', // $id
                 'Sidebar Layout', // $title
                 'accesspress_pro_sidebar_layout_callback', // $callback
                 'portfolio', // $page
                 'normal', // $context
                 'high'); // $priority

    add_meta_box(
                 'accesspress_pro_sidebar_layout', // $id
                 'Sidebar Layout', // $title
                 'accesspress_pro_sidebar_layout_callback', // $callback
                 'events', // $page
                 'normal', // $context
                 'high'); // $priority


    add_meta_box(
                 'accesspress_pro_page_header_image', // $id
                 'Header Image', // $title
                 'accesspress_pro_page_header_image_callback', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority

    add_meta_box(
                 'accesspress_pro_event_date', // $id
                 'Event Date', // $title
                 'accesspress_pro_event_date_callback', // $callback
                 'events', // $page
                 'side', // $context
                 'high'); // $priority
}


$accesspress_pro_sidebar_layout = array(
        'left-sidebar' => array(
                        'value'     => 'left-sidebar',
                        'thumbnail' => get_template_directory_uri() . '/inc/admin-panel/images/left-sidebar.png'
                    ), 
        'right-sidebar' => array(
                        'value' => 'right-sidebar',
                        'thumbnail' => get_template_directory_uri() . '/inc/admin-panel/images/right-sidebar.png'
                    ),
        'both-sidebar' => array(
                        'value'     => 'both-sidebar',
                        'thumbnail' => get_template_directory_uri() . '/inc/admin-panel/images/both-sidebar.png'
                    ),
       
        'no-sidebar' => array(
                        'value'     => 'no-sidebar',
                        'thumbnail' => get_template_directory_uri() . '/inc/admin-panel/images/no-sidebar.png'
                    )   

    );

function accesspress_pro_sidebar_layout_callback()
{ 
global $post , $accesspress_pro_sidebar_layout;
wp_nonce_field( basename( __FILE__ ), 'accesspress_pro_sidebar_layout_nonce' ); 
?>

<table class="form-table page-meta-box">
<tr>
<td colspan="4"><em class="f13"><?php _e('Choose Sidebar Template','accesspress-pro'); ?></em></td>
</tr>

<tr>
<td>
<?php  
   foreach ($accesspress_pro_sidebar_layout as $field) {  
                $accesspress_pro_sidebar_metalayout = get_post_meta( $post->ID, 'accesspress_pro_sidebar_layout', true ); ?>

                <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                <input id="<?php echo $field['value']; ?>" type="radio" name="accesspress_pro_sidebar_layout" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $accesspress_pro_sidebar_metalayout ); if(empty($accesspress_pro_sidebar_metalayout) && $field['value']=='right-sidebar'){ echo "checked='checked'";} ?>/>
                <label class="description" for="<?php echo $field['value']; ?>">
                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" />
                </label>
                </div>
                <?php } // end foreach 
                ?>
                <div class="clear"></div>
</td>
</tr>
<tr>
    <td><em class="f13"><?php _e('You can set up the sidebar content','accesspress-pro'); ?> <a href="<?php echo admin_url('/themes.php?page=theme_options'); ?>"><?php _e('here','accesspress-pro'); ?></a></em></td>
</tr>
</table>

<?php } 

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function accesspress_pro_save_sidebar_layout( $post_id ) { 
    global $accesspress_pro_sidebar_layout, $post; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'accesspress_pro_sidebar_layout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'accesspress_pro_sidebar_layout_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  
    

    foreach ($accesspress_pro_sidebar_layout as $field) {  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'accesspress_pro_sidebar_layout', true); 
        $new = sanitize_text_field($_POST['accesspress_pro_sidebar_layout']);
        if ($new && $new != $old) {  
            update_post_meta($post_id, 'accesspress_pro_sidebar_layout', $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id,'accesspress_pro_sidebar_layout', $old);  
        } 
     } // end foreach   
     
}
add_action('save_post', 'accesspress_pro_save_sidebar_layout'); 


function accesspress_pro_page_header_image_callback(){
    global $post ;
    wp_nonce_field( basename( __FILE__ ), 'accesspress_pro_page_header_image_nonce' ); 
    ?>

    <table class="form-table page-meta-box">
    <tr>
    <td colspan="4"><em class="f13"><?php _e('Upload the Header Image','accesspress-pro'); ?></em></td>
    </tr>

    <tr>
    <td>
        <div class="header-image-wrap">
        <?php $header_img_url = esc_attr( get_post_meta( $post->ID, 'accesspress_pro_page_header_image', true ) ); ?>
        <input id="hidden-input" type="hidden" name="accesspress_pro_page_header_image" value="<?php echo $header_img_url; ?>">
        <?php if(!empty($header_img_url)) {  ?>
            <img id="accesspress_pro_header_image" src="<?php echo $header_img_url; ?>">
            <a id="remove_header_image" title="remove" href="javascript:void(0)"><?php _e('Remove','accesspress-pro'); ?></a>
        <?php }else{ ?> 
            <img id="accesspress_pro_header_image" src="<?php echo $header_img_url; ?>" style="display:none">
            <a id="remove_header_image" title="remove" href="javascript:void(0)" style="display:none"><?php _e('Remove','accesspress-pro'); ?></a>
        <?php } ?> 
        </div>
    </td>
    </tr>
    <tr>
    <td><a href="javascript:void(0)" id="upload-header-image"><?php _e('Upload header Image','accesspress-pro'); ?></a></td>
    </tr>
    </table>

<?php 
}

function accesspress_pro_save_page_header_image( $post_id ) { 
    global $post; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'accesspress_pro_page_header_image_nonce' ] ) || !wp_verify_nonce( $_POST[ 'accesspress_pro_page_header_image_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
    
     if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  

        //Execute this saving function
        $old = get_post_meta( $post_id, 'accesspress_pro_page_header_image', true); 
        $new = esc_url_raw($_POST['accesspress_pro_page_header_image']);
        if ( $new && '' == $new ){
            add_post_meta( $post_id, 'accesspress_pro_page_header_image', $new );
        }elseif ($new && $new != $old) {  
            update_post_meta($post_id, 'accesspress_pro_page_header_image', $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id,'accesspress_pro_page_header_image', $old);  
        } 
}
add_action('save_post', 'accesspress_pro_save_page_header_image'); 


function accesspress_pro_event_date_callback()
{ 
global $post ;
wp_nonce_field( basename( __FILE__ ), 'accesspress_pro_event_date_nonce' ); 
?>

<table>
<tr>
<td colspan="4"><em class="f13"><?php _e('Enter the Event Date','accesspress-pro'); ?></em></td>
</tr>

<tr>
<td>
<?php  
$accesspress_pro_event_day = get_post_meta( $post->ID, 'accesspress_pro_event_day', true );
$accesspress_pro_event_month = get_post_meta( $post->ID, 'accesspress_pro_event_month', true );
$accesspress_pro_event_year = get_post_meta( $post->ID, 'accesspress_pro_event_year', true );
$accesspress_pro_event_date = get_post_meta( $post->ID, 'accesspress_pro_event_date', true );
$accesspress_pro_event_day = empty($accesspress_pro_event_day) ? date('j'):get_post_meta( $post->ID, 'accesspress_pro_event_day', true );
$accesspress_pro_event_month = empty($accesspress_pro_event_month) ? date('M'):get_post_meta( $post->ID, 'accesspress_pro_event_month', true );
$accesspress_pro_event_year = empty($accesspress_pro_event_year) ? date('Y'):get_post_meta( $post->ID, 'accesspress_pro_event_year', true );
?>
    <select name="accesspress_pro_event_day">
    <?php for($event_day=1; $event_day <= 31; $event_day++){?>
    <option value="<?php echo $event_day ?>"  <?php selected( $accesspress_pro_event_day, $event_day); ?>><?php echo $event_day ?></option>
    <?php } ?>
    </select>

    <select name="accesspress_pro_event_month">
        <option value="Jan" <?php selected( $accesspress_pro_event_month, 'Jan'); ?>><?php _e('Jan','accesspress-pro'); ?></option>
        <option value="Feb" <?php selected( $accesspress_pro_event_month, 'Feb'); ?>><?php _e('Feb','accesspress-pro'); ?></option>
        <option value="Mar" <?php selected( $accesspress_pro_event_month, 'Mar'); ?>><?php _e('Mar','accesspress-pro'); ?></option>
        <option value="Apr" <?php selected( $accesspress_pro_event_month, 'Apr'); ?>><?php _e('Apr','accesspress-pro'); ?></option>
        <option value="May" <?php selected( $accesspress_pro_event_month, 'May'); ?>><?php _e('May','accesspress-pro'); ?></option>
        <option value="Jun" <?php selected( $accesspress_pro_event_month, 'Jun'); ?>><?php _e('Jun','accesspress-pro'); ?></option>
        <option value="Jul" <?php selected( $accesspress_pro_event_month, 'Jul'); ?>><?php _e('Jul','accesspress-pro'); ?></option>
        <option value="Aug" <?php selected( $accesspress_pro_event_month, 'Aug'); ?>><?php _e('Aug','accesspress-pro'); ?></option>
        <option value="Sep" <?php selected( $accesspress_pro_event_month, 'Sep'); ?>><?php _e('Sep','accesspress-pro'); ?></option>
        <option value="Oct" <?php selected( $accesspress_pro_event_month, 'Oct'); ?>><?php _e('Oct','accesspress-pro'); ?></option>
        <option value="Nov" <?php selected( $accesspress_pro_event_month, 'Nov'); ?>><?php _e('Nov','accesspress-pro'); ?></option>
        <option value="Dec" <?php selected( $accesspress_pro_event_month, 'Dec'); ?>><?php _e('Dec','accesspress-pro'); ?></option>
    </select>

    <select name="accesspress_pro_event_year">
    <?php for($event_year = 2010; $event_year <= 2030; $event_year++){?>
    <option value="<?php echo $event_year ?>"  <?php selected( $accesspress_pro_event_year, $event_year); ?>><?php echo $event_year ?></option>
    <?php } ?>
    </select> 

    <input name="accesspress_pro_event_date" type="hidden" value="<?php echo $accesspress_pro_event_date; ?>"> 
</td>
</tr>
</table>

<?php } 

function accesspress_pro_save_event_date( $post_id ) { 
    global $post; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'accesspress_pro_event_date_nonce' ] ) || !wp_verify_nonce( $_POST[ 'accesspress_pro_event_date_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
    
     if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  

        //Execute this saving function
        $old_day = get_post_meta( $post_id, 'accesspress_pro_event_day', true);
        $old_month = get_post_meta( $post_id, 'accesspress_pro_event_month', true);  
        $old_year = get_post_meta( $post_id, 'accesspress_pro_event_year', true); 
        $old_date = strtotime(($old_month.' '.$old_day.','.$old_year));        
        $new_day = sanitize_text_field($_POST['accesspress_pro_event_day']);
        $new_month = sanitize_text_field($_POST['accesspress_pro_event_month']);
        $new_year = sanitize_text_field($_POST['accesspress_pro_event_year']);
        $new_date = strtotime(($new_month.' '.$new_day.','.$new_year));
        
        if ( $new_day && '' == $new_day ){
            add_post_meta( $post_id, 'accesspress_pro_event_day', $new_day );
        }elseif ($new_day && $new_day != $old_day) {  
            update_post_meta($post_id, 'accesspress_pro_event_day', $new_day);  
        } elseif ('' == $new_day && $old_day) {  
            delete_post_meta($post_id,'accesspress_pro_event_day', $old_day);  
        } 

        if ( $new_month && '' == $new_month ){
            add_post_meta( $post_id, 'accesspress_pro_event_month', $new_month );
        }elseif ($new_month && $new_month != $old_month) {  
            update_post_meta($post_id, 'accesspress_pro_event_month', $new_month);  
        } elseif ('' == $new_month && $old_month) {  
            delete_post_meta($post_id,'accesspress_pro_event_month', $old_month);  
        } 

        if ( $new_year && '' == $new_year ){
            add_post_meta( $post_id, 'accesspress_pro_event_year', $new_year );
        }elseif ($new_year && $new_year != $old_year) {  
            update_post_meta($post_id, 'accesspress_pro_event_year', $new_year);  
        } elseif ('' == $new_year && $old_year) {  
            delete_post_meta($post_id,'accesspress_pro_event_year', $old_year);  
        } 

        //if ( $new_date && '' == $new_date ){
        //    add_post_meta( $post_id, 'accesspress_pro_event_date', $new_date );
       // }elseif ($new_date && $new_date != $old_date) {  
            update_post_meta($post_id, 'accesspress_pro_event_date', $new_date);  
       // } elseif ('' == $new_date && $old_date) {  
        //    delete_post_meta($post_id,'accesspress_pro_event_date', $old_date);  
       // } 
}
add_action('save_post', 'accesspress_pro_save_event_date'); 