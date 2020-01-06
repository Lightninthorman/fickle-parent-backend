<?php
    header('Content-Type: application/json');

    include_once __DIR__ . '/../models/entries.php';
    include_once __DIR__ . '/../models/email.php';

    if($_REQUEST['action'] === 'index'){

        echo json_encode(Entries::all($_REQUEST['user']));

    }elseif($_REQEUEST['action'] === 'email'){
        $request_body = file_get_contents('php://input');
        print_r($request_body);
        $body_object = json_decode($request_body);
        echo "hello";
        print_r($body_object);
        email(
            $body_object->user_email,
            $body_object->child_email,
            $body_object->child,
            $body_object->rank,
            $body_object->score,
            $body_object->$lowestAvg,
            $body_object->user
        );
        echo "Your email has been sent";
    }elseif ($_REQUEST['action'] === 'create'){

        $request_body = file_get_contents('php://input');
        $body_object = json_decode($request_body);
        $new_entry = new Entry(
            null,
            $body_object->entry_date,
            $body_object->user_id,
            $body_object->child_name,
            $body_object->journal_entry,
            $body_object->behavior,
            $body_object->behavior_desc,
            $body_object->helpful,
            $body_object->helpful_desc,
            $body_object->respect,
            $body_object->respect_desc,
            $body_object->sleep,
            $body_object->sleep_desc,
            $body_object->regret,
            $body_object->regret_desc
        );


        $entries = Entries::create($new_entry);
        echo json_encode($entries);
    }elseif($_REQUEST['action'] === 'delete'){
        $entries = Entries::delete($_REQUEST['child'], $_REQUEST['user']);
        echo json_encode($entries);
    }elseif($_REQUEST['action'] === 'update'){
        $request_body = file_get_contents('php://input');
        $body_object = json_decode($request_body);
        $updated_entry = new Entry(
            $_REQUEST['id'],
            $body_object->entry_date,
            $body_object->user_id,
            $body_object->child_name,
            $body_object->journal_entry,
            $body_object->behavior,
            $body_object->behavior_desc,
            $body_object->helpful,
            $body_object->helpful_desc,
            $body_object->respect,
            $body_object->respect_desc,
            $body_object->sleep,
            $body_object->sleep_desc,
            $body_object->regret,
            $body_object->regret_desc
        );


        $entries = Entries::update($updated_entry);
        echo json_encode($entries);
    }


 ?>
