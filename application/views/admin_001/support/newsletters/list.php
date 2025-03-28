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
            </div><!-- Page Header -->
            <div class="custom-table">
                <!-- Table Meta -->
                <!-- Table Filter -->
                <?php echo form_open($this->admin_folder .'/support/newsletters.html', array('class'=>'form-inline'));?>
                <div class="leftbar">
                    <div class="custom-search" style="margin-bottom: 15px">
                        <input type="text" name="term" value="<?php echo $search; ?>" class="form-control input-filter" placeholder="Search Here..">
                        <button type="submit" class="btn btn-outline-blue">Search</button>
                        <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder.'/support/newsletters.html');?>">Reset</a>
                    </div>
                </div>
                <div class="rightbar">
                    <div class="entry-filter">
                        <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder.'/support/newsletters/export-csv.html');?>">Export to CSV</a>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <div class="table-wrapper">
                    <div class="table-responsive table-cols">
                        <?php if(!empty($result)): ?>
                            <table class="table table-bordered">
                                <thead>
                                <tr role="row">
                                    <th><?php echo sort_url('ID', 'newsletter_id', $this->admin_folder .'/'. $this->controller_dir .'/support/newsletters.html');?></th>
                                    <th><?php echo sort_url('Name', 'name', $this->admin_folder .'/'. $this->controller_dir .'/support/newsletters.html');?></th>
                                    <th><?php echo sort_url('Email', 'email', $this->admin_folder .'/'. $this->controller_dir .'/support/newsletters.html');?></th>
                                    <th>Date Added</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php foreach ($result as $val): ?>
                                    <tr>
                                    <tr role="row" id="tr-<?php echo $val->newsletter_id;?>" class="<?php // echo $class;?> item-product" data-key="<?php echo $val->newsletter_id;?>">
                                        <td><?php echo $val->newsletter_id; ?></td>
                                        <td><?php echo $val->name; ?></td>
                                        <td><?php echo $val->email; ?></td>
                                        <td><?php echo format_date($val->date_added); ?></td>
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