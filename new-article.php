<?php

require "includes/database.php";
require "includes/article.php";
require "includes/url.php";
require "includes/auth.php";

session_start();

if (!isloggedIn()) {

    die("Unauthorized");
}

// Form variables 
$title = '';
$content = '';
$published_at = '';



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    if (empty($errors)) {
        $conn = getDB();
        $sql = "INSERT INTO article (title, content, published_at)
            VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {

            if (empty($published_at)) {
                $published_at = null;
            }

            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($conn);
                echo "Inserted record with ID : $id";

                redirect("/article.php?id=$id");
            } else {
                echo mysqli_stmt_error($stmt);
            }
        }
    }
}
require "includes/header.php";
?>


<h1>New article</h1>

<?php require "includes/article-form.php" ?>

<?php require "includes/footer.php" ?>