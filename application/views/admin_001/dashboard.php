<div class="content-inner" id="dashboard">
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <i class="pe-7f-cash"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text">Rs <span class="count"><?php echo $total_sales; ?></span></div>
                                <div class="stat-heading">Total Sales</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-2">
                            <i class="pe-7f-cart"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?php echo $total_orders; ?></span></div>
                                <div class="stat-heading">Total Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-4">
                            <i class="pe-7f-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?php echo $total_customers; ?></span></div>
                                <div class="stat-heading">Total Customers</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Sales Analytics</h4>
                </div>
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="pull-right" style="position: relative"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i> <i class="caret"></i></a>
                                        <ul id="range" class="dropdown-menu dropdown-menu-right" style="position: absolute">
                                            <li><a href="day">Day</a></li>
                                            <li><a href="week">Week</a></li>
                                            <li class="active"><a href="month">Month</a></li>
                                            <li><a href="year">Year</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="mb-3">Sales Analysis</h4>
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="card-body"></div>
            </div>
        </div>
    </div>




    <div class="orders">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Recent Orders </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th class="avatar">Order ID</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Date Added</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($latest_orders)): ?>
                                <?php foreach ($latest_orders as $order): ?>
                                <tr>
                                    <td class="text-right"><?php echo $order->order_id; ?></td>
                                    <td><?php echo $order->first_name .' '. $order->last_name ; ?></td>
                                    <td><?php echo $order->order_status_id; ?></td>
                                    <td><?php echo format_date($order->date_added); ?></td>
                                    <td class="text-right"><?php echo format_currency($order->total); ?></td>
                                    <td class="text-right"><a href="<?php echo site_url('admin/sales/orders/order-detail.html?id='. $order->order_id); ?>" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Most Viewed Products</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th style="width:140px">Part Number</th>
                                    <th style="width: 90px;">Total Views</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($most_viewed_products)): ?>
                                <?php foreach ($most_viewed_products as $key => $product): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><span class="name"><?php echo $product->product_name; ?></span> </td>
                                    <td><span class="product"><?php echo $product->sku; ?></span> </td>
                                    <td><span class="count"><?php echo $product->views; ?></span></td>
                                    <td class="text-right"><a href="<?php echo site_url('admin/catalog/product-edit.html?id='. $product->product_id); ?>" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Bestseller Products</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th style="width:140px">Part Number</th>
                                    <th style="width: 90px;">Total Sold</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($bestseller_products)): ?>
                                    <?php foreach ($bestseller_products as $key => $product): ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><span class="name"><?php echo $product->product_name; ?></span> </td>
                                            <td><span class="product"><?php echo $product->sku; ?></span> </td>
                                            <td><span class="count"><?php echo $product->total; ?></span></td>
                                            <td class="text-right"><a href="<?php echo site_url('admin/catalog/product-edit.html?id='. $product->product_id); ?>" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Recent Customers </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th class="serial">#</th>
                                    <th class="avatar">Customer Name</th>
                                    <th>Email</th>
                                    <th>Added Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($latest_customers)): ?>
                                    <?php foreach ($latest_customers as $key => $customer): ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><span class="name"><?php echo $customer->first_name .' '. $customer->last_name; ?></span> </td>
                                            <td><span class="email"><?php echo $customer->email; ?></span> </td>
                                            <td><span class="date_added"><?php echo format_date($customer->date_added); ?></span></td>
                                            <td class="text-right"><a href="<?php echo site_url('admin/sales/customers/edit.html?id='. $customer->customer_id); ?>" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Recent Contact Us Inquiries</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Added Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead> 
                                <tbody>
                                <?php if(!empty($latest_contact_us)): ?>
                                    <?php foreach ($latest_contact_us as $key => $contact_us): ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><span class="name"><?php echo $contact_us->name; ?></span> </td>
                                            <td><span class="email"><?php echo $contact_us->email; ?></span> </td>
                                            <td><span class="date_added"><?php echo format_date($contact_us->date_added); ?></span></td>
                                            <td class="text-right"><a href="<?php echo site_url('admin/support/contact/detail.html?id='. $contact_us->contact_us_id); ?>" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>


<script>
    // Counter Number
    $('.count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 3000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>

<script type="text/javascript"><!--

    var ctx = document.getElementById( "barChart" );
    ctx.height = 70;

    $('#range a').on('click', function(e) {
        e.preventDefault();

        $(this).parent().parent().find('li').removeClass('active');

        $(this).parent().addClass('active');

        $.ajax({
            type: 'get',
            url: '<?php echo site_url('admin/dashboard/chart.html'); ?>?range=' + $(this).attr('href'),
            dataType: 'json',
            success: function(json) {
                console.log(json);
                if (typeof json['order'] == 'undefined') { return false; }

                var label1 = [];
                var order = [];
                var customer = [];
                var xaxis = json.xaxis;
                var order_data = json.order.data;
                var customer_data = json.customer.data;

                for (var i=0; i<xaxis.length; i++){
                    label1.push(xaxis[i][1]);
                }

                for (var i=0; i<order_data.length; i++){
                    order.push(order_data[i][1]);
                }

                for (var i=0; i<customer_data.length; i++){
                    customer.push(customer_data[i][1]);
                }
                
                var myChart = new Chart( ctx, {
                    type: 'bar',
                    data: {
                        // labels: [ "01", "02", "03", "04", "05", "06", "07" ],
                        labels: label1,
                        datasets: [
                            {
                                label: "Order",
                                //data: [ 65, 59, 80, 81, 56, 55, 45 ],
                                data: order,
                                borderColor: "rgba(0, 194, 146, 0.9)",
                                borderWidth: "0",
                                backgroundColor: "rgba(0, 194, 146, 0.5)"
                            },
                            {
                                label: "Customer",
                                // data: [ 28, 48, 40, 19, 86, 27, 76 ],
                                data: customer,
                                borderColor: "rgba(0,0,0,0.09)",
                                borderWidth: "0",
                                backgroundColor: "rgba(0,0,0,0.07)"
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [ {
                                ticks: {
                                    beginAtZero: true
                                }
                            } ]
                        }
                    }
                } );
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $('#range .active a').trigger('click');
    //--></script>