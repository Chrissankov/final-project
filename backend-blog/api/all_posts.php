<?php

header("Content-Type: application/json");

require "./connect.php";

$sql = "
    SELECT 
        posts.id,
        posts.title,
        posts.content,
        users.name AS author,
        (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comment_count
    FROM posts
    JOIN users ON posts.user_id = users.id
    ORDER BY posts.id DESC
";

try {
    $stmt = $pdo->query($sql);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($posts);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
