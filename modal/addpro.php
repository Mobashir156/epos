
<!-- Modal Add Product-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addProductForm" enctype="multipart/form-data">
          <div class="row">
            <input type="hidden" name="author_id" value="1">
            <div class="form-group col-md-6 col-sm-12">
              <label for="barcode">Barcode</label>
              <input type="text" class="form-control" id="barcode" name="barcode" autofocus required="required">
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="inputEmail4">Auto Code</label>
              <a class="btn btn-warning btn-block" style="height: 36px;font-size: 24px;text-align: center;display: flex;align-items: center;justify-content: center;" onclick="getElementById('barcode').value=Math.floor(Math.random() * 10) + Date.now()">
                <i class="fa fa-barcode"></i>
              </a>
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="product_name">Product Name <samp class="text-danger"> * </samp>
              </label>
              <input type="text" class="form-control" id="product_name" name="product_name" required="required">
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="product_category">Category <samp class="text-danger"> * </samp>
              </label>
              <select id="product_category" type="text" class="form-control js-select2" name="product_category" required>
              <option value="">Choose Category</option>
                <option value="1">Shirt</option>
                <option value="2">Grocery</option>
              </select>
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="unit_type">Unit <samp class="text-danger"> * </samp>
              </label>
              <select id="unit_type" type="text" class="form-control js-select2" name="unit_type" required>
                <option value="" disabled selected>Choose Your Unit Type</option>
                <option value="KG">KG</option>
              </select>
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="buy_rate">Buy Rate <samp class="text-danger"> * </samp>
              </label>
              <input type="number" min="0" class="form-control" id="buy_rate" name="buy_rate" required="required">
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="retail_price">Retail Price <samp class="text-danger"> * </samp>
              </label>
              <input type="number" min="0" id="retail_price" class="form-control" name="retail_price" required="required">
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="wholesale_price">Wholesale Price <samp class="text-danger"> * </samp>
              </label>
              <input type="number" min="0" id="wholesale_price" class="form-control" name="wholesale_price" required="required">
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="opening_stock">Opening</label>
              <input type="number" min="0" class="form-control" id="opening_stock" name="opening_stock">
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="product_img">Product Image (Optinal)</label>
              <input type="file" class="form-control" id="product_img" name="product_img">
            </div>
          </div>
          <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addProductBtn">Add Product</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
    $('#addProductBtn').click(function() {
        var formData = new FormData($('#addProductForm')[0]);

        $.ajax({
            url: 'insert_product.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                $('#addProductForm')[0].reset();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>