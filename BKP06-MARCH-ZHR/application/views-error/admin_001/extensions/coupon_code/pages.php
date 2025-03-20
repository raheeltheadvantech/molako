<?php //include('header.php'); ?>

<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-ui.js'); ?>"></script>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	create_sortable();	
});
// Return a helper with preserved width of cells
var fixHelper = function(e, ui) {
	ui.children().each(function() {
		$(this).width($(this).width());
	});
	return ui;
};
function create_sortable()
{
	$('#pages').sortable({
		scroll: true,
		helper: fixHelper,
		axis: 'y',
		handle:'.handle',
		update: function(){
			save_sortable();
		}
	});	
	$('#pages').sortable('enable');
}

function save_sortable()
{
	serial=$('#pages').sortable('serialize')+'&<?php echo $this->security->get_csrf_token_name();?>=<?php echo $this->security->get_csrf_hash();?>';
	
	$.ajax({
		url:'<?php echo site_url($this->admin_url.'/'. $this->controller_dir.'/admin_pages/organize_pages');?>',
		type:'POST',
		data:serial
	});
}
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete');?>');
}
//]]>
</script>

<strong><?php echo lang('sort_pages')?></strong>


<?php echo form_open($this->admin_url.'/'. $this->controller_dir.'/pages/bulk_save.html', array('id'=>'bulk_form'));?>

<table class="table table-striped">
	<thead>
		<tr>
			<th><?php echo lang('sort');?></th>
            <th><?php echo lang('title');?></th>
            <th><?php ?>Show in Menu</th>
            <th><?php ?>Show in Footer</th>
			<th><span class="btn-group pull-right">
            	
                <?php if(count($pages)): ?>
                <button class="btn" href="#"><i class="icon-ok"></i> <?php echo lang('bulk_save');?></button>
                <?php endif; ?>
                
                <a class="btn btn-primary" href="<?php echo site_url($this->admin_url.'/'. $this->controller_dir.'/pages/add.html'); ?>">Add New Page</a>
				</span>
            </th>
		</tr>
	</thead>
	
	<?php echo (count($pages) < 1)?'<tr><td style="text-align:center;" colspan="4">'.'no item found'.'</td></tr>':''?>
	<?php if($pages):?>
	<tbody id="pages">
		
		<?php
		function page_loop($pages, $dash = '')
		{
			$CI =& get_instance();
			$url = $CI->admin_url.'/'. $CI->controller_dir.'/pages/';
			
			foreach($pages as $page)
			{?>
			<tr id="page-<?php echo $page->id;?>" class="mc_row">
				<td class="handle"><a class="btn" style="cursor:move"><span class="glyphicon glyphicon-move"></span></a></td>
                <td>
					<?php echo $dash.' '.$page->title; ?>
				</td>
				<td>
					<div class="btn-group pull-right">
					
					<?php
					 	$options = array(
			                  '1'	=> lang('enabled'),
			                  '0'	=> lang('disabled')
			                );
						
						echo form_dropdown('page['.$page->id.'][enabled]', $options, set_value('enabled',$page->enabled), 'class="span2"');
					?>
						<?php if(!empty($page->url)): ?>
							<a class="btn" href="<?php echo site_url($url.'edit.html?id='.$page->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
							<a class="btn" href="<?php echo $page->url;?>" target="_blank"><i class="icon-play-circle"></i> Follow</a>
						<?php else: ?>
							<a class="btn" href="<?php echo site_url($url.'edit.html?id='.$page->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
							<a class="btn" href="<?php echo site_url($page->slug); ?>" target="_blank"><i class="icon-play-circle"></i> ViewPage</a>
						<?php endif; ?>
						<a class="btn" href="<?php echo site_url($url.'delete.html?id='.$page->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> Del</a>
					</div>
				</td>
			</tr>
			<?php
			page_loop($page->children, $dash.'-');
			}
		}
		page_loop($pages);
		?>
	</tbody>
	<?php endif;?>
</table>
</form>

<?php //include('footer.php');
