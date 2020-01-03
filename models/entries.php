<?php
    pg_connect(getenv("DATABASE_URL"));

    class Entry{
        public $entry_id;
        public $entry_date;
        public $user_id;
        public $child_name;
        public $journal_entry;
        public $behavior;
        public $behavior_desc;
        public $helpful;
        public $helpful_desc;
        public $respect;
        public $respect_desc;
        public $sleep;
        public $sleep_desc;
        public $regret;
        public $regret_desc;

        public function __construct(
            $entry_id,
            $entry_date,
            $user_id,
            $child_name,
            $journal_entry,
            $behavior,
            $behavior_desc = "",
            $helpful,
            $helpful_desc = "",
            $respect,
            $respect_desc = "",
            $sleep,
            $sleep_desc = "",
            $regret,
            $regret_desc = ""

        ){
            $this->entry_id = $entry_id;
            $this->entry_date = $entry_date;
            $this->user_id = $user_id;
            $this->child_name = $child_name;
            $this->journal_entry = $journal_entry;
            $this->behavior = $behavior;
            $this->behavior_desc = $behavior_desc;
            $this->helpful = $helpful;
            $this->helpful_desc = $helpful_desc;
            $this->respect = $respect;
            $this->respect_desc = $respect_desc;
            $this->sleep = $sleep;
            $this->sleep_desc = $sleep_desc;
            $this->regret = $regret;
            $this->regret_desc = $regret_desc;

        }
    }

    class Entries{
        static function all($user_id){
            $entries = [];
            $query = "SELECT * FROM parent_entries WHERE user_id = $1 ORDER BY entry_id ASC";
            $query_params = [$user_id];
            $results = pg_query_params($query, $query_params);
            $row_object = pg_fetch_object($results);

            while($row_object){
                $new_entry = new Entry(
                    intval($row_object->entry_id),
                    $row_object->entry_date,
                    $row_object->user_id,
                    $row_object->child_name,
                    $row_object->journal_entry,
                    intval($row_object->behavior),
                    $row_object->behavior_desc,
                    intval($row_object->helpful),
                    $row_object->helpful_desc,
                    intval($row_object->respect),
                    $row_object->respect_desc,
                    intval($row_object->sleep),
                    $row_object->sleep_desc,
                    intval($row_object->regret),
                    $row_object->regret_desc
                );

                $entries[] = $new_entry;
                $row_object = pg_fetch_object($results);
            }
            return $entries;
        }

        static function create($entry){
            $query = "INSERT INTO parent_entries(entry_date, user_id, child_name, journal_entry, behavior, behavior_desc, helpful, helpful_desc, respect, respect_desc, sleep, sleep_desc, regret, regret_desc) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14)";
            $query_params = [
                $entry->entry_date,
                $entry->user_id,
                $entry->child_name,
                $entry->journal_entry,
                intval($entry->behavior),
                $entry->behavior_desc,
                intval($entry->helpful),
                $entry->helpful_desc,
                intval($entry->respect),
                $entry->respect_desc,
                intval($entry->sleep),
                $entry->sleep_desc,
                intval($entry->regret),
                $entry->regret_desc
            ];
            pg_query_params($query, $query_params);
			return self::all($entry->user_id);
        }

        static function delete ($child, $user){
            $query = "DELETE FROM parent_entries WHERE child_name = $1 AND user_id = $2";
            $query_params = [$child];
            pg_query_params($query, $query_params);
            return self::all($user);
        }

        static function update($entry){
            $query = "UPDATE parent_entries SET
            child_name = $1,
            journal_entry = $2,
            behavior = $3,
            behavior_desc = $4,
            helpful = $5,
            helpful_desc = $6,
            respect = $7,
            respect_desc = $8,
            sleep = $9,
            sleep_desc = $10,
            regret = $11,
            regret_desc = $12
            WHERE entry_id = $13";

            $query_params = [
                $entry->child_name,
                $entry->journal_entry,
                intval($entry->behavior),
                $entry->behavior_desc,
                intval($entry->helpful),
                $entry->helpful_desc,
                intval($entry->respect),
                $entry->respect_desc,
                intval($entry->sleep),
                $entry->sleep_desc,
                intval($entry->regret),
                $entry->regret_desc,
                $entry->entry_id
            ];
            pg_query_params($query, $query_params);
            return self::all($entry->user_id);
        }
    }





 ?>
