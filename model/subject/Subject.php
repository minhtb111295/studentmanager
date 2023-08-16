<?php 
class Subject {
    public $id;
    public $name;
    public $ects;

    function __construct($id, $name, $ects)
    {
        $this->id = $id;
        $this->name = $name;
        $this->ects = $ects;
    }
}
?>