<?php 
class StudentRepository {

    public $success;
    public $error;


    protected function fetch($cond, $limit) {
        global $conn;
        $students = [];
        $sqlQuery = "SELECT * FROM student";

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
                $name = $row['name'];
                $birthday = $row['birthday'];
                $gender = $row['gender'];
                $student = new Student($id, $name, $birthday, $gender);
                $students[] = $student;
            }
        }
        return $students;
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
        return $this->fetch($cond, $limit);
    }

    function getByPattern($search, $page=NULL, $item_per_page=NULL) {
        $cond = "name LIKE '%$search%'";
        $limit = $this->buildLimit($page, $item_per_page);
        return $this->fetch($cond, $limit);
    }

    function save($data) {
        $name = $data['name'];
        $birthday = $data['birthday'];
        $gender = $data['gender'];
        global $conn;
        $sqlQuery = "INSERT INTO student (name, birthday, gender) VALUES ('$name', '$birthday', '$gender')";
        if ($conn->query($sqlQuery)) {
            $this->success = "Đã thêm sinh viên $name thành công";
            return true;
        } else {
            $this->error = "Lỗi $sqlQuery <br> $conn->error";
            return false;
        }
    }

    function findByID($id) {
        $cond = "id=$id";
        $limit = NULL;
        $students = $this->fetch($cond, $limit);
        $student = current($students);
        return $student;
    }

    function update($data) {
        $id = $data['id'];
        $name = $data['name'];
        $birthday = $data['birthday'];
        $gender = $data['gender'];
        global $conn;
        $sqlQuery = "UPDATE student SET name='$name', birthday='$birthday', gender='$gender' WHERE id=$id";
        if ($conn->query($sqlQuery)) {
            $this->success = "Đã cập nhật sinh viên $name thành công";
            return true;
        } else {
            $this->error = "Lỗi $sqlQuery <br> $conn->error";
            return false;
        }
    }

    function delete($id, $name) {
        global $conn;
        $sqlQuery = "DELETE FROM student WHERE id=$id";
        if ($conn->query($sqlQuery)) {
            $this->success = "Đã xóa sinh viên $name thành công";
            return true;
        } else {
            $this->error = "Lỗi $sqlQuery <br> $conn->error";
            return false;
        }
    }
}
?>