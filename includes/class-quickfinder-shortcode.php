<?php
add_shortcode( 'quickfinder', array( new QuickfinderShortcode, 'shortcode' ) );

class QuickfinderShortcode {

	private $atts;

	function shortcode( $atts ) {
		$this->set_atts( $atts );

		return $this->output_shortcode();
	}

	function set_atts( $atts ) {
// merge shortcode atts with defaults
	}

	function get_att( $name ) {
// return a shortcode att
	}

	function output_shortcode() {
		return 'Some HTML';
	}
}