<?php
// Step 1: Define JazzCash payment parameters
$integritySalt = 'vyx8uzt95w';  // Integrity Salt from JazzCash
$pp_Version = '1.1';
$pp_TxnType = 'PAYMENT';
$pp_MerchantID = 'MC127757';
$pp_Password = '3x81g01xws';
$pp_TxnRefNo = 'T20241003160212';
$pp_Amount = '10000';
$pp_TxnCurrency = 'PKR';
$pp_TxnDateTime = '20241003160212';
$pp_ReturnURL = 'https://techcity.regencyfarm.com/return.php';
$pp_Language = 'EN';

// Step 2: Prepare the string to generate hash
$hashString = $integritySalt . '&' .
              $pp_MerchantID . '&' .
              $pp_Password . '&' .
              $pp_TxnRefNo . '&' .
              $pp_Amount . '&' .
              $pp_TxnCurrency . '&' .
              $pp_TxnDateTime . '&' .
              $pp_ReturnURL . '&' .
              $pp_Language . '&' .
              $pp_Version;

// Step 3: Generate secure hash
$secureHash = hash_hmac('sha256', $hashString, $integritySalt);

// Step 4: Output the secure hash (for testing purposes)
echo 'Secure Hash: ' . $secureHash;

// Step 5: Prepare data to send with form submission
$data = [
    'pp_Version' => $pp_Version,
    'pp_TxnType' => $pp_TxnType,
    'pp_MerchantID' => $pp_MerchantID,
    'pp_Password' => $pp_Password,
    'pp_TxnRefNo' => $pp_TxnRefNo,
    'pp_Amount' => $pp_Amount,
    'pp_TxnCurrency' => $pp_TxnCurrency,
    'pp_TxnDateTime' => $pp_TxnDateTime,
    'pp_ReturnURL' => $pp_ReturnURL,
    'pp_Language' => $pp_Language,
    'pp_SecureHash' => $secureHash
];

// Optional: You can print $data to verify if everything is set correctly
echo '<pre>';
print_r($data);
echo '</pre>';

// Step 6: Send data to JazzCash (this is a POST form submission)
?>

<form method="post" action="https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/">
    <?php foreach ($data as $name => $value): ?>
        <input type="hidden" name="<?= $name ?>" value="<?= $value ?>">
    <?php endforeach; ?>
    <button type="submit">Proceed to JazzCash</button>
</form>
