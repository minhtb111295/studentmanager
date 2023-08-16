<?php require 'view/layout/header.php' ?>
<h1>Danh sách Sinh Viên</h1>
<a href="?a=create" class="btn btn-info">Add</a>
<?php require 'view/layout/search.php' ?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã Sinh Viên</th>
            <th>Tên Sinh Viên</th>
            <th>Ngày Sinh</th>
            <th>Giới Tính</th>
            <th colspan="2">Tùy Chọn</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $serial = 0;
        foreach ($students as $student) :
            $serial++;
        ?>
            <tr>
                <td><?= $serial ?></td>
                <td><?= $student->id ?></td>
                <td><?= $student->name ?></td>
                <td><?= $student->birthday ?></td>
                <td><?= $student->gender ?></td>
                <td><a class="btn btn-warning" href="?a=edit&id=<?= $student->id ?>">Sửa</a></td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger delete" data-href="?a=destroy&id=<?= $student->id ?>&name=<?= $student->name ?>" data-toggle="modal" data-target="#exampleModal">
                        Xóa
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php require 'view/layout/pagination.php' ?>
<div>
    <span>Số lượng: <?= count($students) ?></span>
</div>
<?php require 'view/layout/footer.php' ?>