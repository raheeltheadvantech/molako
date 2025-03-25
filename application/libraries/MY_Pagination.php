<?php
/* 
Slight adjustment to the create_links function
we have query strings enabled for paypal but we don't want to use them anywhere else in the cart
so this method is getting changed to make query strings only if it's configured to do so.
*/
class MY_Pagination extends CI_Pagination
{
	public $display_prev_link = true;
    public $display_next_link = true;
	private $start_page = 0;
	private $end_page = 0;
	public $offset = 0;
	
	
	function __construct($params = array())
	{
		parent::__construct($params);
		
		$config['first_link']		= 'First';
		$config['first_tag_open']	= '<li class="pagination-link first-li">';
		$config['first_tag_close']	= '</li>';
		$config['last_link']		= 'Last';
		$config['last_tag_open']	= '<li class=" pagination-link first-li-tag">';
		$config['last_tag_close']	= '</li>';
		
		$config['full_tag_open']	= '<div><ul class="tf-pagination-wrap tf-pagination-list">';
		$config['full_tag_close']	= '</ul></div>';
		$config['cur_tag_open']		= '<li class="active"><a class="pagination-link" href="javascript:void(0);">';
		$config['cur_tag_close']	= '</a></li>';
		
		$config['num_tag_open']		= '<li class="pagination-link">';
		$config['num_tag_close']	= '</li>';
		
		$config['prev_link']		= '<i class="fa fa-angle-left"></i> Pre';	//'&laquo;';
		$config['prev_tag_open']	= '<li class="pagination-link">';
		$config['prev_tag_close']	= '</li>';
		
		$config['next_link']		= 'Next <i class="fa fa-angle-right"></i>';		//'&raquo;';
		$config['next_tag_open']	= '<li>';
		$config['next_tag_close']	= '</li>';
		
		$params = array_merge($config, $params);
		
		$this->CI =& get_instance();
		$this->CI->load->language('pagination');
		foreach (array('first_link', 'next_link', 'prev_link', 'last_link') as $key)
		{
			if (($val = $this->CI->lang->line('pagination_'.$key)) !== FALSE)
			{
				$this->$key = $val;
			}
		}
		
		$this->initialize($params);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Generate the pagination links
	 *
	 * @access	public
	 * @return	string
	 */	
	function create_links()
	{
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
		   return '';
		}
		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);
		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
			return '';
		}
		// Determine the current page number.		
		$CI =& get_instance();
		
		if ($this->page_query_string === TRUE)
		{
			if ($CI->input->get($this->query_string_segment) != 0)
			{
				$this->cur_page = $CI->input->get($this->query_string_segment);
				
				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}
		else
		{
			if ($CI->uri->segment($this->uri_segment) != 0)
			{
				$this->cur_page = $CI->uri->segment($this->uri_segment);
				
				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}
		$this->num_links = (int)$this->num_links;
		
		if ($this->num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}
		
		if ( ! is_numeric($this->cur_page))
		{
			$this->cur_page = 0;
		}
		
		
		
		$ignore = array('code', 'sort', 'order', 'per_page', );
		$QS = '';
		$QSV = $CI->input->get(null, false);
		
		if(!empty($QSV)):
		$QS = array();
		foreach($QSV as $key=>$val)
		{
			if(in_array($key, $ignore))
			{
				continue;
			}
			
			if(is_array($val))
			{
				$Q1 = array();
				foreach($val as $key2=>$val2)
				{
					$Q1[] = $key2.'='.$val2;
				}
				
				$QS[] = implode('&', $Q1);
			}
			else
			{
				$QS[] = $key.'='.$val;
			}
			
			
		}
		
		//var_dump($QS);
		$QS = '';
		if(!empty($QS) and is_array($QS))
		{
			$QS = implode('&', $QS);
		}
		endif;
		
		
		
		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->cur_page > $this->total_rows)
		{
			$this->cur_page = ($num_pages - 1) * $this->per_page;
		}
		
		$uri_page_number = $this->cur_page;
		$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

		$this->start_page = $start;
		$this->end_page = $end;
		
		
		$get_sort	= '';
		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($this->page_query_string === TRUE)
		{
			$this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
			if(!empty($_GET['by']))
			{
				$get_sort	= '&by='.$_GET['by'];
			}
			
			if(!empty($QS))
			{
				$this->base_url = str_replace('per_page=', $QS, $this->base_url). '&per_page=';
			}
			 
		}
		else
		{
			$this->base_url = rtrim($this->base_url, '/') .'/';
			if(!empty($_GET['by']))
			{
				$get_sort	= '/?by='.$_GET['by'];
			}
		}
		
		
		
  		// And here we go...
		$output = '';
		
		// Render the "First" link
		if  ($this->cur_page > ($this->num_links + 1))
		{
			$i = 0;
			$output .= $this->first_tag_open.'<a href="'.$this->base_url.$i.$get_sort.'">'.$this->first_link.'</a>'.$this->first_tag_close;
		}
		// Render the "previous" link
		if  ($this->cur_page != 1)
		{
			$i = $uri_page_number - $this->per_page;
			//if ($i == 0) $i = '';
			$output .= $this->prev_tag_open.'<a href="'.$this->base_url.$i.$get_sort.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
		}
		elseif ($this->display_prev_link && $this->cur_page == 1) {
			$output .= $this->prev_tag_open.'<span>'.$this->prev_link.'</span>'.$this->next_tag_close;
		}
		
		// Write the digit links
		for ($loop = $start -1; $loop <= $end; $loop++)
		{
			$i = ($loop * $this->per_page) - $this->per_page;
					
			if ($i >= 0)
			{
				if ($this->cur_page == $loop)
				{
					$output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
				}
				else
				{
					//$n = ($i == 0) ? '' : $i;
					$n = ($i == 0) ? 0 : $i;
					$output .= $this->num_tag_open.'<a class="pagination-link" href="'.$this->base_url.$n.$get_sort.'">'.$loop.'</a>'.$this->num_tag_close;
				}
			}
		}
		// Render the "next" link
		if ($this->cur_page < $num_pages)
		{
			$output .= $this->next_tag_open.'<a class="pagination-link" href="'.$this->base_url.($this->cur_page * $this->per_page).$get_sort.'">'.$this->next_link.'</a>'.$this->next_tag_close;
		}
		elseif ($this->display_next_link && $this->cur_page >= $num_pages) {
            $output .= $this->next_tag_open.'<span>'.$this->next_link.'</span>'.$this->next_tag_close;
        }
		
		// Render the "Last" link
		if (($this->cur_page + $this->num_links) < $num_pages)
		{
			$i = (($num_pages * $this->per_page) - $this->per_page);
			$output .= $this->last_tag_open.'<a href="'.$this->base_url.$i.$get_sort.'">'.$this->last_link.'</a>'.$this->last_tag_close;
		}
		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);
		// Add the wrapper HTML if exists
		$output = $this->full_tag_open.$output.$this->full_tag_close;
		
		return $output;		
	}
	
	function create_links_html()
	{
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
		   return '';
		}
		
		$num_pages = ceil($this->total_rows / $this->per_page);
		if ($num_pages == 1)
		{
			return '';
		}
		
		$links_html = $this->create_links();
		if($links_html == '')
		{
			return false;
		}
		
		$full_total_found = $this->total_rows;
		$cur_page = $this->offset;
		$rows = $this->per_page;
		$per_page = $this->offset;
		
		$num_pages = ceil($full_total_found / $rows);
		if (!is_numeric($cur_page))
		{
			$cur_page = 0;
		}
		if ($cur_page > $full_total_found)
		{
			$cur_page = ($num_pages - 1) * $rows;
		}
		$cur_page = floor(($cur_page/$rows) + 1);
		
		$page_number 		= $cur_page;
		$total_pages 		= $num_pages;
		$page_from 			= $per_page == 0 ? 1 :intval($per_page)+1;
		$page_end 			= ($cur_page * $rows) > $full_total_found ? $full_total_found : ($cur_page * $rows);
		
		
		
		$html = '
		<div class="table-pagination">
			<div class="pull-left">
				<span>Showing <strong>'.number_format($page_from, 0).' to '.number_format($page_end, 0).' of '.number_format($this->total_rows, 0).'</strong> entries in '.number_format($total_pages, 0).' page(s).</span>
			</div>
			<div class="pull-right">
				<div class="leftbar">
						'.$links_html.'
				</div>
				<div class="rightbar">
					<label class="first">Go to page</label>
					<input type="text" class="form-control pagination-goto-input" placeholder="1" value="'.$this->cur_page.'">
					<label class="last pagination-goto">Go <i class="fas fa-caret-right"></i></label>
				</div>
			</div>
		</div>';
		
		
		$per_page = $this->CI->input->get('per_page');
		$url = str_replace('per_page='.$per_page, '', current_url());
		$url = rtrim($url, '&');
		
		//unset($_GET['per_page']);
		//$QS = http_build_query($_GET);

		$js = '
<script type="text/javascript">
$(document).ready(function(){
	
	var reload_pagination = function(){
		val = $(".pagination-goto-input").val();
		val = parseInt(val, 10);
		if(val < 1 || val > '.intval($total_pages).' || val == '.intval($this->cur_page).'){
			return false;
		}
		val = (val-1)*'.intval($this->per_page).';
		window.location = "'.$url.'&per_page="+val;
	};
	
	$(".pagination-goto-input").on("keyup", function (e) {
		if (e.keyCode === 13) {
			reload_pagination();
		}
	});
	
	$(".pagination-goto").click(function(){
		reload_pagination();
	});
});
</script>
		';
		
		return $html.$js;
	}
	
	function create_links_html2()
	{


	    if ($this->total_rows == 0 OR $this->per_page == 0)
		{
		   return '';
		}

		$num_pages = ceil($this->total_rows / $this->per_page);
       if ($num_pages == 1)
		{
			return '';
		}

		$links_html = $this->create_links();
		if($links_html == '')
		{
			return false;
		}

		$full_total_found = $this->total_rows;
		$cur_page = $this->offset;
		$rows = $this->per_page;
		$per_page = $this->offset;
		
		$num_pages = ceil($full_total_found / $rows);
		if (!is_numeric($cur_page))
		{
			$cur_page = 0;
		}
		if ($cur_page > $full_total_found)
		{
			$cur_page = ($num_pages - 1) * $rows;
		}
		$cur_page = floor(($cur_page/$rows) + 1);
		
		$page_number 		= $cur_page;
		$total_pages 		= $num_pages;
		$page_from 			= $per_page == 0 ? 1 : $per_page+1;
		$page_end 			= ($cur_page * $rows) > $full_total_found ? $full_total_found : ($cur_page * $rows);
		
		
		$html = '
			<div class="tf-pagination-wrap tf-pagination-list">
				'.$links_html.'
			</div>
			<div class="toolbar-amount"><span style="float: right; padding-top: 5px;">Showing <strong>'.number_format($page_from, 0).' to '.number_format($page_end, 0).' of '.number_format($this->total_rows, 0).'</strong> entries in '.number_format($total_pages, 0).' page(s).</span>
			</div>
		';
		
		
		$per_page = $this->CI->input->get('per_page');
		$url = str_replace('per_page='.$per_page, '', current_url());
		$url = rtrim($url, '&');
		
		//unset($_GET['per_page']);
		//$QS = http_build_query($_GET);

		$js = '
<script type="text/javascript">
$(document).ready(function(){
	
	var reload_pagination = function(){
		val = $(".pagination-goto-input").val();
		val = parseInt(val, 10);
		if(val < 1 || val > '.intval($total_pages).' || val == '.intval($this->cur_page).'){
			return false;
		}
		val = (val-1)*'.intval($this->per_page).';
		window.location = "'.$url.'&per_page="+val;
	};
	
	$(".pagination-goto-input").on("keyup", function (e) {
		if (e.keyCode === 13) {
			reload_pagination();
		}
	});
	
	$(".pagination-goto").click(function(){
		reload_pagination();
	});
});
</script>
		';
		
		return $html.$js;
	}
}
