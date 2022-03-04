<?php $base = strtok($_SERVER["REQUEST_URI"], '?'); ?>

<nav>
    <ul>
        <?php if ($paginator->previous): ?>
            <li> <a href="<?= $base ?>?page=<?= $paginator->previous; ?>">Previous</a></li>
        <?php else: ?>
            Previous
        <?php endif; ?>
        <li>
            <?php if ($paginator->next): ?>
            <a href="<?= $base ?>?page=<?= $paginator->next; ?>">Next</a>
            <?php else: ?>
                Next
        <?php endif; ?>
        </li>
    </ul>
</nav>
