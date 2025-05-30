<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_settings($code='config')
	{
		$this->db->where('code', $code);
		$result	= $this->db->get('settings')->result();
		if(!$result)
		{
			return false;
		}
		
		$return	= array();
		foreach($result as $val)
		{
			$return[$val->key]	= ($val->is_json == 1 ? json_decode($val->value, TRUE) : $val->value);
		}
		
		return $return;
	}

	public function do_email($to, $sub, $body)
	{
		// $to = 'raheelshehzad188@gmail.com';//for testing
		$result	= $this->get_settings('config');
		$res = array(
			'status'=> '0',
			'msg'=> 'Not setup yet sorry!',
		);
		if($result['config_mail_engine'] == 'sendgrid')
		{

			$r = $this->send_mail($to, $body, $sub,$result);
			if(isset($r['errors']))
			{
				$msg = '';
				foreach($r['errors'] as $k=> $v)
				{
					$msg = $msg.$v['message'];
				}
				$res['msg'] = $msg;
			}
			else
			{
				$res['status'] = '1';
				$res['msg'] = 'Email sent successfully!';
			}

		}
		elseif($result['config_mail_engine'] == 'smtp')
		{
			$r = $this->smtp_mail($to, $body, $sub,$result);
			if(!$r)
			{
				$msg = 'Check configration please';
				$res['msg'] = $msg;
				$res['status'] = 0;
			}
			else
			{
				$res['status'] = '1';
				$res['msg'] = 'Email sent successfully!';
			}

		}
		return $res;
	}
	public function pay_later_email($order_id)
	{
		$data['page_title'] = "Place Order";
		$data['checkout_page'] = "confirm";
		$order = $this->db->where('order_id',$order_id)->get('ci_order')->row();
		$checkout = $this->admin_session->userdata('checkout');

		if(!isset($checkout->childrens) || (isset($checkout->childrens) && !$checkout->childrens))
		{
			$this->admin_session->set_flashdata('error', 'There is no child is selected.');
			redirect(site_url($this->admin_folder .'/sales/orders/create/step1.html'));
		}
		$coupon = (object) $this->admin_session->userdata('coupon') ? $this->admin_session->userdata('coupon') : array();
		$checkout = $this->admin_session->userdata('checkout');
		if(!isset($checkout->childrens) || (isset($checkout->childrens) && !$checkout->childrens))
		{
			$this->admin_session->set_flashdata('error', 'There is no child is selected.');
			redirect(site_url($this->admin_folder .'/sales/orders/create/step1.html'));
		}
		$coupon = (object) $this->admin_session->userdata('coupon') ? $this->admin_session->userdata('coupon') : array();
		$checkout = $this->Admin_order_create_model->calculate($checkout,$checkout->order_product,'confirm');

		if (!$checkout or !isset($checkout->package) or !isset($checkout->childrens) or !isset($checkout->totals)) {
			$this->user_session->set_flashdata('error', 'There is no children is selected.');
			redirect(site_url('setp1.html'));
		}

		// pre($checkout);
		$data['address'] = '';

		$addons = array();
		if (isset($checkout->addons)) {
			$addons = $checkout->addons;
		}

		$data['result'] = $checkout->package;
		$data['order_id'] = $order_id;
		$data['childrens'] = $checkout->childrens;
		$data['total'] = $checkout->total;
		$data['isfull_pay'] = (isset($checkout->isfull_pay)?$checkout->isfull_pay:NULL);
		$data['card_number'] = (isset($checkout->card_number)?$checkout->card_number:'');
		$data['card_exp'] = (isset($checkout->card_exp)?$checkout->card_exp:'');
		$data['card_ccv'] = (isset($checkout->card_ccv)?$checkout->card_ccv:'');
		$data['checkout_page'] = 'confirm';
		$data['payment_method'] = 'credit card';
		$order_meal = $this->admin_session->userdata('order_meal');
		$data['meals'] = $order_meal;
		$pay_later = $this->input->post('pay_later');

		$week_date = json_decode($data['result']->week_date);


		$weeks = array();
		foreach ($week_date->start_date as $key => $v) {

			$weeks[] = array(
				'start_date' => $v,
				'end_date' => $week_date->end_date[$key]
			);

		}
		$addon_price = (isset($checkout->addon_price)) ? $checkout->addon_price : 0;
		$data['weeks'] = $weeks;

		$dates = array();
		$custom = false;
		$allow_installments = 0;
		// var_dump($checkout->package->family);die;
		if ($checkout->package->family):
			if ($checkout->package->family->installment_type == 2):
				$dates = json_decode($checkout->package->family->installment_custome_dates);
			else:
				$custom = true;
			endif;
		else:
			if ($checkout->package->installment_type == 5):
				$dates = json_decode($checkout->package->installment_custome_dates);
			else:
				$fdate = $checkout->package->installment_from_date;
				$edate = $checkout->package->installment_end_date;
				$dates = get_installment_list($checkout->package->installment_type, $fdate, $edate);
			endif;
		endif;

		$data['dates'] = $dates;
		$data['custom_installment'] = $custom;

		$data['addons'] = $addons;
		$data['sub_total'] = $checkout->total;

		$data['addon_price'] = $addon_price;
		if(!isset($checkout->coupon_dicount))
			$checkout->coupon_dicount = 0;
		$data['discount'] = format_currency(round($checkout->coupon_dicount, 2));
		$data['sub_total'] = $checkout->total + $checkout->coupon_dicount;
		// $data['sub_total'] = format_currency(round($checkout->sub_tot + $addon_price, 2));
		// $data['total_price'] = format_currency(round(($checkout->total + $addon_price), 2));
		$data['total_order_price'] =$total_order_price =  round(($checkout->total), 2);
		$html =  $this->load->view($this->admin_view .'/'. $this->view_dir .'/mail_template', $data,true);
		return $this->do_email($order->email,'Order placed successfully',$html);


	}


	public function smtp_mail($to, $html, $sub,$settings = array()) {
    // Load the Email library
    $this->load->library('email');

    // SMTP Configuration for SendGrid
    $config = array(
        'protocol'  => 'smtp',
        'smtp_host' => $settings['config_mail_smtp_hostname'],
        'smtp_port' => 587, // TLS port (or use 465 for SSL)
        'smtp_user' => $settings['config_mail_smtp_username'], // SendGrid uses 'apikey' as the username
        'smtp_pass' => $settings['config_mail_smtp_password'], // Replace with your actual API key
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'wordwrap'  => TRUE,
        'smtp_crypto' => 'tls', // Use 'tls' for port 587 or 'ssl' for port 465
        'newline'   => "\r\n",
        'crlf'      => "\r\n"
    );

    $this->email->initialize($config);

    // Email details
    $this->email->from($settings['config_mail_from_email'], $settings['config_mail_from_name']);
    $this->email->to($to); // Recipient's email address
    $this->email->subject($sub);
    $this->email->message($html);

    // Send email
    if ($this->email->send()) {
        return true;
    } else {
    	var_dump($this->email->print_debugger());
        return false;
    }
}
	public function send_mail($to, $html, $sub,$settings = array()) {

 $data = [
   "personalizations" => [
         [
            "to" => [
               [
                  "email" => $to 
               ]
            ] 
         ] 
      ], 
   "from" => [
                     "email" => $settings['config_mail_from_email']
                  ], 
   "subject" => $sub, 
   "content" => [
                        [
                           'type' => 'text/html',
                           "value" => $html 
                        ] 
                     ] 
]; 
 
 

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            "authorization: Bearer ".$settings['sendgrid_key'], // Replace this with your real SendGrid API key
            "cache-control: no-cache",
            "content-type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        // echo "cURL Error: " . $err;
    } else {
        $arr = json_decode($response, true);
        // echo "Response: " . print_r($arr, true);
    }
}

}