<?php
namespace BWDICImageCompare\PageSettings;

use Elementor\Controls_Manager;
use Elementor\Core\DocumentTypes\PageBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Page_Settings {

	const PANEL_TAB = 'new-tab';

	public function __construct() {
		add_action( 'elementor/init', [ $this, 'bwdic_compare_add_panel_tab' ] );
		add_action( 'elementor/documents/register_controls', [ $this, 'bwdic_compare_register_document_controls' ] );
	}

	public function bwdic_compare_add_panel_tab() {
		Controls_Manager::add_tab( self::PANEL_TAB, esc_html__( 'New Compare', 'bwd-image-compare' ) );
	}

	public function bwdic_compare_register_document_controls( $document ) {
		if ( ! $document instanceof PageBase || ! $document::get_property( 'has_elements' ) ) {
			return;
		}

		$document->start_controls_section(
			'bwdic_compare_new_section',
			[
				'label' => esc_html__( 'Settings', 'bwd-image-compare' ),
				'tab' => self::PANEL_TAB,
			]
		);

		$document->add_control(
			'bwdic_compare_text',
			[
				'label' => esc_html__( 'Title', 'bwd-image-compare' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'bwd-image-compare' ),
			]
		);

		$document->end_controls_section();
	}
}
