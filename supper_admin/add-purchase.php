<html lang="en"> <?php
include('include/head.php');
?> <body class="sb-nav-fixed"> <?php 
    include('include/nav.php');
    include('include/sidebar.php');
    include('modal/addpro.php');
    ?>
    <!--Close Modal Add Product-->
    <div id="layoutSidenav_content">
      <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <form class="calculate" oncChange="add_calcualte()" id="addPurchaseForm">
              <div class="row">
                <div class="col-lg-10 col-sm-12 col-md-6 mt-3">
                  <h5 style="color: #3f5eb5;  text-align: left;"> Purchase <i class="fa fa-angle-right"></i> Purchase Invoice </h5>
                </div>
                <div class="col-lg-2 col-sm-6 col-md-3 mt-2" style="background-color: #fff;">
                  <a class="btn btn-light" href="purchase-history" role="button" style=" margin-top: 5px; margin-left:0px; text-align: center; color: black; font-weight: normal; font-size: 16px; font-family: serif;">
                    <i class="fa fa-folder" style="color: black;"></i> Purchase History </a>
                </div>
              </div>
              <hr>
              <!-- Product Select Topbar -->
              <div class="row">
                <div class="col-md-8">
                  <div class="card pb-0 pb-0">
                    <div class="card-body pb-0  ">
                      <div class="row">
                        <div class="form-group col-md-2">
                          <input type="text" name='d_ate' readonly required class="form-control form-control-sm" value="23-05-2024" required>
                        </div>
                        <div class="form-group col-md-3">
                          <input type="number" name='invoice_no' required id="invoice_no" class="form-control form-control-sm" placeholder="Invoice# 00-0000">
                          <span id="availability"></span>
                        </div>
                        <div class="form-group col-md-4"> 
                            
                            <select id="supplier_id" class="form-control js-select2" name="supplier_id" required>
                            <option>Choose Supplier</option> 
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <input type="text" name='current_blance' readonly required class="form-control form-control-sm" value="Blance - 200020 Tk" required>
                        </div>
                      </div>
                    </div>
                    <div class="mt-2 bsection" style="padding: 10px;">
                      <div class="product-read">
                        <div class="outer">
                          <div class="row">
                            <div class="col-md-10">
                              <div class="ui-widget">
                                <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                                <input type="text" autofocus class="searchcode add form-control" style="background: lavenderblush;" name="searchcode" id="search" placeholder="Search the Product">
                                <div class="result-box col-md-12 search-result" id="result"></div>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Product</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="table-responsive mt-5">
                      <table class="table table-bordered items-table">
                          <thead>
                              <tr>
                                  <th><div class="all_pdelete"><i class="fa fa-trash"></i></div></th>
                                  <th>S/N</th>
                                  <th>Barcode</th>
                                  <th>Product Name</th>
                                  <th>Expire Date</th>
                                  <th>Qty.</th>
                                  <th>Buy Rate</th>
                                  <th>Retl Price</th>
                                  <th>Wh Price</th>
                                  <th>STotal</th>
                              </tr>
                          </thead>
                          <tbody id="p_add_table"></tbody>
                      </table>
                  </div>
                  </div>
                </div>
                <!-- Product Select Topbar End -->
                <div class="col-md-4">
                  <div class="row ">
                    <div class="col-md-12 form-group">
                      <input type="hidden" name="added_by" value="">
                      <input class="form-control  text-center font-weight-bold sub_total" readonly="" type="hidden" id="sub_total" name="sub_total">
                      <label for="total">Total</label>
                      <p>
                        <input class="form-control text-success text-right font-weight-bold h6 total" readonly="" type="text" id="total" name="total" style="background-color: #20c997;
                                        padding: 1rem;
                                        padding: 2rem !important;
                                        font-size: 33px;
                                        text-align: center;
                                        text-align: center !important;
                                        color: #000 !important;">
                      </p>
                    </div>
                    <div class="col-md-6 form-group">
                      <div class="input-group mb-0 mr-sm-0">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Commission</div>
                        </div>
                        <input class="form-control  text-center font-weight-bold commission" type="text" id="commission" name="commission">
                      </div>
                    </div>
                    <div class="col-md-6 form-group">
                      <label class="sr-only" for="shipping">Shipping</label>
                      <div class="input-group mb-0 mr-sm-0">
                        <div class="input-group-prepend">
                          <div class="input-group-text" style="width: 100px;">Shipping</div>
                        </div>
                        <input class="form-control text-success text-right font-weight-bold shipping" autocomplete="off" type="text" id="shipping" name="shipping">
                      </div>
                    </div>
                    <div class="col-md-6 form-group">
                      <label class="sr-only" for="payable">Payable</label>
                      <div class="input-group mb-0 mr-sm-0">
                        <div class="input-group-prepend">
                          <div class="input-group-text" style="width: 100px;">Payable</div>
                        </div>
                        <input class="form-control text-success text-right font-weight-bold payable" readonly="" type="text" id="payable" name="payable">
                      </div>
                    </div>
                    <div class="col-md-6 form-group">
                      <label class="sr-only" for="paid">Paid</label>
                      <div class="input-group mb-0 mr-sm-0">
                        <div class="input-group-prepend">
                          <div class="input-group-text pay" style="width: 100px;">Paid</div>
                        </div>
                        <input class="form-control text-success text-right font-weight-bold paid" autocomplete="off" type="text" id="paid" name="paid">
                      </div>
                    </div>
                    <div class="col-md-6 form-group">
                      <label class="sr-only" for="due">Due</label>
                      <div class="input-group mb-0 mr-sm-0">
                        <div class="input-group-prepend">
                          <div class="input-group-text" style="width: 100px;">Due</div>
                        </div>
                        <input class="form-control text-danger text-right font-weight-bold due" readonly="" type="text" id="due" name="due">
                      </div>
                    </div>
                    <div class="col-md-6 form-group">
                      <label class="sr-only" for="due">Previous Due</label>
                      <div class="input-group mb-0 mr-sm-0">
                        <div class="input-group-prepend">
                          <div class="input-group-text" style="width: 100px;">Previous Due</div>
                        </div>
                        <input class="form-control text-danger text-right font-weight-bold due" readonly="" type="text" id="previous_due" name="previous_due">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6" style="float:right">
                  <label for="comment">Comment</label>
                  <textarea rows="3" class="form-control" name="comment"></textarea>
                </div>
              </div>
              <hr>
              <div class="card-footer">
                <div class="col-md-12 text-right">
                  <button type="button" class="btn btn-outline-success" id="addPurchaseBtn">save</button>
                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </div>
              </div>
              <!--- Hidden Object-->
              <input type="hidden" class="form-control" name="created" value="2023-02-28 15:48:37">
              <input type="hidden" class="form-control" name="uniqueid" value="1699029330">
              <!--- Hidden Object-->
            </form>
        </section>
      </div>
    </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../epos/assets/js/scripts.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../assets/plugin/chart/datatables-demo.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js'></script>
    <script src="../epos/assets/plugin/select2/dist/script.js"></script>
    <script src="../epos/assets/js/shortcut.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js'></script>
    <!-- <script src="../assets/js/buy.js"></script> -->
    <!-- Get Product List for Search -->
    <script>
    $(document).ready(function() {
        // AJAX request for product search
        $('#search').on('input', function() {
            let query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: 'search_product.php',
                    method: 'GET',
                    data: { query: query },
                    dataType: 'json',
                    success: function(response) {
                    console.log('Response:', response);
                    let resultBox = $('#result');
                    resultBox.html('');
                    if(response.products && response.products.length > 0) {
                        response.products.forEach(product => {
                            resultBox.append(`<li class="search-result-item" data-product='${JSON.stringify(product)}'>${product.name}</li>`);
                        });
                    } else {
                        resultBox.append('<li>No results found</li>');
                    }
                },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error); // Log AJAX errors for debugging
                        console.error('Response Text:', xhr.responseText); // Log the response text for debugging
                    }
                });
            } else {
                $('#result').html('');
            }
        });

        // Add product to the table
        $('#result').on('click', '.search-result-item', function() {
            let product = $(this).data('product');
        console.log('Selected Product:', product);
            let existingRow = $('#p_add_table').find(`tr[data-product-id="${product.id}"]`);

        if (existingRow.length > 0) {
            let qtyInput = existingRow.find('input[name="qty[]"]');
            let newQty = parseInt(qtyInput.val()) + 1;
            qtyInput.val(newQty);
        } else {
            let row = `
                <tr class="productRow" data-product-id="${product.id}">
                    <td style='text-align: center'>
                        <div class="deleteBtn" data-product-id="${product.id}">
                            <i class="fa fa-trash"></i>
                        </div>
                    </td>
                    <td class="serial-number"></td>
                    <input type='hidden' readonly value='${product.id}' name='product_id[]' class='table_input'>
                    <td><input type='text' readonly value='${product.barcode}' name='product_barcode[]' class='table_input'></td>
                    <td><input type='text' value='${product.name}' name='product_name[]' class='table_input'></td>
                    <td><input type='date' value='' name='expire_date[]' class='table_input'></td>
                    <td><input type='number' value='1' min="1" name='qty[]' class='table_input_number qty'></td>
                    <td><input type='number' min="1" value='${product.buy_rate}' name='buy[]' class='table_input_number buy'></td>
                    <td><input type='number' min="1" value='${product.retail_price}' name='sale[]' class='table_input_number sale'></td>
                    <td><input type='number' min="1" value='${product.whole_price}' name='wh_price[]' class='table_input_number wh_price'></td>
                    <td><input type='number' value='' name='sub_buy[]' readonly class='table_input_number sub_buy'></td>
                </tr>`;
            $('#p_add_table').append(row);
            updateSerialNumbers();
        }
            $('#result').html('');
            $('#search').val('');
            add_calcualte();
        });

        // Delete product row from the table
        $(document).on('click', '.deleteBtn', function() {
            $(this).closest('tr').remove();
            add_calcualte();
        });

        // Calculate totals
        function add_calcualte() {
            var grandTotal = 0;
            $("input[name='qty[]']").each(function (index) {
                var qty = $("input[name='qty[]']").eq(index).val();
                var buy = $("input[name='buy[]']").eq(index).val();
                var output = parseFloat(parseFloat(qty) * parseFloat(buy)).toFixed(2);
                if (!isNaN(output)) {
                    $("input[name='sub_buy[]']").eq(index).val(output);
                    grandTotal = parseFloat(parseFloat(grandTotal) + parseFloat(output)).toFixed(2);

                    var commission = +$("#commission").val() || 0;
                    var shipping = +$("#shipping").val() || 0;
                    var paid = +$("#paid").val() || 0;
                    var predue = +$("#previous_due").val() || 0;

                    $('#sub_total').val(grandTotal);
                    $('#total').val(grandTotal - commission + shipping);
                    $('#due').val(grandTotal - commission + shipping - paid + predue);
                }
            })
        }

        // Change Calculate Value
        $(document).on('keyup change', '.calculate', function () {
            add_calcualte();
        });

        $(document).ready(function() {
          $.ajax({
              url: 'fetch_suppliers.php',
              type: 'GET',
              success: function(data) {
                  $('#supplier_id').append(data);
              }
          });
          
          $('#supplier_id').on('change', function() {
              let supplierId = $(this).val();
              if (supplierId) {
                  $.ajax({
                      url: 'fetch_suppliers.php',
                      type: 'GET',
                      data: { supplier_id: supplierId },
                      success: function(data) {
                          let parsedData = JSON.parse(data);
                          $('#previous_due').val(parsedData.previous_due);
                          add_calcualte();
                      },
                      error: function(xhr, status, error) {
                          console.error('AJAX Error:', status, error);
                          console.error('Response Text:', xhr.responseText);
                      }
                  });
              } else {
                  $('#previous_due').val('');
              }
          });
        });
        function updateSerialNumbers() {
        $('#p_add_table tr').each(function(index) {
            $(this).find('.serial-number').text(index + 1);
        });
    }
    });
</script>

<script>
    $(document).ready(function() {
        $('#addPurchaseBtn').click(function() {
            var formData = new FormData($('#addPurchaseForm')[0]);

            // Log the form data to the console
            for (var pair of formData.entries()) {
                console.log(pair[0]+ ': ' + pair[1]);
            }

            $.ajax({
                url: 'purchase.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

    <style>
      .product_search_res {
        list-style: none;
        background: #EEEEEE;
        border-radius: 5px;
        padding: 5px;
        margin: 1px;
        color: #000;
        z-index: 9999;
      }

      .product_search_res:hover {
        background-color: #FEF7D7;
      }
    </style>
  </body>
</html> ?>