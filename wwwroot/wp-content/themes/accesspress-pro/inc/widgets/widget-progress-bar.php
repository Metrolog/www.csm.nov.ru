<?php
/**
 * Testimonial post/page widget
 *
 * @package Accesspress Pro
 */
/**
 * Adds accesspress_pro_Testimonial widget.
 */
add_action('widgets_init', 'register_progress_bar_widget');

function register_progress_bar_widget() {
    register_widget('accesspress_pro_progress_bar');
}

class Accesspress_Pro_Progress_Bar extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_pro_progress_bar', 'AP : Progress Bar', array(
            'description' => __('A widget that shows Progress bar', 'accesspress-pro')
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
            'progress_bar_percentage' => array(
                'accesspress_pro_widgets_name' => 'progress_bar_percentage',
                'accesspress_pro_widgets_title' => __('Progress Bar Percentage', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'number',
            ),
            'progress_bar_title' => array(
                'accesspress_pro_widgets_name' => 'progress_bar_title',
                'accesspress_pro_widgets_title' => __('Progress Bar Title', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
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

        $progress_bar_percentage = $instance['progress_bar_percentage'];
        $progress_bar_title = $instance['progress_bar_title'];

        echo $before_widget;
        ?>

        <div class="ap-progress-bar-wrap">
        <?php echo $progress_bar_title; ?> 
        <?php if (isset($progress_bar_percentage)): ?>
            <span><i> - <?php echo $progress_bar_percentage; ?>%</i></span>
        <?php endif; ?>
        <div class="ap-progress-bar">

            <?php if (isset($progress_bar_percentage)): ?>
                <span class="ap-progress-bar-percentage" data-width="<?php echo $progress_bar_percentage; ?>"></span>
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
    