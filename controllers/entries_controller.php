<?php
    include_once __DIR__ . '/../models/entries.php';

    if($_REQUEST['action'] === 'index'){

        echo json_encode(Llamas::all($_REQUEST['user']));

    } elseif ($_REQUEST['action'] === 'create'){

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
            $body_object->regret_desc,
        );
        $entries = Entries::create($new_entry);
        echo json_encode($entries);
    }


 ?>
