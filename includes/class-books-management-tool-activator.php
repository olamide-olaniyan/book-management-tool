<?php
/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/includes
 * @author     Your Name <email@example.com>
 */
class Books_Management_Tool_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() {
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		global $wpdb;

		$table_query = 'CREATE TABLE IF NOT EXISTS `' . $this->get_table_name() . '` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(150) DEFAULT NULL,
			`amount` int(11) DEFAULT NULL,
			`description` text,
			`book_image` varchar(200) DEFAULT NULL,
			`publication` varchar(150) DEFAULT NULL,
			`email` varchar(150) DEFAULT NULL,
			`shelf_id` int(11) NULL,
			`status` int(11) NOT NULL DEFAULT 1,
			`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;';

		$shelf_table_query = 'CREATE TABLE IF NOT EXISTS `' . $this->get_book_shelf_table_name() . '` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(150) NOT NULL,
			`capacity` int(11) NOT NULL,
			`location` varchar(200) NOT NULL,
			`status` int(11) NOT NULL DEFAULT 1,
			`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;';

		dbDelta( $table_query );
		dbDelta( $shelf_table_query );

		$wpdb->insert( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
			$this->get_book_shelf_table_name(),
			array(
				'name'     => 'Shelf 1',
				'capacity' => 100,
				'location' => 'Location 1',
			),
			array( '%s', '%d', '%s' )
		);
		$wpdb->insert( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
			$this->get_book_shelf_table_name(),
			array(
				'name'     => 'Shelf 2',
				'capacity' => 100,
				'location' => 'Location 2',
			),
			array(
				'%s',
				'%d',
				'%s',
			)
		);

		// create page on plugin activation.
		$get_data = $wpdb->get_row( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
			$wpdb->prepare(
				"SELECT * FROM $wpdb->posts WHERE post_name = %s",
				'books_tool'
			)
		);

		if ( ! $get_data ) {
			$page = array(
				'post_title'   => 'Books Tool',
				'post_name'    => 'books_tool',
				'post_status'  => 'publish',
				'post_content' => 'Simple page content of books tool.',
				'post_author'  => 1,
				'post_type'    => 'page',
			);
			wp_insert_post( $page );
		}
	}

	/**
	 * Get the table name for the books.
	 *
	 * @return string The table name.
	 */
	public function get_table_name() {
		global $wpdb;
		return $wpdb->prefix . 'bmt_books';
	}

	/**
	 * Get the table name for the book shelf.
	 *
	 * @return string The table name.
	 */
	public function get_book_shelf_table_name() {
		global $wpdb;
		return $wpdb->prefix . 'bmt_books_shelf';
	}
}
