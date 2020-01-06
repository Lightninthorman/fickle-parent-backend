<?php
require '../vendor/autoload.php';
function email (){
    $hello = 'hello'
    $email = new \SendGrid\Mail\Mail();
$email->setFrom("arthur.k777@gmail.com", "Example User");
$email->setSubject("Sending with Twilio SendGrid is Fun");
$email->addTo("arthur.k777@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print_r($response->statusCode() . "\n");
    print_r($response->headers());
    print_r($response->body() . "\n");
} catch (Exception $e) {
    print_r('Caught exception: '.  $e->getMessage(). "\n");
}
}


 ?>
