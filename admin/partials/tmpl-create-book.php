<?php
	wp_enqueue_media();
?>
<div class="row" style="margin-top: 20px;">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Create Book</div>
            <div class="panel-body">
                <form class="form-horizontal" action="javascript:void(0)" id="frm-create-book">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="dd_book_shelf">Book Shelf:</label>
                        <div class="col-sm-4">
                            <select class="form-control" required name="dd_book_shelf" id="dd_book_shelf">
                                <option value="">Choose Shelf</option>
                                <?php
								if ( count( $book_shelves ) > 0 ) {
									foreach ( $book_shelves as $key => $data ) {
										?>
                                <option value="<?php echo esc_attr( $data->id ); ?>">
                                    <?php echo esc_html( strtoupper( $data->name ) ); ?></option>
                                <?php
									}
								}
								?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txt_name">Name:</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" name="txt_name" id="txt_name"
                                placeholder="Enter name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txt_email">Email:</label>
                        <div class="col-sm-4">
                            <input type="email" required class="form-control" name="txt_email" id="txt_email"
                                placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txt_publication">Publication:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="txt_publication" id="txt_publication"
                                placeholder="Enter publication">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txt_description">Description:</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" name="txt_description" id="txt_description"
                                placeholder="Enter description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txt_image">Book Image:</label>
                        <div class="col-sm-4">
                            <input type="button" value="Upload Image" class="form-control" name="txt_image"
                                id="txt_image">
                            <img src="" id="img-preview" style="height: 80px; width: 80px;">
                            <input type="hidden" name="book_cover_image" id="book_cover_image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txt_cost">Book cost:</label>
                        <div class="col-sm-4">
                            <input type="number" required min="1" class="form-control" name="txt_cost" id="txt_cost"
                                placeholder="Enter Book cost">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="dd_status">Status:</label>
                        <div class="col-sm-4">
                            <select class="form-control" required name="dd_status" id="dd_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
