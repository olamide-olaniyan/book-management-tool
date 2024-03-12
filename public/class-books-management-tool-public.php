<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/public
 * @author     Your Name <email@example.com>
 */
class Books_Management_Tool_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Books_Management_Tool_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Books_Management_Tool_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/books-management-tool-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Books_Management_Tool_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Books_Management_Tool_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/books-management-tool-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Custom page template for Books Management Tool.
	 *
	 * @return string The path to the custom page template.
	 */
	public function bmt_custom_page_template() {
		global $post;
		if ( 'books_tool' === $post->post_name ) {
			$template = BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH . 'public/partials/book-tool-layout.php';
			if ( file_exists( $template ) ) {
				return $template;
			}
		}
		return $template;
	}

	/**
	 * Render the content of the Books Management Tool.
	 *
	 * @since 1.0.0
	 */
	public function render_bmt_content() {
		ob_start();
		include BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH . 'public/partials/book-tool-content.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
