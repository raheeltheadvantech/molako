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
<div class="content-inner">
	<div class="col-lg-12">
        <div class="content-wrapper">
            <div class="page-heading">
                <div class="pull-left">
                    <span>Users Roles</span>
                </div>
                <div class="pull-right">
                    <a href="<?php echo base_url($this->admin_folder.'/users/roles/add.html') ?>" class="btn btn btn-primary" title="<?php echo 'Add Role';?>"><span><?php echo 'Add Role'?></span></a>
                </div>
            </div>
            <div class="custom-table">
                <?php echo form_open($this->admin_folder .'/users/roles.html', array('class'=>'form-inline'));?>
                <div class="leftbar">
                    <div class="custom-search" style="margin-bottom: 15px">
                        <input type="text" name="term" value="<?php echo $search; ?>" class="form-control input-filter" placeholder="Search Here..">
                        <button type="submit" class="btn btn-outline-blue">Search</button>
                        <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder.'/users/roles.html');?>">Reset</a>
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
                        <table class="table table-striped dataTable" <?php if(is_array($result) and sizeof($result) > 0 ):?>id="tabletools"<?php endif;?>>                            <thead>
                                <tr role="row">
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Permission</th>
                                    <th>Date Added</th>
                                    <th>Date MOdified</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <?php if(is_array($result) and sizeof($result) > 0 ):?>
                            <tbody>
                                <?php $index = 0;?>
                                <?php foreach( $result as $key=>$val ): ?>
                                <?php 
                                    $index++; 
                                    $class = 'even';
                                    if (($index % 2) == 1) $class = 'odd';
                                ?>
                                <tr role="row" class="<?php echo $class;?>">
                                    <td class="sorting_1"><?php echo $val->role_id;?></td>
                                    <td><?php echo $val->name;?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn-permission" data-id="<?php echo $val->role_id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                    <td><?php echo $val->date_added;?></td>
                                    <td><?php echo $val->date_modified;?></td>
                                    <td>
                                        <div class="actions-buttons">
                                            <a href="javascript:void(0);" class="btn-view" data-id="<?php echo $val->role_id; ?>">Edit</a> | 
                                            <a href="javascript:void(0);" class="btn-delete" data-id="<?php echo $val->role_id; ?>">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
							<?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <?php echo lang('Record Not FOund');?>
                                    </td>
                                </tr>
                            <?php endif;?>
                        </table>
                    </div>
                </div>
                   
            </div>
        </div>
    </div><!-- col-lg-12 -->
</div>


<script type="text/javascript">

    $(document).ready(function () {

        $('.btn-view').click(function () {
            window.location = '<?php echo site_url($this->admin_folder . '/users/roles/edit.html?id=');?>' + $(this).data('id');
        });
        $('.btn-permission').click(function () {
            window.location = '<?php echo site_url($this->admin_folder . '/users/roles/permission/edit.html?id=');?>' + $(this).data('id');
        });

        $('.btn-delete').click(function () {
            var x = confirm('Do you really want to delete this customer');
            if(x) {
                window.location = '<?php echo site_url($this->admin_folder . '/users/roles/delete.html?id=');?>' + $(this).data('id');
            }
        });

    });

</script>
