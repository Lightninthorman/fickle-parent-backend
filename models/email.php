<?php
require '../vendor/autoload.php';
function email (){
    $hello = 'HELLO';
    $email = new \SendGrid\Mail\Mail();
$email->setFrom("arthur.k777@gmail.com", "Example User");
$email->setSubject("Sending with Twilio SendGrid is Fun");
$email->addTo("arthur.k777@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "
    <html lang='en' dir='ltr'>
        <head>
            <meta charset='utf-8'>
            <script src='https://cdn.jsdelivr.net/npm/chart.js@2.8.0'></script>
        </head>
        <body>
            <canvas id='myChart'></canvas>
        <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {

            type: 'line',


            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45]
                }]
            },

            options: {}
            });
        </script>
        </body>
    </html>
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
