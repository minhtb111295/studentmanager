<?php 
class Register {
    public $id;
    public $student_id;
    public $student_name;
    public $subject_id;
    public $subject_name;
    public $score;

    function __construct($id, $student_id, $student_name, $subject_id, $subject_name, $score)
    {
        $this->id = $id;
        $this->student_id = $student_id;
        $this->student_name = $student_name;
        $this->subject_id = $subject_id;
        $this->subject_name = $subject_name;
        $this->score = $score;
    }
}
?>