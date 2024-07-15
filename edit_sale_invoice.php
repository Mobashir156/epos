<?php
include 'config/app.php';
include 'models/Sales.php';

$database = new DatabaseConnection();
$db = $database->getConnection();

$sales = new Sales($db);

if (isset($_GET['uniqueid'])) {
    $sales_id = $_GET['uniqueid'];
    $sale = $sales->getSaleById($sales_id);

    if (!$sale) {
        echo "<div class='alert alert-danger'>Sale not found.</div>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sales->sales_id = $_POST['sales_id'];
    $sales->barcode = $_POST['barcode'];
    $sales->pname = $_POST['pname'];
    $sales->user_id = $_POST['user_id'];
    $sales->qty = $_POST['qty'];
    $sales->price = $_POST['price'];
    $sales->discount = $_POST['discount'];
    $sales->shipping = $_POST['shipping'];
    $sales->c_paid = $_POST['c_paid'];
    $sales->due = $_POST['due'];
    $sales->status = $_POST['status'];
    $sales->remark = $_POST['remark'];
    $sales->total = $_POST['total'];
    $sales->salesman = $_POST['salesman'];
    $sales->courier_id = $_POST['courier_id'];

    // Start transaction
    $db->begin_transaction();

    try {
        if ($sales->updateSale()) {
            // Update success
            $db->commit();
            echo "<div class='alert alert-success'>Sale was updated successfully.</div>";
        } else {
            // Update failed
            $db->rollback();
            echo "<div class='alert alert-danger'>Unable to update sale.</div>";
        }
    } catch (Exception $e) {
        // Rollback on error
        $db->rollback();
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>
<html lang="en"> <?php include "include/head.php"; ?> <body class="sb-nav-fixed"> <?php
 include "include/nav.php";
 include "include/sidebar.php";
 include "modal/addpro.php";
 ?>
 <link href 	= "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<style>  
        .sb-topnav .navbar-brand {
              
              height: 57px;
          
              padding-top: 0.4rem;
          
              background: #ffffff;
          
              color: #0062cc;
          
            }
              .das {display:none;}
              
              .form-group {
                  margin-bottom: 0.7rem;  
            }
            .RFtable tr:nth-child(odd) {
                border: none;
                border: none;
                background: rgb(255 255 255 / 10%);
            }
            .page-title {
                border-right: 5px solid #ffffff;
                border-left: 5px solid #ffffff;
                
            }
            .input-group-text {
            
                font-size: 0.8rem;
              
            }
    </style>
            <!--Close Modal Add Product-->
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-9">
            <div class="mt-4 page-title mb-2">
              <div class="row">
                <div class="col-md-9 my-auto"> Sales <i class="fas fa-angle-right"></i> New Sale </div>
                <div class="col-md-3 text-right"> <button type="button" class="btn btn-light "><a href="sales-history">Sales History</a></button>    </div>
              </div>
            </div>
            <form class="calculate" id="addsaleForm" >
              <div class="card mb-1">
                    <!-- topbar for working Customer -->
                    <div id="0" class="report card mb-1" style="display: none; background:lightblue">
                      <div class="card-body p-2">
                        <div class="row">
                          <div class="col-md-9">
                            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile" />
                            <div class="result-box col-md-12 search-result" id="results"></div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- New user input fields, initially hidden -->
                    <div id="new-user-fields" style="display:none; background:lightblue" class="card mb-1">
                      <div class="card-body p-2">
                        <div class="row">
                          <div class="col-md-4">
                            <input type="text" name="new-name" id="new-name" class="form-control" placeholder="Name" />
                          </div>
                          <div class="col-md-4">
                            <input type="text" name="address" id="new-email" class="form-control" placeholder="Address" />
                          </div>
                          <div class="col-md-4">
                            <button id="save-new-user" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card-header">
                    <div class="row">
                      <div class="col-md-4">
                        <select class="form-control js-select2"  name="customer_id" id="customer_id" required>
                          <option value=""> Select Customer </option>
                          <option value="0"> Walking Customer </option>
                        </select>
                      </div>
                      <div class="col-md-4">
                      <select id="courier_id" class="form-control js-select2" name="courier_id" required>
                        <option>Choose courier</option> 
                      </select>
                      </div>
                      <div class="col-md-4">
                      <button id="porder" class="btn btn-primary" type="button">Order</button>
                      </div>
                    </div>
                  </div>

                <div class="card-body p-2 bsection ">
                    <div class="row">
                    <div class="col-md-9">
                    <input type="text" autofocus class="searchcode add form-control" style="background: lavenderblush;" name="searchcode" id="search" placeholder="Search the Product">
                      <div class="result-box col-md-12 search-result" id="result"></div>
                  </div>
                      <div class="col-md-3">
                        <button type="button" id="add" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">Add Product</button>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card mb-1 " style=" background: #fff;">
                <div class="p-0 card-body" >
                  <div class="table-responsive">
                    <table width="100%" cellpadding="0" cellspacing="0"   class="RFtable" >
                      <thead>
                        <tr>
                          <th width="3%"><a type="button" class="delete-row"> <i class="fas fa-trash"></i></a></th>
                          <th width="5%" align="center">S/N</th>
                          <th width="15%" align="center">Barcode</th>
                          <th width="25%" align="left">Product Name</th>
                          <th width="5%" align="right">Qty.</th>
                          <th width="7%" align="right">Price</th>
                          <th width="7%" align="center">Discount</th>
                          <th width="9%" align="right">Total</th>
                        </tr>
                      </thead>
                      <tbody id="p_add_table"></tbody>
                    </table>
                </div>
                </div>
              </div>
              <div class="card mt-1 ">
                        <div class="pb-0 pt-3 card-body">
                          <div class="row">
                              <div class="col-md-5 form-group">
                                <label class="sr-only " for="total">Remark</label>
                                <div class="input-group mb-0 mr-sm-0 ">
                                    <div class="input-group-prepend ">
                                      <div class="input-group-text">Remark</div>
                                    </div>
                                    <input class="form-control"   type="text"  name="remark">
                                </div>
                              </div>
                      
                        
                  
                      <div class="col-md-3 form-group">
                            
                                <div class="input-group mb-0 mr-sm-0 ">
                                    <div class="input-group-prepend ">
                                      <div class="input-group-text">Sales Man</div>
                                    </div>
                                    <select class="form-control"  name="salesman">
                              <option value="">Sales Man</option>
                              <option value='1'> Hannan Farid  </option>
                              <option value='2'> ANISUR RAHMAN  </option>               </select>
                                </div>
                              </div>
                      
                      
                    <div class="col-md-1 ">
                  
                    <div class="form-check" style="margin-top: 6px;">
                        <input class="form-check-input" type="checkbox" checked name="send_sms" value="0" id="send_sms">
                        <label class="form-check-label" for="send_sms">
                          SMS
                        </label>
                      </div>
                          </div>
                    
                    
                      
                          </div>
                        </div>
                    </div>
              </div>
              <!-- Start Calculation--->
              <div class="col-md-3">
                <div class="card mt-4 calculate">

              
                  <div class="card-body mb-1">
                    <div class="row ">
                      <div class="col-md-12 form-group">
                        <label class="sr-only " for="total">Total</label>
                        <div class="input-group mb-0 mr-sm-0 ">
                          <div class="input-group-prepend ">
                            <div class="input-group-text" style="width: 100px;">Total</div>
                          </div>
                          <input class="form-control text-success text-right font-weight-bold h6 total" readonly type="text" id="total" name="total" >
                        </div>
                      </div>          
                
                      <div class="col-md-12 form-group">
                        <label class="sr-only" for="discount">Discount %</label>
                        <div class="input-group mb-0 mr-sm-0">
                            <div class="input-group-prepend">
                              <div class="input-group-text" style="width: 100px;">Discount %</div>
                            </div>
                            <input class="form-control text-success text-right font-weight-bold discount" autocomplete="off"   type="text" id="discount" name="discount" value="<?php echo $sale['discount']; ?>">
                          <input class="form-control text-success text-right font-weight-bold less" style=" margin-left: 5px; border-radius: 6px; "  placeholder="Less" autocomplete="off"   type="text" id="less" name="less" >

                          </div>
                      </div>     
                  
                      <div class="col-md-12 form-group">
                        <label class="sr-only" for="shipping">Shipping</label>
                        <div class="input-group mb-0 mr-sm-0">
                          <div class="input-group-prepend">
                            <div class="input-group-text" style="width: 100px;">Shipping</div>
                          </div>
                          <input class="form-control text-success text-right font-weight-bold shipping" autocomplete="off"  type="text" id="shipping" name="shipping" value="<?php echo $sale['shipping']; ?>">
                        </div>
                      </div>
                  
                      <div class="col-md-12 form-group">
                        <label class="sr-only" for="payable">Payable</label>
                        <div class="input-group mb-0 mr-sm-0">
                          <div class="input-group-prepend">
                            <div class="input-group-text" style="width: 100px;">Payable</div>
                          </div>
                          <input class="form-control text-success text-right font-weight-bold payable"  readonly  type="text" id="payable" name="payable">
                        </div>
                      </div>
                      <div class="col-md-12 form-group">
                        <label class="sr-only" for="cash_paid">Cash Paid</label>
                        <div class="input-group mb-0 mr-sm-0">
                          <div class="input-group-prepend">
                            <div class="input-group-text" style="width: 100px;">Cash Paid</div>
                          </div>
                          <input class="form-control text-success text-right font-weight-bold cash_paid" type="text" id="paid" name="paid" value="<?php echo $sale['c_paid']; ?>">
                        </div>
                      </div>
                      <div class="col-md-12 form-group">
                        <label class="sr-only" for="due">Due</label>
                        <div class="input-group mb-0 mr-sm-0">
                          <div class="input-group-prepend">
                            <div class="input-group-text" style="width: 100px;">Due</div>
                          </div>
                          <input class="form-control text-danger text-right font-weight-bold due" readonly  type="text" id="due" name="due" value="<?php echo $sale['due']; ?>">
                        </div>
                      </div>
                      <div class="col-md-12 form-group">
                          <label class="sr-only" for="previous_due">Previous Due</label>
                          <div class="input-group mb-0 mr-sm-0">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="width: 100px;">Pre Due</div>
                            </div>
                            <input class="form-control text-danger text-right font-weight-bold balance" readonly  type="text" id="previous_due" name="previous_due">
                          </div>
                      </div> 
                      <div class="col-md-12 form-group">
                          <label class="sr-only" for="due">Balance</label>
                          <div class="input-group mb-0 mr-sm-0">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="width: 100px;">Balance</div>
                            </div>
                            <input class="form-control text-danger text-right font-weight-bold balance" readonly  type="text" id="balance" name="arrear">
                          </div>
                      </div> 

                  
                
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-primary add btn-block lidl save"  id="addsaleBtn"> Save </button>
                  </div>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
  </main>
 
</div>

<!-- Modal for displaying orders -->
<div class="modal fade" id="salesHistoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Sales History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pending Invoice</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Completed</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-4" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <ul id="pendingInvoices"></ul>
                    </div>
                    <div class="tab-pane fade p-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <ul id="completedInvoices"></ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script src="../assets/plugin/chart/chart-bar-demo.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="../assets/plugin/chart/datatables-demo.js"></script>


<script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js'></script>
<script src="../assets/plugin/select2/dist/script.js"></script>


<script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/4.0.6/sweetalert2.min.js'></script>
<script  src="../assets/plugin/htmlsweetalert/dist/script.js"></script>
			   

<script src="../assets/js/shortcut.js"></script>

<!-- Serach customer using Mobile number -->
<script>
        $(document).ready(function() {
            // Function to get URL parameter by name
            function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, '\\$&');
                var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
            }

            // Fetch uniqueid from URL
            var uniqueid = getParameterByName('uniqueid');

            // If uniqueid is present, fetch sales data via AJAX
            if (uniqueid) {
                $.ajax({
                    url: 'get_sales_data.php',
                    method: 'GET',
                    data: { uniqueid: uniqueid },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            let salesData = response.data;
                            let salesTableBody = $('#p_add_table');

                            salesData.forEach((product, index) => {
                                // Check if product already exists in the table
                                let existingRow = salesTableBody.find(`tr[data-product-id="${product.product_id}"]`);

                                if (existingRow.length > 0) {
                                    // Increment quantity if product exists
                                    let qtyInput = existingRow.find('input[name="qty[]"]');
                                    let newQty = parseInt(qtyInput.val()) + parseInt(product.qty); // Increase by fetched quantity
                                    qtyInput.val(newQty);
                                } else {
                                    // Add new row if product does not exist
                                    let row = `
                                        <tr class="productRow" data-product-id="${product.product_id}">
                                            <td style='text-align: center'>
                                                <div class="deleteBtn" data-product-id="${product.product_id}">
                                                    <i class="fa fa-trash"></i>
                                                </div>
                                            </td>
                                            <td class="serial-number">${salesTableBody.children().length + 1}</td>
                                            <input type='hidden' readonly value='${product.product_id}' name='product_id[]' class='table_input'>
                                            <td><input type='text' readonly value='${product.barcode}' name='product_barcode[]' class='table_input'></td>
                                            <td><input type='text' readonly value='${product.pname}' name='product_name[]' class='table_input'></td>
                                            <td><input type='number' value='${product.qty}' min="1" name='qty[]' class='table_input_number qty'></td>
                                            <td><input type='number' readonly min="1" value='${product.price}' name='sale[]' class='table_input_number sale'></td>
                                            <td><input type='number' value='${product.discount}' name='discount[]' class='table_input_number discount'></td>
                                            <td><input type='number' readonly value='${product.total}' name='sub_buy[]' readonly class='table_input_number sub_buy'></td>
                                        </tr>`;
                                    salesTableBody.append(row);
                                }
                            });

                            add_calcualte();
                            updateSerialNumbers();
                        } else {
                            console.error('Error:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.error('Response Text:', xhr.responseText);
                    }
                });
            }

            // Function to calculate totals
            function add_calcualte() {
                var grandTotal = 0;
                $("input[name='qty[]']").each(function(index) {
                    var qty = $(this).val(); // Get quantity value
                    var buy = $(this).closest('tr').find("input[name='sale[]']").val(); // Get sale price from the same row
                    var discount = $(this).closest('tr').find("input[name='discount[]']").val(); // Get discount from the same row

                    // Calculate total for this product
                    var total = parseFloat(qty) * parseFloat(buy) - parseFloat(discount);
                    $(this).closest('tr').find("input[name='sub_buy[]']").val(total.toFixed(2)); // Set subtotal in the same row

                    grandTotal += total; // Accumulate total for all products
                });

                // Update other calculated fields
                var commission = +$("#discount").val() || 0;
                var shipping = +$("#shipping").val() || 0;
                var paid = +$("#paid").val() || 0;
                var predue = +$("#previous_due").val() || 0;

                $('#sub_total').val(grandTotal.toFixed(2));
                $('#total').val((grandTotal - commission + shipping).toFixed(2));
                $('#due').val((grandTotal - commission + shipping - paid + predue).toFixed(2));
                $('#payable').val((grandTotal - commission + shipping).toFixed(2));
            }

            // Function to update serial numbers
            function updateSerialNumbers() {
                $('#p_add_table tr').each(function(index) {
                    $(this).find('.serial-number').text(index + 1);
                });
            }

            // Search for products
            $('#search').on('input', function() {
                let query = $(this).val();
                if (query.length > 2) {
                    $.ajax({
                        url: 'search_product.php',
                        method: 'GET',
                        data: { query: query },
                        dataType: 'json',
                        success: function(response) {
                            let resultBox = $('#result');
                            resultBox.html('');
                            if (response.products && response.products.length > 0) {
                                response.products.forEach(product => {
                                    resultBox.append(`<li class="search-result-item" data-product='${JSON.stringify(product)}'>${product.name}</li>`);
                                });
                                resultBox.show();
                            } else {
                                resultBox.append('<li>No results found</li>');
                                resultBox.show();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            console.error('Response Text:', xhr.responseText);
                        }
                    });
                } else {
                    $('#result').html('').hide();
                }
            });

            // Add product to sales table from search results
            $('#result').on('click', '.search-result-item', function() {
                let product = $(this).data('product');

                // Check if product already exists in the table
                let existingRow = $(`#p_add_table tr[data-product-id="${product.id}"]`);
                if (existingRow.length > 0) {
                    // Increment quantity if product exists
                    let qtyInput = existingRow.find('input[name="qty[]"]');
                    let newQty = parseInt(qtyInput.val()) + 1;
                    qtyInput.val(newQty);
                } else {
                    // Add new row if product does not exist
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
                            <td><input type='text' readonly value='${product.name}' name='product_name[]' class='table_input'></td>
                            <td><input type='number' value='1' min="1" name='qty[]' class='table_input_number qty'></td>
                            <td><input type='number' readonly min="1" value='${product.retail_price}' name='sale[]' class='table_input_number sale'></td>
                            <td><input type='number' value='0' name='discount[]' class='table_input_number discount'></td>
                            <td><input type='number' readonly value='' name='sub_buy[]' readonly class='table_input_number sub_buy'></td>
                        </tr>`;
                    $('#p_add_table').append(row);
                }

                $('#result').html('').hide();
                $('#search').val('');
                add_calcualte();
                updateSerialNumbers();
            });

            // Delete product row from the sales table
            $(document).on('click', '.deleteBtn', function() {
                $(this).closest('tr').remove();
                add_calcualte();
                updateSerialNumbers();
            });

            // Calculate totals on quantity or discount change
            $(document).on('keyup change', 'input[name="qty[]"], input[name="discount[]"]', function() {
                add_calcualte();
            });
        });
    </script>
<script>
        $(document).ready(function() {
            let salesHistory = null; // Variable to store sales history data

            // Search for customers
            $('#mobile').on('input', function() {
                let query = $(this).val();
                if (query.length > 2) {
                    $.ajax({
                        url: 'search_mobile.php',
                        method: 'GET',
                        data: { query: query },
                        dataType: 'json',
                        success: function(response) {
                            console.log('Response:', response); 
                            let resultBox = $('#results');
                            resultBox.html('');
                            if(response.mobiles && response.mobiles.length > 0) {
                                response.mobiles.forEach(mobile => {
                                    resultBox.append(`<li class="search-result-item" data-mobile='${JSON.stringify(mobile)}'>${mobile.name}</li>`);
                                });
                                $('#new-user-fields').hide();
                            } else {
                                resultBox.append('<li>No results found</li>');
                                $('#new-user-fields').show();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            console.error('Response Text:', xhr.responseText);
                        }
                    });
                } else {
                    $('#results').html('');
                    $('#new-user-fields').hide();
                }
            });

            // Select customer from search results
            $('#results').on('click', '.search-result-item', function() {
                let mobile = $(this).data('mobile');
                console.log('Selected Customer:', mobile);

                // Set the customer_id select field to the selected customer
                $('#customer_id').html(`<option value="${mobile.id}">${mobile.name}</option>`);

                // Hide the search box and search results
                $('#0').hide();
                $('#results').html('');

                // Fetch sales report for the selected customer
                fetchSalesReport(mobile.id);
            });

            // Select customer from dropdown
            $('#customer_id').on('change', function() {
                let customerId = $(this).val();
                if (customerId == "0") {
                    $('#0').show();
                    $('#porder').text('Orders');
                } else {
                    $('#0').hide();
                    fetchSalesReport(customerId);
                }
            });

            // Fetch sales report for the selected customer
            function fetchSalesReport(customerId) {
                $.ajax({
                    url: 'get_sales_report.php',
                    method: 'GET',
                    data: { customer_id: customerId },
                    dataType: 'json',
                    success: function(response) {
                        console.log('Sales Report:', response);
                        salesHistory = response; // Store sales history data

                        // Update order button with count of orders
                        let orderCount = response.pending.length + response.completed.length;
                        $('#porder').text(`Orders (${orderCount})`).data('sales-history', response);

                        $('#result').html('');
                        $('#search').val('');
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.error('Response Text:', xhr.responseText);
                    }
                });
            }

            // Save new user
            $('#save-new-user').on('click', function() {
                let name = $('#new-name').val();
                let address = $('#new-email').val();
                let mobile = $('#mobile').val();

                if(name && address && mobile) {
                    $.ajax({
                        url: 'add_temp_user.php',
                        method: 'POST',
                        data: { name: name, address: address, mobile: mobile },
                        dataType: 'json',
                        success: function(response) {
                            if(response.success) {
                                alert('Temporary user added successfully!');
                                $('#new-user-fields').hide();
                                $('#mobile').val('');
                                $('#results').html('');
                            } else {
                                alert('Error adding temporary user.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            console.error('Response Text:', xhr.responseText);
                        }
                    });
                } else {
                    alert('Please fill in all fields.');
                }
            });

            // Show sales history modal when order button is clicked
            $('#porder').on('click', function() {
                let salesHistory = $(this).data('sales-history');

                let pendingInvoicesList = $('#pendingInvoices');
                let completedInvoicesList = $('#completedInvoices');
                pendingInvoicesList.html('');
                completedInvoicesList.html('');

                if (salesHistory) {
                    let pendingInvoices = '';
                    let completedInvoices = '';

                    if (salesHistory.pending && salesHistory.pending.length > 0) {
                        salesHistory.pending.forEach(invoice => {
                            pendingInvoices += `
                                <li>
                                    Invoice#: ${invoice.invoice_no} | Customer Name: ${invoice.customer_name} | Total: ${invoice.total} | Paid: ${invoice.paid}
                                    <span style="float: right;">
                                        <a class="btn btn-info btn-sm" href="view_sale_invoice.php?uniqueid=${invoice.uniqueid}" target="_blank"><i class="fa fa-print"></i></a>
                                        <a class="btn btn-warning btn-sm edit-invoice" href="edit_sale_invoice.php?uniqueid=${invoice.uniqueid}" data-uniqueid="${invoice.uniqueid}" data-type="pending"><i class="fa fa-edit"></i></a>
                                    </span>
                                    <hr>
                                </li>
                            `;
                        });
                    } else {
                        pendingInvoices = '<li>No pending invoices</li>';
                    }

                    if (salesHistory.completed && salesHistory.completed.length > 0) {
                        salesHistory.completed.forEach(invoice => {
                            completedInvoices += `
                                <li>
                                    Invoice#: ${invoice.invoice_no} | Customer Name: ${invoice.customer_name} | Total: ${invoice.total} | Paid: ${invoice.paid}
                                    <span style="float: right;">
                                        <a class="btn btn-info btn-sm" href="view_sale_invoice.php?uniqueid=${invoice.uniqueid}" target="_blank"><i class="fa fa-print"></i></a>
                                    </span>
                                    <hr>
                                </li>
                            `;
                        });
                    } else {
                        completedInvoices = '<li>No completed invoices</li>';
                    }

                    pendingInvoicesList.append(pendingInvoices);
                    completedInvoicesList.append(completedInvoices);
                }

                $('#salesHistoryModal').modal('show');
            });

            // Load couriers and customers on page load
            $.ajax({
                url: 'courier.php',
                type: 'GET',
                success: function(data) {
                    $('#courier_id').append(data);
                }
            });

            $.ajax({
                url: 'customer.php',
                type: 'GET',
                success: function(data) {
                    $('#customer_id').append(data);
                }
            });

            $('#customer_id').on('change', function() {
                let customerId = $(this).val();
                if (customerId) {
                    $.ajax({
                        url: 'customer.php',
                        type: 'GET',
                        data: { customer_id: customerId },
                        success: function(data) {
                            let parsedData = JSON.parse(data);
                            $('#previous_due').val(parsedData.previous_due);
                            $('#balance').val(parsedData.balance);
                            add_calcualte();
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            console.error('Response Text:', xhr.responseText);
                        }
                    });
                } else {
                    $('#balance').val('');
                }
            });

            // Fetch data from URL if uniqueid is present
            const urlParams = new URLSearchParams(window.location.search);
            const uniqueid = urlParams.get('uniqueid');
            if (uniqueid) {
                fetchCustomerAndCourierData(uniqueid);
            }

            function fetchCustomerAndCourierData(uniqueid) {
            $.ajax({
                url: 'get_customer_courier.php',
                method: 'GET',
                data: { uniqueid: uniqueid },
                dataType: 'json',
                success: function(response) {
                    console.log('Customer and Courier Data:', response);
                    if (response.customer) {
                        $('#customer_id').html(`<option value="${response.customer.id}">${response.customer.name}</option>`);
                        $('#previous_due').val(response.customer.previous_due);
                        $('#balance').val(response.customer.balance);

                        fetchSalesReport(response.customer.id);
                        add_calcualte(); // Assuming this function recalculates totals
                    }
                    if (response.courier) {
                        $('#courier_id').html(`<option value="${response.courier.id}">${response.courier.name}</option>`);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.error('Response Text:', xhr.responseText);
                }
            });
        }


            // Calculate totals
            function add_calcualte() {
                var grandTotal = 0;
                $("input[name='qty[]']").each(function (index) {
                    var qty = $("input[name='qty[]']").eq(index).val();
                    var buy = $("input[name='sale[]']").eq(index).val();
                    var output = parseFloat(parseFloat(qty) * parseFloat(buy)).toFixed(2);
                    if (!isNaN(output)) {
                        $("input[name='sub_buy[]']").eq(index).val(output);
                        grandTotal = parseFloat(parseFloat(grandTotal) + parseFloat(output)).toFixed(2);

                        var commission = +$("#discount").val() || 0;
                        var shipping = +$("#shipping").val() || 0;
                        var paid = +$("#paid").val() || 0;
                        var predue = +$("#previous_due").val() || 0;

                        $('#sub_total').val(grandTotal);
                        $('#total').val(grandTotal - commission + shipping);
                        $('#due').val(grandTotal - commission + shipping - paid + predue);
                        $('#payable').val(grandTotal - commission + shipping);
                    }
                });
            }

            // Function to update serial numbers
            function updateSerialNumbers() {
                $('#p_add_table tr').each(function(index) {
                    $(this).find('.serial-number').text(index + 1);
                });
            }

            // Change Calculate Value
            $(document).on('keyup change', '.calculate', function () {
                add_calcualte();
            });

            // Delete product row from the table
            $(document).on('click', '.deleteBtn', function() {
                $(this).closest('tr').remove();
                add_calcualte();
                updateSerialNumbers();
            });
        });
        // Fetch sales report for the selected customer
    function fetchSalesReport(customerId) {
        $.ajax({
            url: 'get_sales_report.php',
            method: 'GET',
            data: { customer_id: customerId },
            dataType: 'json',
            success: function(response) {
                console.log('Sales Report:', response);
                salesHistory = response; // Store sales history data

                // Update order button with count of orders
                let orderCount = response.pending.length + response.completed.length;
                $('#porder').text(`Orders (${orderCount})`).data('sales-history', response);

                $('#result').html('');
                $('#search').val('');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.error('Response Text:', xhr.responseText);
            }
        });
    }
    $('#save-new-user').on('click', function() {
        let name = $('#new-name').val();
        let address = $('#new-email').val();
        let mobile = $('#mobile').val();

        if(name && address && mobile) {
            $.ajax({
                url: 'add_temp_user.php',
                method: 'POST',
                data: { name: name, address: address, mobile: mobile },
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        alert('Temporary user added successfully!');
                        $('#new-user-fields').hide();
                        $('#mobile').val('');
                        $('#results').html('');
                    } else {
                        alert('Error adding temporary user.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.error('Response Text:', xhr.responseText);
                }
            });
        } else {
            alert('Please fill in all fields.');
        }
    });

    $('#porder').on('click', function() {
        let salesHistory = $(this).data('sales-history');

        let pendingInvoicesList = $('#pendingInvoices');
        let completedInvoicesList = $('#completedInvoices');
        pendingInvoicesList.html('');
        completedInvoicesList.html('');

        if (salesHistory) {
            let pendingInvoices = '';
            let completedInvoices = '';

            if (salesHistory.pending && salesHistory.pending.length > 0) {
                salesHistory.pending.forEach(invoice => {
                    pendingInvoices += `
                        <li>
                            Invoice#: ${invoice.invoice_no} | Customer Name: ${invoice.customer_name} | Total: ${invoice.total} | Paid: ${invoice.paid}
                            <span style="float: right;">
                                <a class="btn btn-info btn-sm" href="view_sale_invoice.php?uniqueid=${invoice.uniqueid}" target="_blank"><i class="fa fa-print"></i></a>
                                <a class="btn btn-warning btn-sm edit-invoice" href="edit_sale_invoice.php?uniqueid=${invoice.uniqueid}" data-uniqueid="${invoice.uniqueid}" data-type="pending"><i class="fa fa-edit"></i></a>
                            </span>
                            <hr>
                        </li>
                    `;
                });
            } else {
                pendingInvoices = '<li>No pending invoices</li>';
            }

            if (salesHistory.completed && salesHistory.completed.length > 0) {
                salesHistory.completed.forEach(invoice => {
                    completedInvoices += `
                        <li>
                            Invoice#: ${invoice.invoice_no} | Customer Name: ${invoice.customer_name} | Total: ${invoice.total} | Paid: ${invoice.paid}
                            <span style="float: right;">
                                <a class="btn btn-info btn-sm" href="view_sale_invoice.php?uniqueid=${invoice.uniqueid}" target="_blank"><i class="fa fa-print"></i></a>
                            </span>
                            <hr>
                        </li>
                    `;
                });
            } else {
                completedInvoices = '<li>No completed invoices</li>';
            }

            pendingInvoicesList.append(pendingInvoices);
            completedInvoicesList.append(completedInvoices);
        }

        $('#salesHistoryModal').modal('show');
    });

    $.ajax({
        url: 'courier.php',
        type: 'GET',
        success: function(data) {
            $('#courier_id').append(data);
        }
    });

    $.ajax({
        url: 'customer.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.customers && data.customers.length > 0) {
                data.customers.forEach(function(customer) {
                    $('#customer_id').append(new Option(customer.name, customer.id));
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.error('Response Text:', xhr.responseText);
        }
    });

    // Fetch balance and previous due when customer is selected
    $('#customer_id').on('change', function() {
        let customerId = $(this).val();
        if (customerId) {
            $.ajax({
                url: 'customer.php',
                type: 'GET',
                data: { customer_id: customerId },
                dataType: 'json',
                success: function(data) {
                    if (data.balance !== undefined && data.previous_due !== undefined) {
                        $('#previous_due').val(data.previous_due);
                        $('#balance').val(data.balance);
                        add_calcualte();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.error('Response Text:', xhr.responseText);
                }
            });
        } else {
            $('#previous_due').val('');
            $('#balance').val('');
        }
    });

    const urlParams = new URLSearchParams(window.location.search);
    const uniqueid = urlParams.get('uniqueid');
    if (uniqueid) {
        fetchCustomerAndCourierData(uniqueid);
    }

    function fetchCustomerAndCourierData(uniqueid) {
        $.ajax({
            url: 'get_customer_courier.php',
            method: 'GET',
            data: { uniqueid: uniqueid },
            dataType: 'json',
            success: function(response) {
                console.log('Customer and Courier Data:', response);
                if (response.customer) {
                    $('#customer_id').html(`<option value="${response.customer.id}">${response.customer.name}</option>`);
                    fetchSalesReport(response.customer.id);
                }
                if (response.courier) {
                    $('#courier_id').html(`<option value="${response.courier.id}">${response.courier.name}</option>`);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.error('Response Text:', xhr.responseText);
            }
        });
    }

    function updateSerialNumbers() {
        $('#p_add_table tr').each(function(index) {
            $(this).find('.serial-number').text(index + 1);
        });
    }

     $('#discount, #shipping, #paid, #previous_due').on('input', function() {
        add_calcualte();
    });

    // Assuming you also want to re-calculate when qty or sale inputs change
    $(document).on('input', "input[name='qty[]'], input[name='sale[]']", function() {
        add_calcualte();
    });

    function add_calcualte() {
        var grandTotal = 0;
        $("input[name='qty[]']").each(function (index) {
            var qty = $("input[name='qty[]']").eq(index).val();
            var buy = $("input[name='sale[]']").eq(index).val();
            var output = parseFloat(parseFloat(qty) * parseFloat(buy)).toFixed(2);
            if (!isNaN(output)) {
                $("input[name='sub_buy[]']").eq(index).val(output);
                grandTotal = parseFloat(parseFloat(grandTotal) + parseFloat(output)).toFixed(2);
            }
        });

        var commission = +$("#discount").val() || 0;
        var shipping = +$("#shipping").val() || 0;
        var paid = +$("#paid").val() || 0;
        var predue = +$("#previous_due").val() || 0;

        $('#sub_total').val(grandTotal);
        $('#total').val(grandTotal - commission + shipping);
        $('#due').val(grandTotal - commission + shipping - paid + predue);
        $('#payable').val(grandTotal - commission + shipping - paid + predue);
    }

    // Initial calculation call
    add_calcualte();

    $(document).on('click', '.deleteBtn', function() {
        $(this).closest('tr').remove();
        add_calcualte();
    });
</script>
<script>
  $(document).ready(function() {
    $('#customer_id').change(function() {
      if ($(this).val() == '0') {
        $('#search').show();
        $('#add').hide();
        $('#0').show();
      } else {
        $('#search').show();
        $('#add').show();
        $('#0').hide();
      }
    });
  });
</script>
<script>
    $(document).ready(function() {
        $('#addsaleBtn').click(function() {
            var formData = new FormData($('#addsaleForm')[0]);

            // Log the form data to the console
            for (var pair of formData.entries()) {
                console.log(pair[0]+ ': ' + pair[1]);
            }

            $.ajax({
                url: 'sale.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
</body>
</html> ?>