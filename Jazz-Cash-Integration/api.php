<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (true) {
    // Form data ko array mein store karna
	include "gateway/config.php";

//============================Get Form Values=========================================================
$packagePrice = 100;
//============================Get EForm Values=========================================================


//=============================JazzCash API Configurations=============================================
$pp_Amount = $packagePrice * 100;


$MerchantID = JAZZCASH_MERCHANT_ID; //Your Merchant from transaction Credentials
$Password = JAZZCASH_PASSWORD; //Your Password from transaction Credentials
$HashKey = JAZZCASH_INTEGERITY_SALT; //Your HashKey/integrity salt from transaction Credentials
$ReturnURL = JAZZCASH_RETURN_URL; //Your Return URL, It must be static


date_default_timezone_set("Asia/karachi");

$Amount = $pp_Amount; //Last two digits will be considered as Decimal thats the reason we are multiplying amount with 100 in line number 11
$BillReference = "billRef".time(); //use AlphaNumeric only
$Description = "Product test description"; //use AlphaNumeric only
$IsRegisteredCustomer = "No"; // do not change it
$Language = JAZZCASH_LANGUAGE; // do not change it
$TxnCurrency = JAZZCASH_CURRENCY_CODE; // do not change it
$TxnDateTime = date('YmdHis');
$TxnExpiryDateTime = date('YmdHis', strtotime('+1 Days'));
$TxnRefNumber = 'mapi-'.date('YmdHis') . mt_rand(10, 100);
$TxnType = "MPAY"; // Leave it empty
$Version = JAZZCASH_API_VERSION_2;
$SubMerchantID = ""; // Leave it empty
$BankID = ""; // Leave it empty
$ProductID = ""; // Leave it empty
$ppmpf_1 = ""; // use to store extra details (use AlphaNumeric only)
$ppmpf_2 = ""; // use to store extra details (use AlphaNumeric only)
$ppmpf_3 = ""; // use to store extra details (use AlphaNumeric only)
$ppmpf_4 = ""; // use to store extra details (use AlphaNumeric only)
$ppmpf_5 = ""; // use to store extra details (use AlphaNumeric only)
//========================================Hash Array for making Secure Hash for API call================================
$HashArray = [$Amount, $BankID, $BillReference, $Description, $IsRegisteredCustomer,
    $Language, $MerchantID, $Password, $Produc