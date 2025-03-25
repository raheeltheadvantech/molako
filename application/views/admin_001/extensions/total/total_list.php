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
    print_r($data['term']);die;
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
                    <!-- <a href="<?php echo $add_link; ?>" class="btn btn-primary">Add</a>  -->
                </div>
            </div><!-- Page Header -->
            <div class="custom-table">
                <!-- Table Meta -->
                <div class="table-meta">
                        <?php echo form_open($this->admin_folder .'/extensions/total.html', array('class'=>'form-inline'));?>
                        <div class="leftbar">
                            <div class="custom-search">
                                <input type="text" name="term" value="<?php echo $search; ?>" class="form-control input-filter" placeholder="Search Here.."> 
                                 
                                <button type="submit" class="btn btn-outline-blue">Search</button>
                                <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder.'/extensions/total.html');?>">Reset</a>
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
                    </div>
                <!-- Table Filter -->
                <div class="table-wrapper">
                    <div class="table-responsive table-cols">
                        <?php if(!empty($results)): ?>
                            <table class="table table-bordered">
                                <thead>
                                <tr role="row">
                                    <th><?php echo sort_url(' ID', 'total_id', $this->admin_folder .'/extensions/total.html');?></th>
                                    <th>Code</th>
                                    <th>Sort Order</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php foreach ($results as $p): ?>
                                    <tr>
                                    <tr role="row">
                                        <td><?php echo $p->total_id; ?></td>
                                        <td><?php echo $p->code; ?></td>
                                        <td><?php echo $p->sort_order; ?></td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn-view" data-id="<?php echo $p->total_id; ?>" data-url="<?php echo site_url($this->admin_folder . '/' . $this->controller_dir . '/total/edit.html?id=');?>">Edit</a>
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
            window.location = $(this).data('url') + $(this).data('id');
        });
    });
</script>
