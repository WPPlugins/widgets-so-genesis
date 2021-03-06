<?php
/**
 * Closemarketing
 *
 * @package WordPress
 * @subpackage Closemarketing
 * @author Closemarketing <info@closemarketing.es>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

class WSG_Button extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_cta', 'description' => __('Add a Button Genesis', 'widgets-so-genesis'));
        $control_ops = array('width' => 400, 'height' => 350);
        parent::__construct('ctatext', __('Button to Action','widgets-so-genesis'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $buttontext = apply_filters( 'widget_buttontext', empty( $instance['buttontext'] ) ? '' : $instance['buttontext'], $instance );
        $buttonstyle = apply_filters( 'widget_buttonstyle', empty( $instance['buttonstyle'] ) ? '' : $instance['buttonstyle'], $instance );
        $buttonurl = apply_filters( 'widget_buttonurl', empty( $instance['buttonurl'] ) ? '' : $instance['buttonurl'], $instance );
        echo $before_widget; ?>

            <div class="ctabutton">
                <a class="button<?php
                    if ( !empty( $buttonstyle ) ) { echo " ".$buttonstyle;  }
            ?>" href="<?php echo $buttonurl; ?>"><?php echo $buttontext; ?></a>
            </div>
        <?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['buttontext'] =  $new_instance['buttontext'];
        $instance['buttonurl'] =  $new_instance['buttonurl'];
        $instance['buttonstyle'] =  $new_instance['buttonstyle'];

        $instance['filter'] = isset($new_instance['filter']);
        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance,
                        array( 'buttontext' => '', 'buttonurl' => '', 'buttonstyle' => '' ) );
        $buttontext = esc_textarea($instance['buttontext']);
        $buttonurl = esc_textarea($instance['buttonurl']);
        $buttonstyle = esc_textarea($instance['buttonstyle']);
?>
        <p>
            <label for="<?php echo $this->get_field_id('buttontext'); ?>"><?php _e('Button Text','widgets-so-genesis'); ?>:</label>               <input class="widefat" id="<?php echo $this->get_field_id('buttontext'); ?>" name="<?php echo $this->get_field_name('buttontext'); ?>" type="text" value="<?php echo esc_attr($buttontext); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('buttonurl'); ?>"><?php _e('Button URL','widgets-so-genesis'); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('buttonurl'); ?>" name="<?php echo $this->get_field_name('buttonurl'); ?>" type="text" value="<?php echo esc_attr($buttonurl); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('buttonstyle'); ?>"><?php _e('Button Custom class','widgets-so-genesis'); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('buttonstyle'); ?>" name="<?php echo $this->get_field_name('buttonstyle'); ?>" type="text" value="<?php echo esc_attr($buttonstyle); ?>" />
        </p>

        <?php
        }
        }


/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */

add_action( 'widgets_init', create_function( '', 'register_widget( "WSG_Button" );' ) );
