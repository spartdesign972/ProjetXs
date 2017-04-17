<nav aria-label="Page navigation">
    <ul class="pagination">
        <li <?= ($page == 1) ? 'class="disabled"' : '' ?>><a href="<?= $navigationUrl.'?page='.($page - 1).'&limit='.$limit ?>" aria-label="Précédent"><span aria-hidden="true">&laquo;</span></a></li>
        <?php $totalPages = ceil($total / $limit); for($i = 1; $i <= $totalPages; $i++) : ?>
            <li <?= ($i == $page) ? 'class="active"' : '' ?>><a href="<?= $navigationUrl.'?page='.$i.'&limit='.$limit ?>" ><?= $i . (($i == $page) ? '<span class="sr-only">(current)</span>' : '') ?></a></li>
        <?php endfor; ?>
        <li <?= ($page == $totalPages) ? 'class="disabled"' : '' ?>><a href="<?= $navigationUrl.'?page='.($page + 1).'&limit='.$limit ?>" aria-label="Suivant"><span aria-hidden="true">&raquo;</span></a></li>
    </ul>
</nav>	
