<?php
/**
 * Team post/page widget
 *
 * @package Accesspress Pro
 */
/**
 * Adds accesspress_pro_Team widget.
 */
add_action('widgets_init', 'register_testimonail_slider_widget');

function register_testimonail_slider_widget() {
    register_widget('accesspress_testimonial_slider');
}

class Accesspress_Testimonial_Slider extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'accesspress_pro_testimonial_slider', 'AP : Testimonial Slider', array(
            'description' => __('A widget that shows Testimonial Slider', 'accesspress-pro')
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
            'items' => array(
                'accesspress_pro_widgets_name' => 'items',
                'accesspress_pro_widgets_title' => __('No of Post', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'select',
                'accesspress_pro_widgets_field_options' => array(
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                )
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

        $title = $instance['title'];
        $items = $instance['items'];


        echo $before_widget;

        echo $before_title. $title. $after_title;

        $args = array(
            'post_type' => 'testimonial', 
            'posts_per_page' => $items
        );

        $query = new WP_Query($args);

        if($query->have_posts()):?>
        <div class="testimonial-wrap">
                <div class="testimonial-slider">
            <?php
            while ($query->have_posts()):
                $query->the_post();
                ?>
                <div class="testimonial-slide">
                    <div class="testimonial-list clearfix">
                        <div class="testimonial-thumbnail">
                        <?php 
                        if(has_post_thumbnail()){
                        the_post_thumbnail('thumbnail'); 
                        }else{ ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/testimonial-dummy.jpg" alt="no-image"/>
                        <?php }?>
                        </div>

                        <div class="testimonial-excerpt">
                            <?php echo accesspress_pro_excerpt( get_the_content() , 140 ) ?>
                        </div>
                    </div>
                <div class="testimoinal-client-name"><?php the_title(); ?></div>
                </div>
                <?php
            endwhile; ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php 
        endif;
        wp_reset_postdata();
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
