<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Email</title>
    <style>
        /* Style resets for compatibility */
        body, table, td, a {
            -webkit-text-size-adjust: 100%; /* Prevents changes in font size */
            -ms-text-size-adjust: 100%; /* Prevents changes in font size */
        }
        table, td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
        }
        
        /* Responsive styles */
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif;">

    <!-- Wrapper Table -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color: #f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center">
                <!-- Inner Container -->
                <table role="presentation" class="email-container" width="600" cellspacing="0" cellpadding="0" border="0" style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="text-align: center; padding-bottom: 20px;">
                            <h1 style="color: #333333; font-size: 24px; margin: 0;">Test Email</h1>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td style="padding: 20px; color: #333333; font-size: 16px; line-height: 1.5;">
                            <p>Hello,</p>
                            <p>This is a test email sent from the email configuration module of our application.</p>
                            <p>Please ignore this email if you received it by mistake.</p>
                            <p>Thank you!</p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px; text-align: center; color: #999999; font-size: 14px;">
                            <p style="margin: 0;">&copy; <?php echo  date('Y')+1 ?> <?php echo  $comp ?>. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
                <!-- End Inner Container -->
            </td>
        </tr>
    </table>
    <!-- End Wrapper Table -->
    
</body>
</html>
