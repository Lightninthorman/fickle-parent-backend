<?php
require '../vendor/autoload.php';
function email (){
    $hello = 'HELLO';
    $lowestAvg = 'Respect';
    $improvement = '';
    $rank=1;
    $child ="Josie";
    $user = "Dad";

    if($rank > 1){
        $improvement = "Don't rest though, you could always work on $lowestAvg";
    }else{
        $improvement = "A great way to improve would be to work on $lowestAvg";
    }
    $email = new \SendGrid\Mail\Mail();

$email->setFrom("arthur.k777@gmail.com", "Example User");
$email->setSubject("Sending with Twilio SendGrid is Fun");
$email->addTo("arthur.k777@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "
    <p>Hi $child!</p>
    <p>Currently you are my #$rank child with a score of  <strong>$score</strong>.</p>
    <p>$improvement</p>
    <p>Love,</p>
    <p>$user</p>
    "
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}
}


 ?>
