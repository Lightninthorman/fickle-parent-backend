<?php
require '../vendor/autoload.php';
function email ($user_email,$child_email,$child,$rank,$score,$lowestAvg,$user){
print_r($user_email);
    if($rank > 1){
        $improvement = "A great way to improve would be to work on $lowestAvg";
    }else{
        $improvement = "Don't rest though, you could always work on $lowestAvg";
    }
    $email = new \SendGrid\Mail\Mail();

$email->setFrom("$user_email", "$user");
$email->setSubject("$child, here are your current Fickle Parent results!");
$email->addTo("$child_email", "$child");
$email->addContent("text/plain",
    "Hi $child!
    Currently you are my #$rank child with a score of $score%.
    $improvement
    Love,
    $user
    ** A copy of this email has been sent to Santa to help inform his list **");
$email->addContent(
    "text/html", "
    <p>Hi $child!</p>
    <p>Currently you are my #$rank child with a score of  <strong>$score%</strong>.</p>
    <p>$improvement</p>
    <p>Love,</p>
    <p>$user</p>
    <p>** A copy of this email has been sent to Santa to help inform his list **</p>
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
