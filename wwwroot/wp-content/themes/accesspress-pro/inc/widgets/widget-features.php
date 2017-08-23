<?php
/**
 * Testimonial post/page widget
 *
 * @package Accesspress Pro
 */
/**
 * Adds accesspress_pro_Testimonial widget.
 */
add_action('widgets_init', 'register_feature_widget');

function register_feature_widget() {
    register_widget('accesspress_feature');
}

class Accesspress_Feature extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'accesspress_feature', 'AP : Featured', array(
            'description' => __('A widget that shows features with Image', 'accesspress-pro')
            )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'title' => array(
                'accesspress_pro_widgets_name' => 'title',
                'accesspress_pro_widgets_title' => __('Title', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'list-style' => array(
                'accesspress_pro_widgets_name' => 'list-style',
                'accesspress_pro_widgets_title' => __('List Style', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'select',
                'accesspress_pro_widgets_field_options' => array(
                    'ap-list1' => 'Thunder Icon',
                    'ap-list2' => 'Pin Icon',
                    'ap-list3' => 'Tick Icon',
                    'ap-list4' => 'Star Icon',
                    'ap-list5' => 'Money Bag Icon',
                    'ap-list6' => 'Square Icon',
                )
            ),
            'lists' => array(
                'accesspress_pro_widgets_name' => 'lists',
                'accesspress_pro_widgets_title' => __('Features', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'textarea',
                'accesspress_pro_widgets_row' => '10',
                'accesspress_pro_widgets_description' => 'Enter the features in list form<br /> &lt;li&gtFeatures 1&lt;/li&gt<br />&lt;li&gtFeatures 2&lt;/li&gt<br /><br />'
            ),
            'image' => array(
                'accesspress_pro_widgets_name' => 'image',
                'accesspress_pro_widgets_title' => __('Upload Image', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'upload',
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

        $title = $instance['title'];
        $image = $instance['image'];
        $lists = $instance['lists'];
        $list_style = $instance['list-style'];

        echo $before_widget;
        ?>
        <div class="clearfix ap-row">
        <div class="ap_column ap-span3">
            <?php
            if (!empty($image)):
                $attachment_id = accesspress_get_attachment_id_from_url($image);
                $image_array = wp_get_attachment_image_src($attachment_id, 'full');
                ?>
                <img src = "<?php echo $image_array[0]; ?>" />
        <?php endif; ?>
        </div>
        <div class="ap_column ap-span3">
            <?php if (!empty($title)): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <ul class="ap-list <?php echo $list_style; ?>">
                <?php echo $lists; ?>
            </ul>
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
            $accesspress_pro_widgets_field_value = !empty($instance[$accesspress_pro_widgets_name]) ? esc_attr($instance[$accesspress_pro_widgets_name]) : '';
            accesspress_pro_widgets_show_widget_field($this, $widget_field, $accesspress_pro_widgets_field_value);
        }
    }

}
