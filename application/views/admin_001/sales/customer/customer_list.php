<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$search = '';
if(!empty($term))
{
    $search_term = @json_decode($term);
    if(!empty($search_term) and is_object($search_term))
    {
        $search = $search_term->term;
    }
}
?>
<div class="row">
    <div class="col-xs-12">
        <div class="content-wrapper">
            <div class="page-header">
                <div class="pull-left">
                    <span><?php echo $page_header ?></span>
                </div>
                <div class="pull-right">
                    <a href="<?php echo $add_link; ?>" class="btn btn-primary">Add</a>
                </div>
            </div><!-- Page Header -->
            <div class="custom-table">
                <!-- Table Meta -->
                <!-- Table Filter -->
                <?php echo form_open($this->admin_folder .'/sales/customers.html', array('class'=>'form-inline'));?>
                <div class="leftbar">
                    <div class="custom-search" style="margin-bottom: 15px">
                        <input type="text" name="term" value="<?php echo $search; ?>" class="form-control input-filter" placeholder="Search Here..">
                        <select class="form-control text-left" id="is_enabled" name="is_enabled" style="width: 125px;">
                            <option value="-1">All</option>
                            <option value="1">Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                        <button type="submit" class="btn btn-outline-blue">Search</button>
                        <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder.'/sales/customers.html');?>">Reset</a>
                    </div>
                </div>
                <div class="rightbar hide">
                    <div class="entry-filter">
                        <label class="control-label">Enteries</label>
                        <select class="form-control">
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <?php echo form_close(); ?>

                <div class="table-wrapper">
                    <div class="table-responsive table-cols">
                        <?php if(!empty($customers)): ?>
                            <table class="table table-bordered">
                                <thead>
                                <tr role="row">
                                    <th><?php echo sort_url('Customer ID', 'customer_id', $this->admin_folder .'/'. $this->controller_dir .'/sales/customers.html');?></th>
                                    <th><?php echo sort_url('First name', 'first_name', $this->admin_folder .'/'. $this->controller_dir .'/sales/customers.html');?></th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date Added</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php foreach ($customers as $customer): ?>
                                    <tr>
                                    <tr role="row" id="tr-<?php echo $customer->customer_id;?>" class="<?php // echo $class;?> item-product" data-key="<?php echo $customer->customer_id;?>">
                                        <td><?php echo $customer->customer_id; ?></td>
                                        <td><?php echo $customer->first_name; ?></td>
                                        <td><?php echo $customer->last_name; ?></td>
                                        <td><?php echo $customer->email; ?></td>
                                        <td><?php echo $customer->phone; ?></td>
                                        <td><?php echo format_date($customer->date_added); ?></td>
                                        <td><?php echo $customer->is_enabled == 1 ? 'Enabled' : 'Disabled'; ?></td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn-view" data-id="<?php echo $customer->customer_id; ?>">Edit</a> |
                                            <a href="javascript:void(0);" class="btn-view-address" data-id="<?php echo $customer->customer_id; ?>">Addresses</a> |
<!--                                            <a href="javascript:void(0);" class="btn-view-orders" data-id="--><?php //echo $customer->customer_id; ?><!--">Orders</a> |-->
                                            <a href="javascript:void(0);" class="btn-delete" data-id="<?php echo $customer->customer_id; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table><!-- Table -->
                        <?php else : ?>
                            <div class="text-center alert alert-warning">No item found</div>
                        <?php endif; ?>

                    </div><!-- Table Responsive -->
                </div><!-- Table wrapper -->
            </div><!-- Custom Table -->

            <?php echo $this->pagination->create_links_html(); ?>

            <?php /*?>
                <div class="table-pagination">
                    <div class="pull-left">
                        <span>Showing <strong>1 to 5 of 49</strong> entries</span>
                    </div>
                    <div class="pull-right">
                        <div class="pagination">
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>
                </div>
				<?php */ ?>

            <!-- Table pagination -->

        </div><!-- Content Wrapper -->
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function () {

        $('.btn-view').click(function () {
            window.location = '<?php echo site_url($this->admin_folder . '/sales/customers/edit.html?id=');?>' + $(this).data('id');
        });
        $('.btn-view-address').click(function () {
            window.location = '<?php echo site_url($this->admin_folder . '/sales/customers/address_list.html?id=');?>' + $(this).data('id');
        });
        $('.btn-view-orders').click(function () {
            window.location = '<?php echo site_url($this->admin_folder . '/sales/orders.html?customer_id=');?>' + $(this).data('id');
        });
        $('.btn-delete').click(function () {
            var x = confirm('Do you really want to delete this customer');
            if(x) {
                window.location = '<?php echo site_url($this->admin_folder . '/sales/customers/delete.html?id=');?>' + $(this).data('id');
            }
        });

    });

</script>
