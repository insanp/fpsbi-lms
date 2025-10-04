<div class="col-sm-12 col-md-7 text-right">
    <div class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination">
            <?php
            $pager->setSurroundCount(5);
            ?>
            <?php if ($pager->hasPreviousPage()): ?>
                <li class="paginate_button page-item first">
                    <a href="<?= $pager->getFirst() ?>" class="page-link">First</a>
                </li>
                <li class="paginate_button page-item previous">
                    <a href="<?= $pager->getPreviousPage() ?>" class="page-link">Previous</a>
                </li>
            <?php endif; ?>
            <?php foreach ($pager->links() as $link): ?>
                <li class="paginate_button page-item <?= $link['active'] ? 'active' : '' ?>">
                    <a href="<?= $link['uri'] ?>" class="page-link"><?= $link['title'] ?></a>
                </li>
            <?php endforeach; ?>
            <?php if ($pager->hasNextPage()): ?>
                <li class="paginate_button page-item next">
                    <a href="<?= $pager->getNextPage() ?>" class="page-link">Next</a>
                </li>
                <li class="paginate_button page-item last">
                    <a href="<?= $pager->getLast() ?>" class="page-link">Last</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>