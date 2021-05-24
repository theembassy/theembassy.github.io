<?php
/**
 * Seven Sages Customizer Controls
 *
 * @package Seven_Sages
 */

// No direct access, please.
if (! defined('ABSPATH') ) {
    exit;
}

/**
 * Slider Control
 */
if (class_exists('WP_Customize_Control') && ! class_exists('Seven_Sages_Customize_Width_Slider_Control') ) :

    /**
     * Customizer Slider Control
     */
    class Seven_Sages_Customize_Width_Slider_Control extends WP_Customize_Control
    {


        /**
         * Type
         *
         * @var string
         */
        public $type = 'seven-sages-range-slider';

        /**
         * ID
         *
         * @var string
         */
        public $id = '';

        /**
         * Default
         *
         * @var string
         */
        public $default = '';

        /**
         * Unit
         *
         * @var string
         */
        public $unit = '';

        /**
         * Min
         *
         * @var integer
         */
        public $min     = 0;

        /**
         * Max
         *
         * @var integer
         */
        public $max = 9999;

        /**
         * Step
         *
         * @var integer
         */
        public $step = 1;

        /**
         * Tooltip
         *
         * @var string
         */
        public $tooltip = '';

        /**
         * Convert options in JSON
         */
        public function to_json() 
        {

            parent::to_json();
            $this->json['id']          = $this->id;
            $this->json['min']         = $this->min;
            $this->json['max']         = $this->max;
            $this->json['step']        = $this->step;
            $this->json['unit']        = $this->unit;
            $this->json['link']        = $this->get_link();
            $this->json['value']       = $this->value();
            $this->json['default']     = $this->default;
            $this->json['tooltip']     = $this->tooltip;
            $this->json['reset_title'] = esc_attr_x('Reset', 'Reset the slider customizer control value.', 'seven-sages');
        }

        /**
         * Content Template
         */
        public function content_template() 
        {
            ?>
            <label>
            <p>
       <span class="customize-control-title"> {{ data.label }} </span>
       <span class="description customize-control-description">{{ data.description }} </span>
       <# if ( '' !== data.tooltip ) { #>
       <span class="customize-control-tooltip">
           <i class="dashicons dashicons-info" style="color: #b2b6ba;" aria-hidden="true">
            <span class="tooltip">{{ data.tooltip }}</span>
           </i>
       </span>
       <# } #>
       <span class="value">
           <input name="{{ data.id }}" type="number" {{{ data.link }}} value="{{{ data.value }}}" class="seven-sages-control-slider-input" min="{{data.min}}" max="{{data.max}}" step="{{data.step}}" />
           <span class="unit">{{data.unit}}</span>
       </span>
            </p>
            </label>
            <div class="slider <# if ( '' !== data.default ) { #>show-reset<# } #>" data-min="<# if ( data.min ) { #>{{data.min}}<# } #>" data-max="<# if ( data.max ) { #>{{data.max}}<# } #>" data-step="<# if ( data.step ) { #>{{data.step}}<# } #>"></div>
            <# if ( '' !== data.default ) { #>
            <span title="{{ data.reset_title }}" class="seven-sages-control-slider-default-val" data-default-value="{{ data.default }}">
       <span class="dashicons dashicons-image-rotate" aria-hidden="true"></span>
       <span class="screen-reader-text">{{ data.reset_title }}</span>
            </span>
            <# } #>
            <?php
        }

        /**
         * Control assets
         */
        public function enqueue() 
        {
            wp_enqueue_script('seven-sages-customizer-control-slider-js', SEVEN_SAGES_URI . '/inc/assets/js/customizer-control-slider.js', array( 'jquery-ui-core', 'jquery-ui-slider', 'customize-controls' ));
            wp_enqueue_style('seven-sages-customizer-control-slider-css', SEVEN_SAGES_URI . '/inc/assets/css/customizer-control-slider.css' );
            wp_enqueue_style('jquery-ui-slider', SEVEN_SAGES_URI . '/inc/assets/css/jquery-ui-structure.css' );
            wp_enqueue_style('jquery-ui-slider-theme', SEVEN_SAGES_URI . '/inc/assets/css/jquery-ui-theme.css' );
        }
    }
endif;


if (class_exists('WP_Customize_Control') && ! class_exists('Seven_Sages_Customize_Radio_Image') ) :
    /**
     * Radio Image control
     */
    class Seven_Sages_Customize_Radio_Image extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'seven-sages-radio-image';

        /**
         * Enqueue control related scripts/styles.
         *
         * @access public
         */
        public function enqueue() {

            wp_enqueue_script('seven-sages-customizer-radio-image-js', SEVEN_SAGES_URI . '/inc/assets/js/radio-image.js', array( 'jquery', 'customize-controls' ));
            wp_enqueue_style('seven-sages-customizer-radio-image-css', SEVEN_SAGES_URI . '/inc/assets/css/radio-image.css' );
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();

            $this->json['default'] = $this->setting->default;
            if ( isset( $this->default ) ) {
                $this->json['default'] = $this->default;
            }
            $this->json['value'] = $this->value();

            foreach ( $this->choices as $key => $value ) {
                $this->json['choices'][ $key ]        = esc_url( $value['path'] );
                $this->json['choices_titles'][ $key ] = $value['label'];
            }

            $this->json['link'] = $this->get_link();
            $this->json['id']   = $this->id;

            $this->json['inputAttrs'] = '';
            $this->json['labelStyle'] = '';
            foreach ( $this->input_attrs as $attr => $value ) {
                if ( 'style' !== $attr ) {
                    $this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
                } else {
                    $this->json['labelStyle'] = 'style="' . esc_attr( $value ) . '" ';
                }
            }

        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <label class="customizer-text">
                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{{ data.label }}}</span>
                <# } #>
                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>
            </label>
            <div id="input_{{ data.id }}" class="image">
                <# for ( key in data.choices ) { #>
                    <input {{{ data.inputAttrs }}} class="image-select" type="radio" value="{{ key }}" name="_customize-radio-{{ data.id }}" id="{{ data.id }}{{ key }}" {{{ data.link }}}<# if ( data.value === key ) { #> checked="checked"<# } #>>
                        <label for="{{ data.id }}{{ key }}" {{{ data.labelStyle }}}>
                            <img class="wp-ui-highlight" src="{{ data.choices[ key ] }}">
                            <span class="image-clickable" title="{{ data.choices_titles[ key ] }}" ></span>
                        </label>
                    </input>
                <# } #>
            </div>
            <?php
        }
    }
endif;