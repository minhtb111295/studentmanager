<?php 
class SubjectRepository {
    public $success;
    public $error;

    protected function fetch($cond, $limit) {
        global $conn;
        $subjects = [];
        $sqlQuery = "SELECT * FROM subject";
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
                $ects = $row['ects'];
                $subject = new Subject($id, $name, $ects);
                $subjects[] = $subject;
            }
        }
        return $subjects;
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
        $subjects = $this->fetch($cond, $limit);
        return $subjects;
    }

    function getByPattern($search, $page=NULL, $item_per_page=NULL) {
        $cond = "name LIKE '%$search%'";
        $limit = $this->buildLimit($page, $item_per_page);
        $subjects = $this->fetch($cond, $limit);
        return $subjects;
    }

    function save($data) {
        $name = $data['name'];
        $ects = $data['ects'];
        global $conn;
        $sqlQuery = "INSERT INTO subject (name, ects) VALUES ('$name', '$ects')";
        if ($conn->query($sqlQuery)) {
            $this->success = "Thêm môn học $name thành công";
            return true;
        } else {
            $this->error = "Lỗi $sqlQuery <br> $conn->error";
            return false;
        }
    }

    function findByID($id) {
        $cond = "id=$id";
        $limit = NULL;
        $subjects = $this->fetch($cond, $limit);
        $subject = current($subjects);
        return $subject;
    }

    function update($data) {
        $id = $data['id'];
        $name = $data['name'];
        $ects = $data['ects'];
        global $conn;
        $sqlQuery = "UPDATE subject SET name='$name', ects='$ects' WHERE id=$id";
        if ($conn->query($sqlQuery)) {
            $this->success = "Cập nhật môn học $name thành công";
            return true;
        } else {
            $this->error = "Lỗi $sqlQuery <br> $conn->error";
            return false;
        }
    }

    function delete($id, $name) {
        global $conn;
        $sqlQuery = "DELETE FROM subject WHERE id=$id";
        if ($conn->query($sqlQuery)) {
            $this->success = "Xóa môn học $name thành công";
            return true;
        } else {
            $this->error = "Lỗi $sqlQuery <br> $conn->error";
            return false;
        }
    }
}
?>