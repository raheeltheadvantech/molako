<?php
class Admin_file_manager extends Admin_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('utf8_helper');
		define('DIR_IMAGE', './uploads');
		$this->lang->load('file_manager');
	}

	public function index() {

		if ($this->input->get('filter_name')) {
			$filter_name = rtrim(str_replace('*', '', $this->input->get('filter_name')), '/');
		} else {
			$filter_name = null;
		}

		// Make sure we have the correct directory
		if ($this->input->get('directory')) {
			$directory = rtrim(DIR_IMAGE . '/' . str_replace('*', '', $this->input->get('directory')), '/');
		} else {
			$directory = DIR_IMAGE . '/';
		}

		if ($this->input->get('page')) {
			$page = $this->input->get('page');
		} else {
			$page = 1;
		}

		$directories = array();
		$files = array();

		$data['images'] = array();


		$this->load->model('admin/tool/Admin_image_model');
		//if (substr(str_replace('\\', '/', realpath($directory . '/' . $filter_name)), 0, strlen(DIR_IMAGE . 'catalog')) == DIR_IMAGE . 'catalog') {
		//if (substr(str_replace('\\', '/', realpath($directory . '/' . $filter_name)), 0, strlen(DIR_IMAGE)) == DIR_IMAGE) {
		if(true)
		{
			// Get directories
			$directories = glob($directory . '/' . $filter_name . '*', GLOB_ONLYDIR);

			if (!$directories) {
				$directories = array();
			}

			// Get files
			$files = glob($directory . '/' . $filter_name . '*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);

			if (!$files) {
				$files = array();
			}
			
		}


		// Merge directories and files
		$images = array_merge($directories, $files);

		// Get total number of files and directories
		$image_total = count($images);

		// Split the array based on current page number and max number of items per page of 10
		$images = array_splice($images, ($page - 1) * 16, 16);

		foreach ($images as $image) {
			$name = str_split(basename($image), 14);

			if (is_dir($image)) {
				$url = '';

				if ($this->input->get('target')) {
					$url .= '&target=' . $this->input->get('target');
				}

				if ($this->input->get('thumb')) {
					$url .= '&thumb=' . $this->input->get('thumb');
				}

				if(!strpos($image, 'cache') && !strpos($image, 'wysiwyg')) {
					$data['images'][] = array(
						'thumb' => '',
						'name' => implode(' ', $name),
						'type' => 'directory',
						'path' => utf8_substr($image, utf8_strlen(DIR_IMAGE)),
						'href' => site_url($this->admin_url . '/tool/file_manager.html') . '?directory=' . urlencode(utf8_substr(trim($image), utf8_strlen(DIR_IMAGE) + 1)) . $url
					);
				}
				
			} elseif (is_file($image)) {
				$image = str_replace('//','/',$image);
				$thumb = site_url($this->resize_image($image, 100, 100));
				$data['images'][] = array(
					'thumb' => $thumb,
					'name'  => implode(' ', $name),
					'type'  => 'image',
					'path'  => utf8_substr($image, utf8_strlen(DIR_IMAGE)),
					'href'  => base_url() . utf8_substr($image, utf8_strlen(DIR_IMAGE) + 1)
				);
			}
		}

		$data['heading_title'] = lang('heading_title');

		$data['text_no_results'] = lang('text_no_results');
		$data['text_confirm'] = lang('text_confirm');

		$data['entry_search'] = lang('entry_search');
		$data['entry_folder'] = lang('entry_folder');

		$data['button_parent'] = lang('button_parent');
		$data['button_refresh']= lang('button_refresh');
		$data['button_upload'] = lang('button_upload');
		$data['button_folder'] = lang('button_folder');
		$data['button_delete'] = lang('button_delete');
		$data['button_search'] = lang('button_search');

		$data['token'] = '';

		if ($this->input->get('directory')) {
			$getDir = substr($this->input->get('directory'), 1);
			//$data['directory'] = urlencode($this->input->get('directory'));
			$data['directory'] = urlencode($getDir);
		} else {
			$data['directory'] = '';
		}

		if ($this->input->get('filter_name')) {
			$data['filter_name'] = $this->input->get('filter_name');
		} else {
			$data['filter_name'] = '';
		}

		// Return the target ID for the file manager to set the value
		if ($this->input->get('target')) {
			$data['target'] = $this->input->get('target');
		} else {
			$data['target'] = '';
		}

		// Return the thumbnail for the file manager to show a thumbnail
		if ($this->input->get('thumb')) {
			$data['thumb'] = $this->input->get('thumb');
		} else {
			$data['thumb'] = '';
		}

		// Parent
		$url = '?i=1';

		if ($this->input->get('directory')) {
			$pos = strrpos($this->input->get('directory'), '/');


			if ($pos) {
				$url .= '&directory=' . urlencode(substr($this->input->get('directory'), 0, $pos));
			}
		}

		if ($this->input->get('target')) {
			$url .= '&target=' . $this->input->get('target');
		}

		if ($this->input->get('thumb')) {
			$url .= '&thumb=' . $this->input->get('thumb');
		}

		$data['parent'] = site_url($this->admin_url.'/tool/file_manager.html' . $url);

		// Refresh
		$url = '?i=1';

		if ($this->input->get('directory')) {
			$url .= '&directory=' . urlencode($this->input->get('directory'));
		}

		if ($this->input->get('target')) {
			$url .= '&target=' . $this->input->get('target');
		}

		if ($this->input->get('thumb')) {
			$url .= '&thumb=' . $this->input->get('thumb');
		}

		//$data['refresh'] = $this->url->link('common/filemanager', 'token=' . $this->session->data['token'] . $url, true);
		$data['refresh'] = site_url($this->admin_url.'/tool/file_manager.html' . $url);

		$url = '?i=1';

		if ($this->input->get('directory')) {
			$url .= '&directory=' . urlencode(html_entity_decode($this->input->get('directory'), ENT_QUOTES, 'UTF-8'));
		}

		if ($this->input->get('filter_name')) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->input->get('filter_name'), ENT_QUOTES, 'UTF-8'));
		}

		if ($this->input->get('target')) {
			$url .= '&target=' . $this->input->get('target');
		}

		if ($this->input->get('thumb')) {
			$url .= '&thumb=' . $this->input->get('thumb');
		}

		$url .='$page='. $page;

		$config['base_url']	= site_url($this->admin_folder .'/tool/file_manager.html'. $url);

		$config['total_rows']			= $image_total;
		$config['per_page']				= 16;
		$config['offset']				= $page;
		$config['uri_segment']			= $this->uri->total_segments();
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= TRUE;
		$config['reuse_query_string'] 	= TRUE;

		$this->load->library('pagination');

		$this->pagination->initialize($config);

		/*$pagination = new Pagination();
		$pagination->total = $image_total;
		$pagination->page = $page;
		$pagination->limit = 16;
		$pagination->url = $this->url->link('common/filemanager', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();*/
		
		
		return $this->output->set_output($this->load->view($this->admin_view.'/common/file_manager', $data, true));
	}

	public function upload() {

		$json = array();

		// Make sure we have the correct directory
		if ($this->input->get('directory')) {
			$directory = rtrim(DIR_IMAGE . '/' . $this->input->get('directory'), '/');
		} else {
			$directory = DIR_IMAGE;
		}

		// Check its a directory
		if (!is_dir($directory) /*|| substr(str_replace('\\', '/', realpath($directory)), 0, strlen(DIR_IMAGE . '/')) != DIR_IMAGE . '/'*/) {
			$json['error'] = lang('error_directory');
		}
		
		if (!$json) {
			// Check if multiple files are uploaded or just one
			$files = array();
			
			
			if (!empty($_FILES['file']['name']) && is_array($_FILES['file']['name'])) {
				foreach (array_keys($_FILES['file']['name']) as $key) {
					$files[] = array(
						'name'     => $_FILES['file']['name'][$key],
						'type'     => $_FILES['file']['type'][$key],
						'tmp_name' => $_FILES['file']['tmp_name'][$key],
						'error'    => $_FILES['file']['error'][$key],
						'size'     => $_FILES['file']['size'][$key]
					);
				}
			}

			
			foreach ($files as $file) {
				if (is_file($file['tmp_name'])) {
					// Sanitize the filename
					$filename = basename(html_entity_decode($file['name'], ENT_QUOTES, 'UTF-8'));

					// Validate the filename length
					if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 255)) {
						$json['error'] = lang('error_filename');
					}
					
					// Allowed file extension types
					$allowed = array(
						'jpg',
						'jpeg',
						'gif',
						'png'
					);
	
					if (!in_array(utf8_strtolower(utf8_substr(strrchr($filename, '.'), 1)), $allowed)) {
						$json['error'] = lang('error_filetype');
					}
					
					// Allowed file mime types
					$allowed = array(
						'image/jpeg',
						'image/pjpeg',
						'image/png',
						'image/x-png',
						'image/gif'
					);
	
					if (!in_array($file['type'], $allowed)) {
						$json['error'] = lang('error_filetype');
					}

					// Return any upload error
					if ($file['error'] != UPLOAD_ERR_OK) {
						$json['error'] = lang('error_upload_' . $file['error']);
					}
				} else {
					$json['error'] = lang('error_upload');
				}

				if (!$json) {
					move_uploaded_file($file['tmp_name'], $directory . '/' . $filename);
				}
				
				if(strpos($directory, 'products')) {
					$sourceFile = $directory . '/' . $filename;
					$this->resize_product_image($sourceFile);
				}
			}
		}

		if (!$json) {
			$json['success'] = lang('text_uploaded');
		}

		$this->output->set_header('Content-Type: application/json');
		return $this->output->set_output(json_encode($json));
	}

	public function folder() {
		$json = array();

		// Make sure we have the correct directory
		if ($this->input->get('directory')) {
			$directory = rtrim(DIR_IMAGE . '/' . $this->input->get('directory'), '/');
		} else {
			$directory = DIR_IMAGE ;
		}

		// Check its a directory
		if (!is_dir($directory) /*|| substr(str_replace('\\', '/', realpath($directory)), 0, strlen(DIR_IMAGE)) != DIR_IMAGE*/) {
			$json['error'] = lang('error_directory');
		}

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			// Sanitize the folder name
			$folder = basename(html_entity_decode($this->input->post('folder'), ENT_QUOTES, 'UTF-8'));

			// Validate the filename length
			if ((utf8_strlen($folder) < 3) || (utf8_strlen($folder) > 128)) {
				$json['error'] = lang('error_folder');
			}

			// Check if directory already exists or not
			if (is_dir($directory . '/' . $folder)) {
				$json['error'] = lang('error_exists');
			}
		}

		if (!isset($json['error'])) {
			mkdir($directory . '/' . $folder, 0777);
			chmod($directory . '/' . $folder, 0777);

			@touch($directory . '/' . $folder . '/' . 'index.html');

			$json['success'] = lang('text_directory');
		}

		$this->output->set_header('Content-Type: application/json');
		return $this->output->set_output(json_encode($json));

	}

	public function delete() {
		$json = array();
		
		if ($this->input->post('path')) {
			$paths = $this->input->post('path');
		} else {
			$paths = array();
		}

		$product_images_flag = false;
		if(is_array($paths)){
			if(in_array('products', $paths)){
				$product_images_flag = true;
			}
		}else {
			if (strpos($paths, 'products')) {
				$product_images_flag = true;
			}
		}

		// Loop through each path to run validations
		foreach ($paths as $path) {
			// Check path exsists
			echo "<pre>";
			print_r(DIR_IMAGE . $path);
			print_r(substr(str_replace('\\', '/', realpath(DIR_IMAGE . $path))));
			echo "</pre>";
			//exit();
			if ($path == DIR_IMAGE . '' || substr(str_replace('\\', '/', realpath(DIR_IMAGE . $path)), 0, strlen(DIR_IMAGE . '')) != DIR_IMAGE . '') {
				$json['error'] = lang('error_delete');
				break;
			}
		}

		echo "<pre>";
		print_r($paths);
		echo "</pre>";
		exit();

		if (!$json) {
			// Loop through each path
			foreach ($paths as $path) {
				$path = rtrim(DIR_IMAGE . $path, '/');

				// If path is just a file delete it
				if (is_file($path)) {
					unlink($path);
					if(strpos($path, 'products')){
						$target_folder = str_replace("\\","/",FCPATH. 'images/products/');
						$tempPathParts = explode('/', $path);
						$image_name = end($tempPathParts);
						unlink($target_folder . 'full/' . $image_name);
						unlink($target_folder . 'large/' . $image_name);
						unlink($target_folder . 'medium/' . $image_name);
						unlink($target_folder . 'thumbnails/' . $image_name);
					}

				// If path is a directory beging deleting each file and sub folder
				} elseif (is_dir($path)) {

					$files = array();

					// Make path into an array
					$path = array($path . '*');

					// While the path array is still populated keep looping through
					while (count($path) != 0) {
						$next = array_shift($path);

						foreach (glob($next) as $file) {
							// If directory add to path array
							if (is_dir($file)) {
								$path[] = $file . '/*';
							}

							// Add the file to the files to be deleted array
							$files[] = $file;
						}
					}

					// Reverse sort the file array
					rsort($files);
					

					foreach ($files as $file) {
						// If file just delete
						if (is_file($file)) {
							unlink($file);
							if($product_images_flag){
								$target_folder = str_replace("\\","/",FCPATH. 'images/products/');
								$tempPathParts = explode('/', $file);
								$image_name = end($tempPathParts);
								unlink($target_folder . 'full/' . $image_name);
								unlink($target_folder . 'large/' . $image_name);
								unlink($target_folder . 'medium/' . $image_name);
								unlink($target_folder . 'thumbnails/' . $image_name);
							}
						// If directory use the remove directory function
						} elseif (is_dir($file)) {
							// rmdir($file);
							$json['error'] = 'Folder deletion is not allowed!';
						}
					}
				}
			}

			if(!isset($json['error'])) {
				$json['success'] = lang('text_delete');
			}
		}

		$this->output->set_header('Content-Type: application/json');
		return $this->output->set_output(json_encode($json));
	}

	private function resize_image($sourceImage, $width, $height, $aspectRatio = false){

		$temp = explode('/',$sourceImage);
		$image_name = end($temp);

		$newImage = 'uploads/cache/thumb_'.$image_name;

		if(!file_exists($newImage)) {


			$config['image_library'] = 'gd2';
			$config['source_image'] = $sourceImage;
			$config['create_thumb'] = false;
			$config['maintain_ratio'] = $aspectRatio;
			$config['new_image'] = $newImage;
			$config['width'] = $width;
			$config['height'] = $height;

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
		}

		return $newImage;

	}

	private function resize_product_image($sourceImage, $aspectRatio = false){

		$target_folder = str_replace("\\","/",FCPATH. 'images/products/');
		$temp = explode('/',$sourceImage);
		$image_name = end($temp);

		$newImage = 'uploads/cache/thumb_'.$image_name;

		$this->load->library('image_lib');

		$errors = array();

		if(!file_exists($newImage)) {

			$config['image_library'] = 'gd2';
			$config['source_image'] = $sourceImage;
			$config['create_thumb'] = false;
			$config['maintain_ratio'] = $aspectRatio;
			$config['new_image'] = $newImage;
			$config['width'] = 100;
			$config['height'] = 100;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			echo $this->image_lib->display_errors();
			$this->image_lib->clear();
		}

		

		if(!file_exists($target_folder . 'full/'. $image_name)) {

			//this is the large image
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= $sourceImage;
			$config['new_image']		= $target_folder . 'full/' . $image_name;
			$config['width'] 			= 1000;
			$config['height'] 			= 1000;
			$config['maintain_ratio'] 	= FALSE;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$errors['large'] = $this->image_lib->display_errors();
			$this->image_lib->clear();
		}

		if(!file_exists($target_folder . 'large/'. $image_name)) {

			//this is the large image
			$config['image_library'] = 'gd2';
			$config['source_image'] = $sourceImage;
			$config['new_image'] = $target_folder . 'large/' . $image_name;
			$config['width'] = 800;
			$config['height'] = 800;
			$config['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$errors['large'] =  $this->image_lib->display_errors();
			$this->image_lib->clear();
		}

		

		if(!file_exists($target_folder . 'medium/'. $image_name)) {
			//this is the medium image
			$config['image_library'] = 'gd2';
			$config['source_image'] = $sourceImage;
			$config['new_image'] = $target_folder . 'medium/' . $image_name;
			$config['width'] = 600;
			$config['height'] = 600;
			$config['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$errors['medium'] =  $this->image_lib->display_errors();
			$this->image_lib->clear();
		}

		if(!file_exists($target_folder . 'small/'. $image_name)) {
			//small image
			$config['image_library'] = 'gd2';
			$config['source_image'] = $sourceImage;
			$config['new_image'] = $target_folder . 'small/' . $image_name;
			$config['width'] = 300;
			$config['height'] = 300;
			$config['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$errors['small'] =  $this->image_lib->display_errors();
			$this->image_lib->clear();
		}

		if(!file_exists($target_folder . 'thumbnails/'. $image_name)) {
			//cropped thumbnail
			$config['image_library'] = 'gd2';
			$config['source_image'] = $sourceImage;
			$config['new_image'] = $target_folder . 'thumbnails/' . $image_name;
			$config['width'] = 150;
			$config['height'] = 150;
			$config['maintain_ratio'] = TRUE;
			$config['exact_size'] = TRUE;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$errors['thumbnails'] =  $this->image_lib->display_errors();
			$this->image_lib->clear();
		}

		return $newImage;

	}
}
