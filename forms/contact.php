<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Set default response
$response = array(
    'success' => false,
    'message' => 'An error occurred. Please try again later.'
);

// Check if form fields are set
if(isset($_POST['fname'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
    // Retrieve form data
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $address = $_POST['subject'];
    $description = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'niku0000singh@gmail.com'; // Your Gmail address
        $mail->Password   = 'ecwu tkuh vwrx lhxe'; // Your Gmail password or app password if 2FA enabled
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465; // 587 if using TLS encryption (PHPMailer::ENCRYPTION_STARTTLS)

        $mail->setFrom($email, $fname); // Sender's email and name;
        $mail->addAddress('niku0000singh@gmail.com', 'Niku Singh Rajput');

        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $address;
        $mail->Body    = "
            <p><strong>Name:</strong> $fname</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Address:</strong> $address</p>
            <p><strong>Message:</strong> $description</p>
        ";
        $mail->AltBody = "Name: $fname \nEmail: $email\n Subject: $address\n Message: $description";

        if ($mail->send()) {
            $response['success'] = true;
            $response['message'] = 'Message sent. Thank you!';
        } else {
            $response['message'] = 'Message could not be sent. Please try again later.';
        }
    } catch (Exception $e) {
        $response['message'] = 'An error occurred: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Please fill in all the required fields.';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
