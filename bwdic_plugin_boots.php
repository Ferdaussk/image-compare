<?php
namespace BWDICImageCompare;

use BWDICImageCompare\PageSettings\Page_Settings;
define( "BWDIC_ASFSK_ASSETS_PUBLIC_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/public" );
define( "BWDIC_ASFSK_ASSETS_ADMIN_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/admin" );
class ClassBWDICImageCompare {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function bwdic_admin_editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'bwdic_admin_editor_scripts_as_a_module' ], 10, 2 );
	}

	public function bwdic_admin_editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'bwdic_the_compare_editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/bwdic-compare.php' );
	}

	public function bwdic_register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\BWDMEcompare() );
	}

	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/image-compare-manager.php' );
		new Page_Settings();
	}

	// Register Category
	function bwdic_add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'bwd-image-compare-category',
			[
				'title' => esc_html__( 'BWD Image Compare', 'bwd-image-compare' ),
				'icon' => 'eicon-person',
			]
		);
	}
	public function bwdic_all_assets_for_the_public(){
		// wp_enqueue_script( 'bwdic_compare_the_main_js', plugin_dir_url( __FILE__ ) . 'assets/public/js/custom.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'bwdic_compare_the_main_one_js', plugin_dir_url( __FILE__ ) . 'assets/public/js/custom-one.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'bwdic_compare_the_mainel_two_js', plugin_dir_url( __FILE__ ) . 'assets/public/js/custom-two.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'bwdic_compare_the_mainel_three_js', plugin_dir_url( __FILE__ ) . 'assets/public/js/custom-three.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'bwdic_compare_the_mainel_four_js', plugin_dir_url( __FILE__ ) . 'assets/public/js/custom-four.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'bwdic_compare_the_mainel_five_js', plugin_dir_url( __FILE__ ) . 'assets/public/js/custom-five.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'bwdic_compare_the_mainel_six_js', plugin_dir_url( __FILE__ ) . 'assets/public/js/custom-six.js', array('jquery'), '1.0', true );
		// wp_enqueue_script( 'bwdic_compare_the_mainel_jquery_js', plugin_dir_url( __FILE__ ) . 'code.jquery.com/jquery-3.6.0.min.js', array('jquery'), '1.0', true );
		$all_css_js_file = array(
            'bwdic_compare_main_css' => array('bwdic_path_define'=>BWDIC_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/css/style.css'),
        );
        foreach($all_css_js_file as $handle => $fileinfo){
            wp_enqueue_style( $handle, $fileinfo['bwdic_path_define'], null, '1.0', 'all');
        }
	}
	public function bwdic_all_assets_for_elementor_editor_admin(){
		wp_enqueue_script( 'bwdic_compare_admin_the_main_one_js', plugin_dir_url( __FILE__ ) . 'assets/admin/js/custom-one.js', array('jquery'), '1.0', true );
		$all_css_js_file = array(
            'bwdic_compare_admin_icon_css' => array('bwdic_path_admin_define'=>BWDIC_ASFSK_ASSETS_ADMIN_DIR_FILE . '/icon.css'),
        );
        foreach($all_css_js_file as $handle => $fileinfo){
            wp_enqueue_style( $handle, $fileinfo['bwdic_path_admin_define'], null, '1.0', 'all');
        }
	}
	public function bwdic_all_assets_for_the_frontens_scripts(){
		wp_enqueue_script( 'bwdic_compare_admin_the_main_one_jsaa', plugin_dir_url( __FILE__ ) . 'assets/public/js/custom-one.js', array('jquery'), '1.0', true );
	}

	public function __construct() {
		// For public assets
		add_action('wp_enqueue_scripts', [$this, 'bwdic_all_assets_for_the_public']);

		// For fontend scripts
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'bwdic_all_assets_for_the_frontens_scripts' ] );

		// For Elementor Editor
		add_action('elementor/editor/before_enqueue_scripts', [$this, 'bwdic_all_assets_for_elementor_editor_admin']);
		
		// Register Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'bwdic_add_elementor_widget_categories' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'bwdic_register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'bwdic_admin_editor_scripts' ] );
		
		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
ClassBWDICImageCompare::instance();