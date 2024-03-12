<div class="row" style="margin-top: 20px;">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Create Book</div>
            <div class="panel-body">
                <form class="form-horizontal" action="javascript:void(0)" id="frm-add-book-shelf">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txt_shelf_name">Shelf Name:</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" name="txt_shelf_name" id="txt_shelf_name"
                                placeholder="Enter shelf name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txt_shelf_capacity">Shelf Capacity:</label>
                        <div class="col-sm-4">
                            <input type="number" min="1" class="form-control" name="txt_shelf_capacity"
                                id="txt_shelf_capacity" placeholder="Enter Shelf capacity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txt_shelf_location">Shelf Location:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="txt_shelf_location" id="txt_shelf_location"
                                placeholder="Enter shelf location">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="dd_status">Status:</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="dd_status" id="dd_status">
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
