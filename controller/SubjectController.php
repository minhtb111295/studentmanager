<?php 
class SubjectController {
    function index() {
        $search = $_GET['search'] ?? NULL;
        $page = PAGE;
        $item_per_page = ITEM_PER_PAGE;

        if ($search) {
            $action = new SubjectRepository;
            $subjects = $action->getByPattern($search, $page, $item_per_page);
            $totalRows = $action->getByPattern($search);
        } else {
            $action = new SubjectRepository;
            $subjects = $action->getAll($page, $item_per_page);
            $totalRows = $action->getAll();
        }

        $countRows = count($totalRows);
        $totalPages = ceil($countRows/$item_per_page);

        require 'view/subject/index.php';
    }

    function create() {
        require 'view/subject/create.php';
    }

    function store() {
        $data = $_POST;
        $action = new SubjectRepository;
        if ($action->save($data)) {
            $_SESSION['success'] = $action->success;
            header('location: /?c=subject');
        } else {
            $_SESSION['error'] = $action->error;
            header('location: /?c=subject');
        }
    }

    function edit() {
        $id = $_GET['id'];
        $action = new SubjectRepository;
        $subject = $action->findByID($id);
        require 'view/subject/edit.php';
    }

    function update() {
        $data = $_POST;
        $action = new SubjectRepository;
        if ($action->update($data)) {
            $_SESSION['success'] = $action->success;
            header('location: /?c=subject');
        } else {
            $_SESSION['error'] = $action->error;
            header('location: /?c=subject');
        }
    }

    function destroy() {
        $id = $_GET['id'];
        $name = $_GET['name'];

        // Kiểm tra xem môn học đã có sinh viên nào đăng ký chưa
        // Nếu đã đăng ký môn học thì hiển thị thông báo không được xóa
        // Nếu chưa đăng ký môn học nào thì sẽ chạy xuống code dưới để xóa
        $action = new RegisterRepository;
        if ($action->checkBySubjectID($id)) {
            $_SESSION['error'] = 'Môn học này đã được đăng ký, không thể xóa!';
            header('location: /?c=subject');
            exit;
        }

        $action = new SubjectRepository;
        if ($action->delete($id, $name)) {
            $_SESSION['success'] = $action->success;
            header('location: /?c=subject');
        } else {
            $_SESSION['error'] = $action->error;
            header('location: /?c=subject');
        }
    }
}
?>