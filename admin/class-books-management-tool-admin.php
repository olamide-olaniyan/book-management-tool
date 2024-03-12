<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/admin
 * @author     Your Name <email@example.com>
 */
class Books_Management_Tool_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The table activator.
	 *
	 * @var object
	 */
	private $table_activator;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		require_once BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH . 'includes/class-books-management-tool-activator.php';
		$activator             = new Books_Management_Tool_Activator();
		$this->table_activator = $activator;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		$valid_pages = array(
			'books-management-tool',
			'books-management-create-book',
			'books-management-list-book',
			'books-management-create-book-shelf',
			'books-management-list-book-shelf',
		);

		$page = isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash

		if ( in_array( $page, $valid_pages, true ) ) {
			wp_enqueue_style( 'bmt-bootstrap', BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/css/bootstrap.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'bmt-data-table', BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/css/dataTables.dataTables.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'bmt-sweetalert', BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/css/sweetalert.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		$valid_pages = array(
			'books-management-tool',
			'books-management-create-book',
			'books-management-list-book',
			'books-management-create-book-shelf',
			'books-management-list-book-shelf',
		);

		$page = isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash

		if ( in_array( $page, $valid_pages, true ) ) {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'bmt-bootstrap', BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( 'bmt-data-table', BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/js/dataTables.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( 'bmt-sweetalert', BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/js/sweetalert.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( 'bmt-jquery-validate', BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( 'bmt-admin', BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'admin/js/books-management-tool-admin.js', array( 'jquery' ), $this->version, false );
			wp_localize_script(
				'bmt-data-table',
				'bmt_books',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'nonce'    => wp_create_nonce( 'bmt_books' ),
				)
			);

		}
	}

	/**
	 * Add the menu page
	 *
	 * @since    1.0.0
	 */
	public function book_management_menu() {
		add_menu_page(
			'Books Management Tool',
			'Books Management Tool',
			'manage_options',
			'books-management-tool',
			array( $this, 'book_management_plugin' ),
			'dashicons-admin-site-alt3',
			21
		);

		add_submenu_page(
			'books-management-tool',
			'Dashboard',
			'Dashboard',
			'manage_options',
			'books-management-tool',
			array( $this, 'book_management_plugin' )
		);

		add_submenu_page(
			'books-management-tool',
			'Create Book Shelf',
			'Create Book Shelf',
			'manage_options',
			'books-management-create-book-shelf',
			array( $this, 'book_management_create_book_shelf' )
		);

		add_submenu_page(
			'books-management-tool',
			'List Book Shelf',
			'List Book Shelf',
			'manage_options',
			'books-management-list-book-shelf',
			array( $this, 'book_management_list_book_shelf' )
		);

		add_submenu_page(
			'books-management-tool',
			'Create Book',
			'Create Book',
			'manage_options',
			'books-management-create-book',
			array( $this, 'book_management_create_book' )
		);

		add_submenu_page(
			'books-management-tool',
			'List Book',
			'List Book',
			'manage_options',
			'books-management-list-book',
			array( $this, 'book_management_list_book' )
		);
	}

	/**
	 * Display the menu page
	 *
	 * @since    1.0.0
	 */
	public function book_management_plugin() {
		echo '<h3>Welcome to the Books Management Tool</h3>';
	}

	/**
	 * Display the submenu page
	 *
	 * @since    1.0.0
	 */
	public function book_management_create_book_shelf() {
		ob_start();
		include_once BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH . 'admin/partials/tmpl-create-book-shelf.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Display the submenu page
	 *
	 * @since    1.0.0
	 */
	public function book_management_list_book_shelf() {
		global $wpdb;
		$table_name = $this->table_activator->get_book_shelf_table_name();

		$book_shelves = $wpdb->get_results( 'SELECT * FROM ' . $table_name ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL

		ob_start();
		include_once BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH . 'admin/partials/tmpl-list-book-shelf.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Display the submenu page
	 *
	 * @since    1.0.0
	 */
	public function book_management_create_book() {
		global $wpdb;
		$table_name = $this->table_activator->get_book_shelf_table_name();

		$book_shelves = $wpdb->get_results( 'SELECT id, name FROM ' . $table_name ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL

		ob_start();
		include_once BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH . 'admin/partials/tmpl-create-book.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Display the submenu page
	 *
	 * @since    1.0.0
	 */
	public function book_management_list_book() {
		global $wpdb;
		$table_name       = $this->table_activator->get_table_name();
		$shelf_table_name = $this->table_activator->get_book_shelf_table_name();

		$books_data = $wpdb->get_results( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
			"SELECT b.id, b.name, b.email, b.description, b.amount, b.status, b.book_image, b.publication, bs.name as shelf_name FROM $table_name b LEFT JOIN $shelf_table_name bs ON b.shelf_id = bs.id" // phpcs:ignore WordPress.DB.PreparedSQL
		);

		ob_start();
		include_once BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH . 'admin/partials/tmpl-list-books.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Handle AJAX requests in the admin area.
	 *
	 * @since    1.0.0
	 */
	public function handle_ajax_requests_admin() {
		global $wpdb;
		$param = isset( $_REQUEST['param'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['param'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		if ( 'create_book_shelf' === $param ) {
			$name     = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['txt_shelf_name'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['txt_shelf_name'] ) ) : '';
			$capacity = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['txt_shelf_capacity'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? intval( wp_unslash( $_REQUEST['txt_shelf_capacity'] ) ) : '';
			$location = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['txt_shelf_location'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['txt_shelf_location'] ) ) : '';
			$status   = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['dd_status'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['dd_status'] ) ) : '';

			$wpdb->insert( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
				$this->table_activator->get_book_shelf_table_name(),
				array(
					'name'     => $name,
					'capacity' => $capacity,
					'location' => $location,
					'status'   => $status,
				)
			);

			if ( $wpdb->insert_id ) {
				echo wp_json_encode(
					array(
						'status'  => 1,
						'message' => 'Book shelf created successfully.',
					)
				);
			} else {
				echo wp_json_encode(
					array(
						'status'  => 0,
						'message' => 'Error in creating book shelf.',
					)
				);
			}
		}
		if ( 'delete_book_shelf' === $param ) {
			$id = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['book_shelf_id'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? intval( wp_unslash( $_REQUEST['book_shelf_id'] ) ) : '';

			$wpdb->delete( // phpcs:ignore WordPress.DB.DirectDatabaseQuery 
				$this->table_activator->get_book_shelf_table_name(),
				array( 'id' => $id )
			);

			if ( $wpdb->rows_affected ) {
				echo wp_json_encode(
					array(
						'status'  => 1,
						'message' => 'Book shelf deleted successfully.',
					)
				);
			} else {
				echo wp_json_encode(
					array(
						'status'  => 0,
						'message' => 'Error in deleting book shelf.',
					)
				);
			}
		}
		if ( 'create_book' === $param ) {
			$name             = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['txt_name'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['txt_name'] ) ) : '';
			$email            = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['txt_email'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['txt_email'] ) ) : '';
			$publication      = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['txt_publication'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['txt_publication'] ) ) : '';
			$description      = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['txt_description'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['txt_description'] ) ) : '';
			$amount           = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['txt_cost'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? intval( wp_unslash( $_REQUEST['txt_cost'] ) ) : '';
			$book_shelf       = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['dd_book_shelf'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? intval( wp_unslash( $_REQUEST['dd_book_shelf'] ) ) : '';
			$status           = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['dd_status'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['dd_status'] ) ) : '';
			$book_cover_image = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['book_cover_image'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['book_cover_image'] ) ) : '';

			$wpdb->insert( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
				$this->table_activator->get_table_name(),
				array(
					'name'        => strtolower( $name ),
					'email'       => $email,
					'description' => $description,
					'amount'      => $amount,
					'shelf_id'    => $book_shelf,
					'status'      => $status,
					'book_image'  => $book_cover_image,
					'publication' => $publication,
				)
			);

			if ( $wpdb->insert_id ) {
				echo wp_json_encode(
					array(
						'status'  => 1,
						'message' => 'Book created successfully.',
					)
				);
			} else {
				echo wp_json_encode(
					array(
						'status'  => 0,
						'message' => 'Error in creating book.',
					)
				);
			}
		}
		if ( 'delete_book' === $param ) {
			$id = ( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['book_id'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'bmt_books' ) ) ? intval( wp_unslash( $_REQUEST['book_id'] ) ) : '';

			$wpdb->delete( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
				$this->table_activator->get_table_name(),
				array( 'id' => $id )
			);

			if ( $wpdb->rows_affected ) {
				echo wp_json_encode(
					array(
						'status'  => 1,
						'message' => 'Book deleted successfully.',
					)
				);
			} else {
				echo wp_json_encode(
					array(
						'status'  => 0,
						'message' => 'Error in deleting book.',
					)
				);
			}
		}
		wp_die();
	}
}
