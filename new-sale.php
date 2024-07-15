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
                          <input class="form-control text-success text-right font-weight-bold h6 total" readonly type="text" id="total" name="total">
                        </div>
                      </div>          
                
                      <div class="col-md-12 form-group">
                        <label class="sr-only" for="discount">Discount %</label>
                        <div class="input-group mb-0 mr-sm-0">
                            <div class="input-group-prepend">
                              <div class="input-group-text" style="width: 100px;">Discount %</div>
                            </div>
                            <input class="form-control text-success text-right font-weight-bold discount" autocomplete="off"   type="text" id="discount" name="discount" >
                          <input class="form-control text-success text-right font-weight-bold less" style=" margin-left: 5px; border-radius: 6px; "  placeholder="Less" autocomplete="off"   type="text" id="less" name="less" >

                          </div>
                      </div>     
                  
                      <div class="col-md-12 form-group">
                        <label class="sr-only" for="shipping">Shipping</label>
                        <div class="input-group mb-0 mr-sm-0">
                          <div class="input-group-prepend">
                            <div class="input-group-text" style="width: 100px;">Shipping</div>
                          </div>
                          <input class="form-control text-success text-right font-weight-bold shipping" autocomplete="off"  type="text" id="shipping" name="shipping">
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
                          <input class="form-control text-success text-right font-weight-bold cash_paid" type="text" id="paid" name="paid">
                        </div>
                      </div>
                      <div class="col-md-12 form-group">
                        <label class="sr-only" for="due">Due</label>
                        <div class="input-group mb-0 mr-sm-0">
                          <div class="input-group-prepend">
                            <div class="input-group-text" style="width: 100px;">Due</div>
                          </div>
                          <input class="form-control text-danger text-right font-weight-bold due" readonly  type="text" id="due" name="due">
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
                    <input type="hidden" id="status" name="status" value="">
                    <button type="button" id="addSaleBtn" data-status="1">Add Sale</button>
                    <button type="button" id="draftSaleBtn" data-status="2">Draft Sale</button>
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
    let salesHistory = null;

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
                    console.error('AJAX Error:', status, error);
                    console.error('Response Text:', xhr.responseText);
                }
            });
        } else {
            $('#result').html('');
        }
    });

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
                    <td><input type='number' value='1' min="1" name='qty[]' class='table_input_number qty'></td>
                    <td><input type='number' min="1" value='${product.retail_price}' name='sale[]' class='table_input_number sale'></td>
                    <td><input type='number' value='0' min="1" name='discount[]' class='table_input_number discount'></td>
                    
                    <td><input type='number' value='' name='sub_buy[]' readonly class='table_input_number sub_buy'></td>
                </tr>`;
            $('#p_add_table').append(row);
            updateSerialNumbers();
        }

        $('#result').html('');
        $('#search').val('');
        add_calcualte();
    });

    $(document).ready(function() {
    // Handle customer search input
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
                    if (response.mobiles && response.mobiles.length > 0) {
                        response.mobiles.forEach(mobile => {
                            resultBox.append(`<li class="search-result-item" data-mobile='${JSON.stringify(mobile)}'>${mobile.name}</li>`);
                        });
                        $('#new-user-fields').hide();
                    } else {
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

    // Handle customer selection from search results
    $('#results').on('click', '.search-result-item', function() {
        let mobile = $(this).data('mobile');
        console.log('Selected Customer:', mobile);

        // Fetch all customers and populate the dropdown
        $.ajax({
            url: 'customer.php',
            type: 'GET',
            success: function(data) {
                try {
                    let parsedData = JSON.parse(data);
                    let customerOptions = '';

                    // Create an option for the selected customer
                    customerOptions += `<option value="${mobile.id}" selected>${mobile.name}</option>`;

                    // Create options for other customers
                    parsedData.customers.forEach(customer => {
                        if (customer.id !== mobile.id) {
                            customerOptions += `<option value="${customer.id}">${customer.name}</option>`;
                        }
                    });

                    // Populate the dropdown with the options
                    $('#customer_id').html(customerOptions);

                    // Hide the default option if it exists
                    $('#default-option').hide();

                    // Set the customer's previous due and balance
                    let selectedCustomer = parsedData.customers.find(customer => customer.id === mobile.id);
                    $('#previous_due').val(selectedCustomer ? selectedCustomer.previous_due : 0);
                    $('#balance').val(selectedCustomer ? selectedCustomer.balance : 0);
                    add_calcualte();

                    // Hide the search results
                    $('#results').html('');
                    $('#mobile').val('');

                    // Fetch the sales report for the selected customer
                    fetchSalesReport(mobile.id);
                } catch (e) {
                    console.error('Parsing Error:', e);
                    console.error('Response Text:', data);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.error('Response Text:', xhr.responseText);
            }
        });
    });

    // Handle dropdown change event
    $('#customer_id').on('change', function() {
        let customerId = $(this).val();
        if (customerId == "0") {
            $('#0').show();
            $('#porder').text('Orders');
        } else {
            // Fetch the customer's previous due and balance when the customer is changed
            $.ajax({
                url: 'customer.php',
                type: 'GET',
                data: { customer_id: customerId },
                success: function(data) {
                    try {
                        let parsedData = JSON.parse(data);
                        $('#previous_due').val(parsedData.previous_due);
                        $('#balance').val(parsedData.balance);
                        add_calcualte();
                    } catch (e) {
                        console.error('Parsing Error:', e);
                        console.error('Response Text:', data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.error('Response Text:', xhr.responseText);
                }
            });

            fetchSalesReport(customerId);
        }
    });

    // Fetch the sales report for the selected customer
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

});
    $('#save-new-user').on('click', function() {
    let name = $('#new-name').val();
    let address = $('#new-email').val();
    let mobile = $('#mobile').val();

    if (name && address && mobile) {
        $.ajax({
            url: 'add_temp_user.php',
            method: 'POST',
            data: { name: name, address: address, mobile: mobile },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Temporary user added successfully!');
                    $('#new-user-fields').hide();
                    $('#mobile').val('');
                    $('#results').html('');

                    // // Automatically trigger a click event for the new user
                    // $('#results').append(`
                    //     <div class="search-result-item" data-mobile='${JSON.stringify({id: response.customer_id, name: name})}'>
                    //         ${name}
                    //     </div>
                    // `).find('.search-result-item').last().trigger('click');
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

// Handle search result item click
$('#results').on('click', '.search-result-item', function() {
    let mobileData = $(this).data('mobile');
    let mobile = typeof mobileData === 'string' ? JSON.parse(mobileData) : mobileData;
    console.log('Selected Customer:', mobile);

    // Fetch all customers and populate the dropdown
    $.ajax({
        url: 'customer.php',
        type: 'GET',
        success: function(data) {
            try {
                let parsedData = JSON.parse(data);
                let customerOptions = '';

                // Create an option for the selected customer
                customerOptions += `<option value="${mobile.id}" selected>${mobile.name}</option>`;

                // Create options for other customers
                parsedData.customers.forEach(customer => {
                    if (customer.id !== mobile.id) {
                        customerOptions += `<option value="${customer.id}">${customer.name}</option>`;
                    }
                });

                // Populate the dropdown with the options
                $('#customer_id').html(customerOptions);

                // Hide the default option if it exists
                $('#default-option').hide();

                // Set the customer's previous due and balance
                let selectedCustomer = parsedData.customers.find(customer => customer.id === mobile.id);
                $('#previous_due').val(selectedCustomer ? selectedCustomer.previous_due : 0);
                $('#balance').val(selectedCustomer ? selectedCustomer.balance : 0);
                add_calculate();

                // Hide the search results
                $('#results').html('');
                $('#mobile').val('');

                // Fetch the sales report for the selected customer
                fetchSalesReport(mobile.id);
            } catch (e) {
                console.error('Parsing Error:', e);
                console.error('Response Text:', data);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.error('Response Text:', xhr.responseText);
        }
    });
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
                                <a class="btn btn-info btn-sm" href="view_sale_invoice.php?uniqueid=${invoice.invoice_no}" target="_blank"><i class="fa fa-print"></i></a>
                                <a class="btn btn-warning btn-sm edit-invoice" href="edit_sale_invoice.php?uniqueid=${invoice.invoice_no}" data-uniqueid="${invoice.uniqueid}" data-type="pending"><i class="fa fa-edit"></i></a>
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
                                <a class="btn btn-info btn-sm" href="view_sale_invoice.php?uniqueid=${invoice.invoice_no}" target="_blank"><i class="fa fa-print"></i></a>
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
        // Update sale button click handler
        $('#addSaleBtn').on('click', function() {
            $('#status').val(1);
            submitForm();
        });

        // Draft sale button click handler
        $('#draftSaleBtn').on('click', function() {
            $('#status').val(2);
            submitForm();
        });

        // Function to submit form
        function submitForm() {
            var formData = $('#addsaleForm').serialize();

            $.ajax({
                url: 'sale.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    try {
                        var jsonResponse = JSON.parse(response);
                        if (jsonResponse.success) {
                            alert(jsonResponse.message);
                        } else {
                            alert('Error: ' + jsonResponse.message);
                        }
                    } catch (e) {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    });
</script>
</body>
</html> ?> ?>