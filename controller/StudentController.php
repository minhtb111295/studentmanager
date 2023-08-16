<?php 
class StudentController {
    function index() {
        $page = PAGE;
        $item_per_page = ITEM_PER_PAGE;

        $search = $_GET['search'] ?? NULL;

        if ($search) {
            $action = new StudentRepository;
            $students = $action->getByPattern($search, $page, $item_per_page);
            $totalStudents = $action->getByPattern($search);
            $totalRows = count($totalStudents);
        } else {
            $action = new StudentRepository;
            $students = $action->getAll($page, $item_per_page);
            $totalStudents = $action->getAll();
            $totalRows = count($totalStudents);
        }

        $totalPages = ceil($totalRows/$item_per_page);

        require 'view/student/index.php';
    }

    function create() {
        require 'view/student/create.php';
    }

    function store() {
        $data = $_POST;
        $action = new StudentRepository;
        if ($action->save($data)) {
            $_SESSION['success'] = $action->success;
            header('location: /');
        } else {
            $_SESSION['error'] = $action->error;
            header('location: /');
        }
    }

    function edit() {
        $id = $_GET['id'];
        $action = new StudentRepository;
        $student = $action->findByID($id);
        require 'view/student/edit.php';
    }

    function update() {
        $data = $_POST;
        $action = new StudentRepository;
        if ($action->update($data)) {
            $_SESSION['success'] = $action->success;
            header('location: /');
        } else {
            $_SESSION['error'] = $action->error;
            header('location: /');
        }
    }

    function destroy() {
        $id = $_GET['id'];
        $name = $_GET['name'];

        // Kiểm tra xem sinh viên này đã đăng ký môn học chưa
        // Nếu đã đăng ký môn học thì hiển thị thông báo không được xóa
        // Nếu chưa đăng ký môn học nào thì sẽ chạy xuống code dưới để xóa
        $action = new RegisterRepository;
        if ($action->checkByStudentID($id)) {
            $_SESSION['error'] = 'Sinh viên này đã đăng ký môn học, không thể xóa!';
            header('location: /');
            exit;
        }

        $action = new StudentRepository;
        if ($action->delete($id, $name)) {
            $_SESSION['success'] = $action->success;
            header('location: /');
        } else {
            $_SESSION['error'] = $action->error;
            header('location: /');
        }
    }
}
?>