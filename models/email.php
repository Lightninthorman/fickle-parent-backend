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
      "type": "text/html",
      "value": "<strong>and easy to do anywhere, even with PHP</strong><p>also try this <a href=\"https://www.google.com/\">google</a> link."
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
