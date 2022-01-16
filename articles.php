<?php

require "includes/database.php";

$sql = "SELECT * FROM article ORDER BY title";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {

    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
?>

<?php require "includes/header.php" ?>


<?php if (empty($articles)) : ?>
    <p>No records found</p>
<?php else : ?>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <article>
                    <h2><?php echo "<a href=\"\article.php?id={$article['id']}\">{$article['title']}</a>"; ?></h2>
                    <p><?php echo $article['content']; ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php require "includes/footer.php" ?>