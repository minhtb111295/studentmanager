<?php 
class RegisterRepository {
    public $success;
    public $error;

    protected function fetch($cond, $limit) {
        global $conn;
        $registers = [];
        $sqlQuery = "SELECT register.*, student.name AS student_name, subject.name AS subject_name FROM register JOIN student ON register.student_id=student.id JOIN subject ON register.subject_id=subject.id";
        if ($cond) {
            $sqlQuery .= " WHERE $cond";
        }
        if ($limit) {
            $sqlQuery .= " $limit";
        }
        $result = $conn->query($sqlQuery);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $student_id = $row['student_id'];
                $student_name = $row['student_name'];
                $subject_id = $row['subject_id'];
                $subject_name = $row['subject_name'];
                $score = $row['score'];
                $register = new Register($id, $student_id, $student_name, $subject_id, $subject_name, $score);
                $registers[] = $register;
            }
        }
        return $registers;
    }

    function buildLimit($page, $item_per_page) {
        $limit = NULL;
        if ($page && $item_per_page) {
            $start_index = ($page - 1) * $item_per_page;
            $limit = "LIMIT $start_index, $item_per_page";
        }
        return $limit;
    }

    function getAll($page=NULL, $item_per_page=NULL) {
        $cond = NULL;
        $limit = $this->buildLimit($page, $item_per_page);
        $registers = $this->fetch($cond, $limit);
        return $registers;
    }

    function getByPattern($search, $page=NULL, $item_per_page=NULL) {
        $cond = "student.name LIKE '%$search%' OR subject.name LIKE '%$search%'";
        $limit = $this->buildLimit($page, $item_per_page);
        $registers = $this->fetch($cond, $limit);
        return $registers;
    }

    function findByID($id) {
        $cond = "register.id=$id";
        $limit = NULL;
        $registers = $this->fetch($cond, $limit);
        $register = current($registers);
        return $register;
    }

    function getByStudentID($student_id) {
        $action = new StudentRepository;
        $student = $action->findByID($student_id);
        return $student;
    }

    function getBySubjectID($subject_id) {
        $action = new SubjectRepository;
        $subject = $action->findByID($subject_id);
        return $subject;
    }

    function save($data) {
        $student_id = $data['student_id'];
        $student = $this->getByStudentID($student_id);
        $student_name = $student->name;

        $subject_id = $data['subject_id'];
        $subject = $this->getBySubjectID($subject_id);
        $subject_name = $subject->name;

        global $conn;
        $sqlQuery = "INSERT INTO register (student_id, subject_id) VALUES ('$student_id', '$subject_id')";
        if ($conn->query($sqlQuery)) {
            $this->success = "Sinh viên $student_name đã đăng ký môn $subject_name thành công";
            return true;
        } else {
            $this->error = "Lỗi $sqlQuery <br> $conn->error";
            return false;
        }
    }

    function update($data) {
        $id = $data['id'];
        $score = $data['score'];

        $student_id = $data['student_id'];
        $student = $this->getByStudentID($student_id);
        $student_name = $student->name;

        $subject_id = $data['subject_id'];
        $subject = $this->getBySubjectID($subject_id);
        $subject_name = $subject->name;

        global $conn;
        $sqlQuery = "UPDATE register SET score=$score WHERE id=$id";
        if ($conn->query($sqlQuery)) {
            $this->success = "Cập nhật điểm cho sinh viên $student_name ở môn $subject_name thành công";
            return true;
        } else {
            $this->error = "Lỗi $sqlQuery <br> $conn->error";
            return false;
        }
    }

    function delete($id, $student_name) {
        global $conn;
        $sqlQuery = "DELETE FROM register WHERE id=$id";
        if ($conn->query($sqlQuery)) {
            $this->success = "Xóa đăng ký môn học của sinh viên $student_name thành công";
            return true;
        } else {
            $this->error = "Lỗi $sqlQuery <br> $conn->error";
            return false;
        }
    }

    function checkByStudentID($student_id) {
        $cond = "register.student_id=$student_id";
        $limit = NULL;
        $students = $this->fetch($cond, $limit);
        $student = current($students);
        if ($student) {
            return true;
        } else {
            return false;
        }
    }

    function checkBySubjectID($subject_id) {
        $cond = "register.subject_id=$subject_id";
        $limit = NULL;
        $subjects = $this->fetch($cond, $limit);
        $subject = current($subjects);
        if ($subject) {
            return true;
        } else {
            return false;
        }
    }
}
?>