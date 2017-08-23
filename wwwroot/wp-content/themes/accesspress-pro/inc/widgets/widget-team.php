<?php
/**
 * Team post/page widget
 *
 * @package Accesspress Pro
 */
/**
 * Adds accesspress_pro_Team widget.
 */
add_action('widgets_init', 'register_team_widget');

function register_team_widget() {
    register_widget('accesspress_pro_team');
}

class Accesspress_Pro_Team extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_pro_team', 'AP : Team Member', array(
            'description' => __('A widget that shows Team Member', 'accesspress-pro')
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
            'team_upload' => array(
                'accesspress_pro_widgets_name' => 'team_upload',
                'accesspress_pro_widgets_title' => __('Team Member Image', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'upload',
            ),
            'team_member_name' => array(
                'accesspress_pro_widgets_name' => 'team_member_name',
                'accesspress_pro_widgets_title' => __('Team Member Name', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'team_member_position' => array(
                'accesspress_pro_widgets_name' => 'team_member_position',
                'accesspress_pro_widgets_title' => __('Team Member Position', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'text',
            ),
            'team_detail' => array(
                'accesspress_pro_widgets_name' => 'team_detail',
                'accesspress_pro_widgets_title' => __('Team Member Detail', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'textarea',
                'accesspress_pro_widgets_row' => '6'
            ),
            'team_social_facebook' => array(
                'accesspress_pro_widgets_name' => 'team_social_facebook',
                'accesspress_pro_widgets_title' => __('Team Member Facebook url', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'url',
            ),
            'team_social_twitter' => array(
                'accesspress_pro_widgets_name' => 'team_social_twitter',
                'accesspress_pro_widgets_title' => __('Team Member Twitter url', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'url',
            ),
            'team_social_linkedin' => array(
                'accesspress_pro_widgets_name' => 'team_social_linkedin',
                'accesspress_pro_widgets_title' => __('Team Member Linkedin url', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'url',
            ),
            'team_social_google_plus' => array(
                'accesspress_pro_widgets_name' => 'team_social_google_plus',
                'accesspress_pro_widgets_title' => __('Team Member Google Plus url', 'accesspress-pro'),
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

        $team_upload = $instance['team_upload'];
        $team_member_name = $instance['team_member_name'];
        $team_member_position = $instance['team_member_position'];
        $team_detail = $instance['team_detail'];
        $team_social_facebook = $instance['team_social_facebook'];
        $team_social_twitter = $instance['team_social_twitter'];
        $team_social_linkedin = $instance['team_social_linkedin'];
        $team_social_google_plus = $instance['team_social_google_plus'];

        echo $before_widget;
        ?>
        <div class="team-block">
            <?php
            if (isset($team_upload)):
                $attachment_id = accesspress_get_attachment_id_from_url($team_upload);
                $image = wp_get_attachment_image_src($attachment_id, 'portfolio-thumbnail');
                ?>
            <div class="team-image square">
            <img src="<?php echo $image[0]; ?>"/>
            </div>
            <?php endif; ?>

            <?php if (isset($team_member_name)): ?>
                <div class="member-name">
                <?php echo $team_member_name; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($team_member_name)): ?>
                <div class="designation">
                    <?php echo $team_member_position; ?>
                </div>
            <?php endif; ?>

            <div class="team-content">
                <?php echo $team_detail; ?>
                <div class="social-shortcode">
                    <?php if (isset($team_social_facebook)): ?>
                    <a href="<?php echo $team_social_facebook; ?>" class="ap-member-facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <?php endif; ?>

                    <?php if (isset($team_detail)): ?>
                        <a href="<?php echo $team_social_twitter; ?>" class="ap-member-twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                    <?php endif; ?>

                    <?php if (isset($team_detail)): ?>
                        <a href="<?php echo $team_social_linkedin; ?>" class="ap-member-linkedin">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    <?php endif; ?>

                    <?php if (isset($team_detail)): ?>
                        <a href="<?php echo $team_social_google_plus; ?>" class="ap-member-google-plus">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    <?php endif; ?>
                </div>
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
