<?php
add_shortcode( 'quickfinder', array( new QuickfinderShortcode, 'shortcode' ) );

class QuickfinderShortcode {
	private $atts;

	public function shortcode( $atts ) {
		return $this->output_shortcode( $atts );
	}

	public function output_shortcode( $atts ) {
		$output         = '';
		$quickfinder_id = (int) $atts['id'];
		if ( get_post_status( $quickfinder_id ) ) {
			$output .= "<div class='quickfinder' id='quickfinder-$quickfinder_id'>";

			$quickfinder_title       = get_the_title( $quickfinder_id );
			$quickfinder_description = get_the_content( '', '', $quickfinder_id );
			if ( $quickfinder_title ) {
				$output .= "<header class='quickfinder-header'>
								<h2 class='quickfinder-header'>$quickfinder_title</h2>
							</header>";
			}
			if ( $quickfinder_description ) {
				$output .= "<article class='quickfinder-description'>
							$quickfinder_description
							</article>";
			}
			//retrieve ACF content
			$quickfinder = get_field( 'section', $quickfinder_id );

			//Debug message
			// echo "<pre>"; var_dump($quickfinder); echo "</pre>";

			if ( ! empty( $quickfinder ) && count( $quickfinder ) > 0 ):
				$output .= "<main class='quickfinder-main'>";
				foreach ( $quickfinder as $key => $section ):
					$section_title = $quickfinder[ $key ]['title'];
					$blocks        = $quickfinder[ $key ]['blocks'];

					$active = $key == 0 ? " active" : null;
					$section_id = $key + 1;
					$output .= "<section id='quickfinder-section-$section_id' class='quickfinder-section quickfinder-section-$section_id $active'>";

					if ( $section_title ):
						$output .= "<header class='section-title'><h3>$section_title</h3></header>";
					endif;

					if ( $blocks && count( $blocks ) > 0 ):
						$output .= "<div class='quickfinder-blocks'>";
						foreach ( $blocks as $block_key => $block ):
							$title          = $block['title'];
							$opener_type    = $block['opener_type'];
							$links          = $block['links'];
							$section_opener = $block['section_opener'] ? (int) $block['section_opener'] : 1;
							if($opener_type['value'] == 'section'):
								$output .= "<a href='#quickfinder-section-$section_opener' class='quickfinder-block'>";
								if($title):
									$output .= "<h4 class='block-title'>$title</h4>";
								endif;

								//echo "<pre>"; var_dump($block); echo "</pre>";
								$output .= "</a>";
							else:
								$output .= "<div class='quickfinder-block'>";
								if($title):
									$output .= "<h4 class='block-title'>$title</h4>";
								endif;

								if($links):
									$output .= "<ol class='link-stack'>";
									foreach($links as $link):
										$output .= "<li><a href='$link[link]'>$link[link_text]</a></li>";
									endforeach;
									$output .= "</ul>";
								endif;

								//echo "<pre>"; var_dump($block); echo "</pre>";
								$output .= "</div>";
							endif;



						endforeach;
						$output .= "</div>";
					endif;

					$output .= "</section >";

				endforeach;
				$output .= '<nav class="quickfinder-navigation">
								<ul>
									<li>
										<a href="#" id="quickfinder-back">'.__('Back','quickfinder').'</a>
									</li>
									<li>
										<a href="#" id="quickfinder-home">'.__('Home','quickfinder').'</a>
									</li>
								</ul>
							</nav>';
				$output .= "</main>";
			endif;
			$output .= "</div>";
		}

		return $output;
	}


}