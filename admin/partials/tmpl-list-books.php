<div class="row" style="margin-top: 20px;">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">List Books</div>
            <div class="panel-body">
                <table id="tbl-list-books" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Shelf Name</th>
                            <th>Email</th>
                            <th>Publication</th>
                            <th>Book Image</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						if ( count( $books_data ) > 0 ) {
							foreach ( $books_data as $key => $data ) { ?>
                        <tr>
                            <th><?php echo esc_html( $data->id ); ?></th>
                            <th><?php echo esc_html( strtoupper( $data->name ) ); ?></th>
                            <th><?php echo esc_html( $data->shelf_name ); ?></th>
                            <th><?php echo esc_html( $data->email ); ?></th>
                            <th>
                                <?php
								if ( ! empty( $data->publication ) ) {
									echo esc_html( $data->publication );
								} else {
									echo '<i>No Publication</i>';
								}
								?>
                            </th>
                            <th><?php if ( ! empty( $data->book_image ) ) { ?>
                                <img src="<?php echo esc_html( $data->book_image ); ?>" ?
                                    style="height: 50px; width:50px">
                                <?php
								} else {
									echo '<i>No Image</i>';
								}
								?>
                            </th>
                            <th><?php echo esc_html( $data->amount ); ?></th>
                            <th>
                                <?php
								if ( $data->status ) {
									?>
                                <button class="btn btn-success">Active</button>
                                <?php
								} else {
									?>
                                <button class="btn btn-danger">Inactive</button>
                                <?php
								}
								?>
                            </th>
                            <th>
                                <button class="btn btn-danger btn-delete-book" _a data-id="
									<?php
									echo esc_attr(
										$data->id
									);
									?>
								">Delete</button>
                            </th>
                        </tr>
                        <?php
							}
						}
						?>
                    </tbody>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Shelf Name</th>
                        <th>Email</th>
                        <th>Publication</th>
                        <th>Book Image</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </table>
            </div>

        </div>
    </div>

</div>