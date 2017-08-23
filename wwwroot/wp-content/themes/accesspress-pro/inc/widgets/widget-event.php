<?php
/**
 * Team post/page widget
 *
 * @package Accesspress Pro
 */
/**
 * Adds accesspress_pro_Team widget.
 */
add_action('widgets_init', 'register_event_widget');

function register_event_widget() {
    register_widget('accesspress_event_widget');
}

class Accesspress_Event_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'accesspress_pro_event_widget', 'AP : Event Listing', array(
            'description' => __('A widget that shows Event Listing', 'accesspress-pro')
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
            ),
            'event_sort_by' => array(
                'accesspress_pro_widgets_name' => 'event_sort_by',
                'accesspress_pro_widgets_title' => __('Sort by Event date?', 'accesspress-pro'),
                'accesspress_pro_widgets_field_type' => 'checkbox',
                'accesspress_pro_widgets_description' => __('Event will sort in the order of the Event date and will vanish after event date completes. <br /> Defaut: Published Date', 'accesspress-pro')
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
        $items = $instance['items'];
        $event_sort_by = $instance['event_sort_by'];


        echo $before_widget;

        echo $before_title. $title. $after_title; 
        ?>
        <div class="latest-events-widget">
    	<?php
        if($event_sort_by == 1){
			$args = array(
		        'post_type' => 'events',
		        'posts_per_page' => $items,
		        'meta_key'   => 'accesspress_pro_event_date',
		        'orderby' => 'meta_value_num',
		        'order' => 'ASC', 
		        'meta_query' => array(
	                array(
	                    'key' => 'accesspress_pro_event_date',
	                    'value' => (time(get_the_date()) - 86400),
	                    'compare' => '>=',
	                ),
		        ),
		    );
		}else{
			$args = array(
		        'post_type' => 'events',
		        'posts_per_page' => $items,
	    	);
		}
    
        $query = new WP_Query($args); 

	    if($query->have_posts()): ?>
	    <?php
	    	while ($query->have_posts()) : $query->the_post();
            global $post;
	    	$accesspress_pro_event_day = get_post_meta( $post->ID, 'accesspress_pro_event_day', true );
			$accesspress_pro_event_month = get_post_meta( $post->ID, 'accesspress_pro_event_month', true );
			$accesspress_pro_event_year = get_post_meta( $post->ID, 'accesspress_pro_event_year', true );
			$accesspress_pro_event_date = get_post_meta( $post->ID, 'accesspress_pro_event_date', true );
	    ?>
	    <div class="event-list clearfix">
            <h4 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	        <figure class="event-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php 
					if( has_post_thumbnail() ){
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'event-thumbnail', false ); 
					?>
					<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
					<?php } else { ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/demo/event-fallback.jpg" alt="<?php the_title(); ?>">
					<?php } ?>
					
					<?php if( $accesspress_pro_hide_event_date != 1 ){	?>	
					<div class="event-date">
						<span class="event-date-day"><?php echo $accesspress_pro_event_day; ?></span>
						<span class="event-date-month"><?php echo $accesspress_pro_event_month; ?></span>
					</div>
					<?php } ?>
				</a>
			</figure>	

			<div class="event-detail">
		        <div class="event-excerpt">
		        	<?php echo accesspress_pro_excerpt( get_the_content() , 100 ) ?>
		        </div>
	        </div>
	        </div>
	        <?php 
	        	endwhile; 
	        ?>
	        <?php wp_reset_postdata(); 

	endif; ?>		
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
