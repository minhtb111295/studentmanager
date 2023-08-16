<?php 
class RegisterController {
    function index() {
        $search = $_GET['search'] ?? NULL;
        $page = PAGE;
        $item_per_page = ITEM_PER_PAGE;

        if ($search) {
            $action = new RegisterRepository;
            $registers = $action->getByPattern($search, $page, $item_per_page);
            $totalRows = $action->getByPattern($search);
        } else {
            $action = new RegisterRepository;
            $registers = $action->getAll($page, $item_per_page);
            $totalRows = $action->getAll();
        }

        $countRows = count($totalRows);
        $totalPages = ceil($countRows/$item_per_page);

        require 'view/register/index.php';
    }

    function create() {
        $action = new StudentRepository;
        $students = $action->getAll();
        $action = new SubjectRepository;
        $subjects = $action->getAll();
        require 'view/register/create.php';
    }

    function store() {
        $data = $_POST;
        $action = new RegisterRepository;
        if ($action->save($data)) {
            $_SESSION['success'] = $action->success;
            header('location: /?c=register');
        } else {
            $_SESSION['error'] = $action->error;
            header('location: /?c=register');
        }
        var_dump($_POST);
    }

    function edit() {
        $id = $_GET['id'];
        $action = new RegisterRepository;
        $register = $action->findByID($id);
        require 'view/register/edit.php';
    }

    function update() {
        $data = $_POST;
        $action = new RegisterRepository;
        if ($action->update($data)) {
            $_SESSION['success'] = $action->success;
            header('location: /?c=register');
        } else {
            $_SESSION['error'] = $action->error;
            header('location: /?c=register');
        }
    }

    function destroy() {
        $id = $_GET['id'];
        $student_name = $_GET['student_name'];
        $action = new RegisterRepository;
        if ($action->delete($id, $student_name)) {
            $_SESSION['success'] = $action->success;
            header('location: /?c=register');
        } else {
            $_SESSION['error'] = $action->error;
            header('location: /?c=register');
        }
    }
}
?>