<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_account extends User_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->model(
			array(
				'user/common/Customer_model',
				'user/User_support_model',
			)
		);

		$this->controller_name = 'user_account';
		$this->controller_dir = 'account';
		$this->view_dir = 'account/profile';
	}

	function index()
	{
		$this->view($this->user_view .'/'. $this->view_dir .'/user_account', $data);
	}
	

	function edit_account()
	{
		$this->current_active_nav = 'profile';
		$data['page_title']			= 'Edit Profile Information';
		$data['page_header']		= 'Edit Profile Information';
		$data['user'] 				= $this->Customer_model->get_by_id($this->customer_id);

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|callback_is_already_exist');
		//$this->form_validation->set_rules('cell', 'Phone','required|regex_match[/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/]', array('regex_match' => '%s is not in correct format. required 555-555-5555'));

		if ($this->form_validation->run() == FALSE)
		{
			//$this->view($this->user_view .'/'. $this->view_dir .'/edit-billing-address', $data);
			$this->view($this->user_view .'/'. $this->view_dir .'/edit-account', $data);
		}
		else
		{

			$input_data = array(
				'customer_id'	=> $this->customer_id,
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
				'email'			=> $this->input->post('email'),
				'phone'			=> $this->input->post('phone'),
				'is_newsletter' => $this->input->post('is_newsletter'),
			);

			if($this->Customer_model->save($input_data)){
			    if($input_data['is_newsletter'] == 1){
                    $newsletter_input = array(
                        'name' 		=> $this->input->post('first_name').' '.$this->input->post('last_name'),
	                    'email'		=> $this->input->post('email'),
			            'date_added' => date('Y-m-d H:i:s'),
	                );
                    $this->User_support_model->save($newsletter_input);
                }else{
                    $this->User_support_model->delete($this->input->post('email'));
                }
				$this->user_session->set_flashdata('message', 'Your profile information has been updated successfully!');
			}else{
				$this->user_session->set_flashdata('error', 'Your profile information has not been updated successfully!');
			}

			redirect(site_url($this->user_url_prefix .'/profile.html'));
			
		}


	}

	function change_password()
	{
		$this->current_active_nav = 'change-password';
		$data['page_title']			= 'Change Password';
		$data['page_header']		= 'Change Password';
		$data['old_password']		= '';
		$data['new_password']		= '';
		$data['confirm_password']	= '';

		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|callback__check_old_password');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|matches[new_password]');


		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->user_view .'/'. $this->view_dir .'/change-password', $data);
		}
		else
		{
			if ($this->input->post('new_password') != '')
			{
				$password = md5($this->input->post('new_password'));

				$save = array(
					'password' 		=> $password,
					'customer_id'	=> $this->customer_id
				);

				if($this->Customer_model->save($save)){
					$this->user_session->set_flashdata('message', 'Your password has been updated successfully!');
				}else{
					$this->user_session->set_flashdata('error', 'Your password has not been updated successfully. Try Again!');
				}
				redirect(site_url($this->user_url_prefix .'/change-password.html'));
			}
		}
	}

	function _check_old_password()
	{
		$password	= $this->input->post('old_password');
		$user = $this->Customer_model->get_by_id($this->customer_id);

		$result	= $this->auth_user->is_password_correct($user->email, $password);
		
		if ($result){
			return TRUE;
		}else {
			$this->form_validation->set_message(__FUNCTION__, 'Old Password is invalid. Please try again!');
			return FALSE;
		}
	}

	public function is_already_exist($str)
	{
		$email	= $this->input->post('email');

		if(trim($email) == '')
		{
			return TRUE;
		}

		$result = $this->Customer_model->is_already_exist($email, $this->customer_id);
		if ($result)
		{
			$this->form_validation->set_message('is_already_exist', 'Email is already exist.');
			return FALSE;
		}

		return TRUE;
	}

	function signout()
	{
		$this->logout();
	}
	
	function logout()
	{
		$this->auth_user->logout();
		redirect();
	}

}
