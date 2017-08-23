<?php
/**
 * Testimonial post/page widget
 *
 * @package Accesspress Pro
 */
/**
 * Adds accesspress_pro_Testimonial widget.
 */
add_action('widgets_init', 'register_pricing_widget');

function register_pricing_widget() {
    register_widget('accesspress_pro_pricing');
}

class Accesspress_Pro_Pricing extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_pro_pricing', 'AP : Pricing Table', array(
            'description' => __('A widget that shows Pricing Table', 'accesspress_pro')
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
            'pricing_plan' => array(
                'accesspress_pro_widgets_name' => 'pricing_plan',
                'accesspress_pro_widgets_title' => __('Plan Name', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_plan_sub_text' => array(
                'accesspress_pro_widgets_name' => 'pricing_plan_sub_text',
                'accesspress_pro_widgets_title' => __('Sub Text', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_price' => array(
                'accesspress_pro_widgets_name' => 'pricing_price',
                'accesspress_pro_widgets_title' => __('Price', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_price_per' => array(
                'accesspress_pro_widgets_name' => 'pricing_price_per',
                'accesspress_pro_widgets_title' => __('Price Per', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_feature1' => array(
                'accesspress_pro_widgets_name' => 'pricing_feature1',
                'accesspress_pro_widgets_title' => __('Feature 1', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_feature2' => array(
                'accesspress_pro_widgets_name' => 'pricing_feature2',
                'accesspress_pro_widgets_title' => __('Feature 2', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_feature3' => array(
                'accesspress_pro_widgets_name' => 'pricing_feature3',
                'accesspress_pro_widgets_title' => __('Feature 3', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_feature4' => array(
                'accesspress_pro_widgets_name' => 'pricing_feature4',
                'accesspress_pro_widgets_title' => __('Feature 4', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_feature5' => array(
                'accesspress_pro_widgets_name' => 'pricing_feature5',
                'accesspress_pro_widgets_title' => __('Feature 5', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_feature6' => array(
                'accesspress_pro_widgets_name' => 'pricing_feature6',
                'accesspress_pro_widgets_title' => __('Feature 6', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_feature7' => array(
                'accesspress_pro_widgets_name' => 'pricing_feature7',
                'accesspress_pro_widgets_title' => __('Feature7', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_feature8' => array(
                'accesspress_pro_widgets_name' => 'pricing_feature8',
                'accesspress_pro_widgets_title' => __('Feature 8', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_button_text' => array(
                'accesspress_pro_widgets_name' => 'pricing_button_text',
                'accesspress_pro_widgets_title' => __('Button Text', 'accesspress-pro'),
                'accesspress_pro_widgets_desc' => __('Leave Empty not to show', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'pricing_button_link' => array(
                'accesspress_pro_widgets_name' => 'pricing_button_link',
                'accesspress_pro_widgets_title' => __('Button Link', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'url',
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

        $pricing_plan = $instance['pricing_plan'];
        $pricing_plan_sub_text = $instance['pricing_plan_sub_text'];
        $pricing_price = $instance['pricing_price'];
        $pricing_price_per = $instance['pricing_price_per'];
        $pricing_feature1 = $instance['pricing_feature1'];
        $pricing_feature2 = $instance['pricing_feature2'];
        $pricing_feature3 = $instance['pricing_feature3'];
        $pricing_feature4 = $instance['pricing_feature4'];
        $pricing_feature5 = $instance['pricing_feature5'];
        $pricing_feature6 = $instance['pricing_feature6'];
        $pricing_feature7 = $instance['pricing_feature7'];
        $pricing_feature8 = $instance['pricing_feature8'];
        $pricing_button_text = $instance['pricing_button_text'];
        $pricing_button_link = $instance['pricing_button_link'];

        echo $before_widget;
        ?>
        <div class="ap-pricing-table">
            <div class="ap-pricing-head">
                <?php if (!empty($pricing_plan)): ?>
                    <h2 class="ap-pricing-plan">
                        <?php echo $pricing_plan; ?>
                    </h2>
                <?php endif; ?>
            <div class="ap-price-box">
                <?php if (!empty($pricing_price)): ?>
                    <div class="ap-price">
                        <?php echo $pricing_price; ?>
                        <span class="ap-per"><?php echo $pricing_price_per; ?></span>
                    </div>
                    
                <?php endif; ?>
            </div>
            <?php if (!empty($pricing_plan_sub_text)): ?>
                <div class="ap-pricing-plan-sub-text"><?php echo $pricing_plan_sub_text; ?></div>
            <?php endif; ?>
            </div>

            <div class="ap-pricing-features">
                <ul class="ap-pricing-features-inner">
                    <?php if (!empty($pricing_feature1)): ?>
                        <li><?php echo $pricing_feature1; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature2)): ?>
                        <li><?php echo $pricing_feature2; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature3)): ?>
                        <li><?php echo $pricing_feature3; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature4)): ?>
                        <li><?php echo $pricing_feature4; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature5)): ?>
                        <li><?php echo $pricing_feature5; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature6)): ?>
                        <li><?php echo $pricing_feature6; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature7)): ?>
                        <li><?php echo $pricing_feature7; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature8)): ?>
                        <li><?php echo $pricing_feature8; ?></li>
                    <?php endif; ?>
                </ul>
            </div>

            <?php if (!empty($pricing_button_text)): ?>
                <div class="ap-pricing-readmore"><a class="bttn" href="<?php echo $pricing_button_link; ?>"><?php echo $pricing_button_text; ?></a></div>
            <?php endif; ?>
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
        