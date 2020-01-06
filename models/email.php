<?php
require '../vendor/autoload.php';
function email (){
    $request_body = json_decode('{
  "personalizations": [
    {
      "to": [
        {
          "email": "arthur.k777@gmail.com"
        }
      ],
      "subject": "Hello World from the SendGrid PHP Library!"
    }
  ],
  "from": {
    "email": "arthur.k777@gmail.com"
  },
  "content": [
    {
      "type": "text/plain",
      "value": "Hello, Email!"
    }
  ]
}');

$sg = new \SendGrid(getenv('SENDGRID_API_KEY'));

$response = $sg->client->mail()->send()->post($request_body);
echo $response->statusCode();
echo $response->body();
echo $response->headers();
print_r('hello');
}


 ?>
