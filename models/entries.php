<?php


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

    public function __contstruct(
        $entry_id,
        $entry_date = date("l M d"),
        $user_id,
        $child_name,
        $journal_entry,
        $behavior,
        $behavior_desc = '',
        $helpful,
        $helpful_desc = '',
        $respect,
        $respect_desc = '',
        $sleep,
        $sleep_desc = '',
        $regret,
        $regret_desc = ''

    ){
        $entry_id;
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




 ?>
