<?php
/**
 * Team post/page widget
 *
 * @package Accesspress Pro
 */
/**
 * Adds accesspress_pro_Team widget.
 */
add_action('widgets_init', 'register_slider_widget');

function register_slider_widget() {
    register_widget('accesspress_pro_slider');
}

class Accesspress_Pro_Slider extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_pro_slider', 'AP : Slider', array(
            'description' => __('A widget that shows Slider', 'accesspress-pro')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            // This widget has no title
            // Other fields
            'slider_image1' => array(
                'accesspress_pro_widgets_name' => 'slider_image1',
                'accesspress_pro_widgets_title' => __('Slider Image 1', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'upload',
            ),
            'slider_image1_caption_title' => array(
                'accesspress_pro_widgets_name' => 'slider_image1_caption_title',
                'accesspress_pro_widgets_title' => __('Caption Title', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'slider_image1_caption_content' => array(
                'accesspress_pro_widgets_name' => 'slider_image1_caption_content',
                'accesspress_pro_widgets_title' => __('Caption Content', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'textarea',
                'accesspress_pro_widgets_row' => '6',
            ),
            'slider_image1_caption_content' => array(
                'accesspress_pro_widgets_name' => 'add',
                'accesspress_pro_widgets_field_type' => 'add',
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        $slider_image1 = $instance['slider_image1'];


        echo $before_widget;

        if (isset($slider_image1)):
            $attachment_id = accesspress_get_attachment_id_from_url($team_upload);
            $image = wp_get_attachment_image_src($attachment_id, 'team-thumbnail');
            ?>
            <div class="ap-member-image">
                <?php echo '<img src="' . $image[0] . '"/>'; ?>
            </div>
        <?php endif; ?>

        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	accesspress_pro_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$accesspress_pro_widgets_name] = accesspress_pro_widgets_updated_field_value($widget_field, $new_instance[$accesspress_pro_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	accesspress_pro_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $accesspress_pro_widgets_field_value = isset($instance[$accesspress_pro_widgets_name]) ? esc_attr($instance[$accesspress_pro_widgets_name]) : '';
            accesspress_pro_widgets_show_widget_field($this, $widget_field, $accesspress_pro_widgets_field_value);
        }
    }

}
