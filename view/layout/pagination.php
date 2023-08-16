<nav aria-label="Page navigation">
    <ul class="pagination justify-content-end">
        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
            <a class="page-link" onclick="goToPage(<?= $page - 1 ?>)" aria-label="Previous">
                <span aria-hidden="true">Previous</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <li class="page-item <?= $page == $i ? 'active' : '' ?>"><a class="page-link" onclick="goToPage(<?= $i ?>)"><?= $i ?></a></li>
        <?php endfor ?>
        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
            <a class="page-link" onclick="goToPage(<?= $page + 1 ?>)" aria-label="Next">
                <span aria-hidden="true">Next</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>