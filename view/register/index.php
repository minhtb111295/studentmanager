<?php require 'view/layout/header.php' ?>
<h1>Danh sách sinh viên đăng ký môn học</h1>
<a href="?c=register&a=create" class="btn btn-info">Add</a>
<?php require 'view/layout/search.php' ?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã Sinh Viên</th>
            <th>Tên Sinh Viên</th>
            <th>Mã Môn Học</th>
            <th>Tên Môn Học</th>
            <th>Điểm</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $serial = 0;
        foreach ($registers as $register) :
            $serial++;
        ?>
            <tr>
                <td><?= $serial ?></td>
                <td><?= $register->student_id ?></td>
                <td><?= $register->student_name ?></td>
                <td><?= $register->subject_id ?></td>
                <td><?= $register->subject_name ?></td>
                <td><?= $register->score ?></td>
                <td><a class="btn btn-warning" href="?c=register&a=edit&id=<?= $register->id ?>">Cập nhật điểm</a></td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger delete" data-href="?c=register&a=destroy&id=<?= $register->id ?>&student_name=<?= $register->student_name ?>" data-toggle="modal" data-target="#exampleModal">
                        Xóa
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php require 'view/layout/pagination.php' ?>
<div>
    <span>Số lượng: <?= count($registers) ?></span>
</div>
<?php require 'view/layout/footer.php' ?>