<?php

require 'includes/init.php';

$conn = require 'includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 4, Article::getTotal($conn));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

?>
<?php require 'includes/header.php'; ?>

<?php if (empty($articles)) : ?>
    <p>No articles found.</p>
<?php else : ?>

    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <article>
                    <h2><a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a></h2>

                    <?php if ($article['category_names']) : ?>
                        <p>Categories:
                            <?php foreach ($article['category_names'] as $name) : ?>
                                <?= htmlspecialchars($name); ?>
                            <?php endforeach; ?>
                        </p>
                    <?php endif; ?>

                    <p><?= htmlspecialchars($article['content']); ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php require 'includes/pagination.php'; ?>

<?php endif; ?>


<h4>AJAX Example</h4>

<dl>
    <dt>Name</dt>
    <dd id="name"></dd>

    <dt>email</dt>
    <dd id="email"></dd>

    <dt>Date of birth</dt>
    <dd id="dob"></dd>
</dl>

<button id="btn">Get data</button>

<?php require 'includes/footer.php'; ?>

<script type="text/javascript">
    $('#btn').on("click", function() {
        $.ajax("getdata.php")
            .done(function(data) {
                var json = JSON.parse(data);

                $("#name").html(json.name);
                $("#email").html(json.email);
                $("#dob").html(json.dob);
            })
    });
</script>
