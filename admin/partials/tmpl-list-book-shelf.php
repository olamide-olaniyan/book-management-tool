<div class="row" style="margin-top: 20px;">
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">List Book Shelf</div>
			<div class="panel-body">
				<table id="tbl-list-book-shelf" class="display" style="width:100%">
					<thead>
						<tr>
							<th>#ID</th>
							<th>Name</th>
							<th>Capacity</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ( count( $book_shelves ) > 0 ) {
							foreach ( $book_shelves as $index => $data ) { ?>
						<tr>
							<th><?php echo esc_html( $data->id ); ?></th>
							<th><?php echo esc_html( $data->name ); ?></th>
							<th><?php echo esc_html( $data->location ); ?></th>
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
							<th><button class="btn btn-danger btn-delete-book-shelf"
									data-id="<?php echo esc_attr( $data->id ); ?>">Delete</button>
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
						<th>Capacity</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</table>
			</div>

		</div>
	</div>
</div>
