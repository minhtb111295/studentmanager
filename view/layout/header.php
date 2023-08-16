<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="../public/vendor/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/vendor/fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <div class="container" style="margin-top:20px;">
    <?php global $c; ?>
        <a href="/" class="<?= $c == 'student' ? 'active' : '' ?> btn btn-info">Students</a>
        <a href="?c=subject" class="<?= $c == 'subject' ? 'active' : '' ?> btn btn-info">Subject</a>
        <a href="?c=register" class="<?= $c == 'register' ? 'active' : '' ?> btn btn-info">Register</a>
        <?php
        $message = '';
        $alert = '';

        if (isset($_SESSION['success'])) {
            $message = $_SESSION['success'];
            unset($_SESSION['success']);
            $alert = 'alert-success';
        } else if (isset($_SESSION['error'])) {
            $message = $_SESSION['error'];
            unset($_SESSION['error']);
            $alert = 'alert-danger';
        }
        ?>

        <?php
        if (!empty($message)) :
        ?>
            <div class="alert <?= $alert ?> mt-2"><?= $message ?></div>
        <?php endif ?>

        <div style="height:20px; margin-top:20px">
        </div>