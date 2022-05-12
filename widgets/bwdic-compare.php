<?php
namespace BWDICImageCompare\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BWDMEcompare extends Widget_Base {

	public function get_name() {
		return esc_html__( 'NameImageCompare', 'bwd-image-compare' );
	}

	public function get_title() {
		return esc_html__( 'BWD Image Compare', 'elementor' );
	}

	public function get_icon() {
		return 'bwdic-compare-icon  eicon-h-align-center';
	}

	public function get_categories() {
		return [ 'bwd-image-compare-category' ];
	}

	public function get_script_depends() {
		return [ 'bwd-image-compare-category' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'bwdic_compare_content_section',
			[
				'label' => esc_html__( 'Compare Content', 'bwd-image-compare' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'bwdic_style_selection',
			[
				'label' => esc_html__( 'Compare Styles', 'bwd-image-compare' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__( 'Style 1', 'bwd-image-compare' ),
				],
			]
		);
		$this->add_control(
			'bwdic_image_one',
			[
				'label' => esc_html__( 'First Image', 'bwd-image-compare' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'bwdic_image_two',
			[
				'label' => esc_html__( 'Secound Image', 'bwd-image-compare' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		if('style1' === $settings['bwdic_style_selection']){
		?>
		<div class="bwdic-compare-item bwdic-compare-item-1">
			<div class="bwdic-compare-img-wrapper">
				<div class="bwdic-compare-img">
				<div class="bwdic-before">
					<img src="<?php echo esc_url($settings['bwdic_image_one']['url']); ?>" alt="img" />
					<div class="bwdic-after" style="background-image: url(<?php echo esc_url($settings['bwdic_image_two']['url']); ?>)"></div>
					<div class="bwdic-slider-bar">
					<div class="bwdic-drag-line">
						<div class="bwdic-dragline-inner"></div>
					</div>
					<input type="range" min="0" class="bwdic-range-inp" />
					</div>
				</div>
				</div>
			</div>
		</div>
		<?php
		}
	}

    protected function content_template() {
		?>
		<# if('style1' === settings['bwdic_style_selection']){ #>
		<div class="bwdic-compare-item bwdic-compare-item-1">
			<div class="bwdic-compare-img-wrapper">
				<div class="bwdic-compare-img">
				<div class="bwdic-before">
					<img src="{{{settings['bwdic_image_one']['url']}}}" alt="img" />
					<div class="bwdic-after" style="background-image: url({{{settings['bwdic_image_two']['url']}}})"></div>
					<div class="bwdic-slider-bar">
					<div class="bwdic-drag-line">
						<div class="bwdic-dragline-inner"></div>
					</div>
					<input type="range" min="0" class="bwdic-range-inp" />
					</div>
				</div>
				</div>
			</div>
		</div>
		<# } #>
		<?php
    }
}
