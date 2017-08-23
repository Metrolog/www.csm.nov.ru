<?php
/**
 * Testimonial post/page widget
 *
 * @package Accesspress Pro
 */
/**
 * Adds accesspress_pro_Testimonial widget.
 */
add_action('widgets_init', 'register_testimonial_widget');

function register_testimonial_widget() {
    register_widget('accesspress_pro_testimonial');
}

class Accesspress_Pro_Testimonial extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_pro_testimonial', 'AP : Testimonial', array(
            'description' => __('A widget that shows Testimonial', 'accesspress-pro')
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
            'testimonial_upload' => array(
                'accesspress_pro_widgets_name' => 'testimonial_upload',
                'accesspress_pro_widgets_title' => __('Client Image', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'upload',
            ),
            'testimonial_image_shape' => array(
                'accesspress_pro_widgets_name' => 'testimonial_image_shape',
                'accesspress_pro_widgets_title' => __('Image Shape', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'select',
                'accesspress_pro_widgets_field_options' => array(
                    'round' => 'Round',
                    'square' => 'Square'
                    )
            ),
            'testimonial_client_name' => array(
                'accesspress_pro_widgets_name' => 'testimonial_client_name',
                'accesspress_pro_widgets_title' => __('Client Name', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'testimonial_client_position' => array(
                'accesspress_pro_widgets_name' => 'testimonial_client_position',
                'accesspress_pro_widgets_title' => __('Client Position', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'testimonial_detail' => array(
                'accesspress_pro_widgets_name' => 'testimonial_detail',
                'accesspress_pro_widgets_title' => __('Testimonial', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'textarea',
                'accesspress_pro_widgets_row' => '6'
            )
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

        $testimonial_client_name = $instance['testimonial_client_name'];
        $testimonial_client_position = $instance['testimonial_client_position'];
        $testimonial_detail = $instance['testimonial_detail'];
        $testimonial_upload = $instance['testimonial_upload'];
        $testimonial_image_shape = $instance['testimonial_image_shape'];

        echo $before_widget;
        ?>

        <div class="testimonial-block">
            <?php
            if (isset($testimonial_upload)):
                $attachment_id = accesspress_get_attachment_id_from_url($testimonial_upload);
                $image = wp_get_attachment_image_src($attachment_id, 'thumbnail');
            ?>
            <div class="testimonial-image <?php echo $testimonial_image_shape; ?>">
                <?php echo '<img src="' . $image[0] . '"/>'; ?>
            </div>
            <?php endif; ?>

            <?php if (isset($testimonial_detail)): ?>
                <div class="testimonial-content"><?php echo $testimonial_detail; ?></div>
            <?php endif; ?>

            <div class="client-detail">
            <?php if (isset($testimonial_client_name)): ?>
                <div class="client-name"><?php echo $testimonial_client_name; ?></div>
            <?php endif; ?>

            <?php if (isset($testimonial_client_position)): ?>
                <div class="client-designation"><?php echo $testimonial_client_position; ?></div>
            <?php endif; ?>

            </div>
        </div>
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
        