<?php

function muzeum_customize_script(){
    wp_enqueue_style( 'muzeum-customize-css', get_template_directory_uri() . '/inc/customizer/customize.css', array(), MUZEUM_VERSION );
    wp_enqueue_script( 'muzeum-customize-js', get_template_directory_uri() . '/inc/customizer/customize.js', array( 'jquery', 'customize-controls' ), MUZEUM_VERSION, true );

}

add_action( 'customize_controls_enqueue_scripts', 'muzeum_customize_script' );

/**
 * Add Go Pro Button
*/

if( class_exists( 'WP_Customize_Section' ) ) :
    /**
     * Adding Go to Pro Section in Customizer
     * @link https://github.com/justintadlock/trt-customizer-pro
     * @example https://wordpress.org/themes/blossom-travel/
     * 
     */
    class Muzeum_Customize_Section_Pro extends WP_Customize_Section {
    
        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'muzeum-pro-section';
    
        /**
         * Custom button text to output.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_text = '';
    
        /**
         * Custom pro button URL.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_url = '';
    
        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();
    
            $json['pro_text'] = $this->pro_text;
            $json['pro_url']  = esc_url( $this->pro_url );
    
            return $json;
        }
    
        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() { ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
                <div class="accordion-section-title go-pro-section">
                    <# if ( data.pro_text && data.pro_url ) { #>
                        <a href="{{ data.pro_url }}" class="button button-secondary button-red" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </div>
            </li>
        <?php }
    }

endif;

function muzeum_page_sections_pro( $wp_customize ) {
	// Register custom section types.
	$wp_customize->register_section_type( 'Muzeum_Customize_Section_Pro' );

	// Register sections.
	$wp_customize->add_section(
		new Muzeum_Customize_Section_Pro(
			$wp_customize,
			'muzeum_page_view_pro',
			array(
				'title'    => esc_html__( 'Pro Available', 'muzeum' ),
                'priority' => 5, 
				'pro_text' => esc_html__( 'Upgrade to PRO', 'muzeum' ),
				'pro_url'  => esc_url( 'https://nasiothemes.com/themes/muzeum/' ),
			)
		)
	);
}
add_action( 'customize_register', 'muzeum_page_sections_pro' );