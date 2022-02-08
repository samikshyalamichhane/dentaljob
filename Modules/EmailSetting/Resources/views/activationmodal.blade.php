<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Stock</h4>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            {{csrf_field()}}
            <input type="hidden" name="product_id" id="title" value=""/>
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" name="title" id="product_name" value="" disabled/>
            </div>
            <div class="form-group">
              <label>Add Number of Products</label>
              <input type="number" name="number_of_products" class="form-control">
            </div>
            

            <div class="form-group">
              <input type="submit" name="submit" value="submit" class="btn btn-success mt-3">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>