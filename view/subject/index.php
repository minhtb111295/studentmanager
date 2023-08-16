<?php require 'view/layout/header.php' ?>
<h1>Danh sách Môn Học</h1>
<a href="?c=subject&a=create" class="btn btn-info">Add</a>
<?php require 'view/layout/search.php' ?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã Môn Học</th>
            <th>Tên Môn Học</th>
            <th>Số tín chỉ</th>
            <th colspan="2">Tùy Chọn</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $serial = 0;
        foreach ($subjects as $subject) :
            $serial++;
        ?>
            <tr>
                <td><?= $serial ?></td>
                <td><?= $subject->id ?></td>
                <td><?= $subject->name ?></td>
                <td><?= $subject->ects ?></td>
                <td><a class="btn btn-warning" href="?c=subject&a=edit&id=<?= $subject->id ?>">Sửa</a></td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger delete" data-href="?c=subject&a=destroy&id=<?= $subject->id ?>&name=<?= $subject->name ?>" data-toggle="modal" data-target="#exampleModal">
                        Xóa
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php require 'view/layout/pagination.php' ?>
<div>
    <span>Số lượng: <?= count($subjects) ?></span>
</div>
<?php require 'view/layout/footer.php' ?>