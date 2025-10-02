<div class="col-sm-12 col-md-7 text-right">
    <div class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination">
            <?php if ($pager->hasPrevious()) : ?>
                <li class="paginate_button page-item previous">
                    <a href="<?= $pager->getPreviousPage() ?>" class="page-link">Previous</a>
                </li>
            <?php endif ?>

            <?php foreach ($pager->links() as $link): ?>
                <li class="paginate_button page-item <?= $link['active'] ? 'active' : '' ?>">
                    <a href="<?= $link['uri'] ?>" class="page-link"><?= $link['title'] ?></a>
                </li>
            <?php endforeach ?>

            <?php if ($pager->hasNext()) : ?>
                <li class="paginate_button page-item next">
                    <a href="<?= $pager->getNextPage() ?>" class="page-link">Next</a>
                </li>
            <?php endif ?>
        </ul>
    </div>
</div>