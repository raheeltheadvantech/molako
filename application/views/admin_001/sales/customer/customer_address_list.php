<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="content-wrapper">
            <div class="page-header">
                <div class="pull-left">
                    <span><?php echo $page_header ?></span>
                </div>
                <div class="pull-right">
                    <a href="<?php echo $add_link; ?>" class="btn btn-primary">Add</a>
                    <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder . '/sales/customers.html'); ?>">Back</a>
                </div>
            </div><!-- Page Header -->
            <div class="custom-table">
                <!-- Table Meta -->
                <!-- Table Filter -->
                <div class="table-wrapper">
                    <div class="table-responsive table-cols">
                        <?php if(!empty($addresses)): ?>
                            <table class="table table-bordered">
                                <thead>
                                <tr role="row">
                                    <th>Address ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Company</th>
                                    <th>City</th>
                                    <th>Postcode</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php foreach ($addresses as $address): ?>
                                    <tr>
                                        <td><?php echo $address->address_id; ?></td>
                                        <td><?php echo $address->first_name; ?></td>
                                        <td><?php echo $address->last_name; ?></td>
                                        <td><?php echo $address->company; ?></td>
                                        <td><?php echo $address->city; ?></td>
                                        <td><?php echo $address->postcode; ?></td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn-view" data-cust-id="<?php echo $address->customer_id; ?>" data-id="<?php echo $address->address_id; ?>">Edit</a>
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
            window.location = '<?php echo site_url($this->admin_folder . '/sales/customers/address/edit.html?id=');?>' + $(this).data('id') + '&cust-id='+ $(this).data('cust-id');
        });

    });

</script>
