<?php
// JazzCash credentials
$merchant_id = "MC127757";
$password = "3x81g01xws";
$integrity_salt = "vyx8uzt95w";

// User input
$mobile_number = '03123456789';
$amount = 100;

// Generate transaction reference number
$txn_ref_no = 'T' . date('YmdHis');

// Prepare request data
$data = [
    'pp_Version' => '1.1',
    'pp_TxnType' => 'MWALLET',  // Mobile wallet transaction
    'pp_MerchantID' => $merchant_id,
    'pp_Password' => $password,
    'pp_TxnRefNo' => $txn_ref_no,
    'pp_Amount' => $amount * 100,  // Amount in paisa (e.g. 10000 for 100 PKR)
    'pp_MobileNumber' => $mobile_number,
    'pp_ReturnURL' => 'https://yourwebsite.com/return_url',
    'pp_TxnCurrency' => 'PKR',
    'pp_TxnDateTime' => date('YmdHis'),
    'pp_Language' => 'EN',
    'pp_SecureHash' => ''  // To be generated
];

// Create secure hash
$hash_string = $integrity_salt . '&' . implode('&', $data);
$data['pp_SecureHash'] = hash_hmac('sha256', $hash_string, $integrity_salt);

// Make the API call
$ch = curl_init("https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Handle the response
var_dump($response);
if ($response) {
    echo "Transaction successful!";
} else {
    echo "Transaction failed!";
}
?>
