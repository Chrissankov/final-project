<?php

header("Content-Type: application/json");

require "./connect.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["post_id"])) {
    echo json_encode(["error" => "post_id is required"]);
    exit;
}

$postId = $data["post_id"];

$postStmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$postStmt->execute([$postId]);
$post = $postStmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo json_encode(["error" => "Post not found"]);
    exit;
}
$commentStmt = $pdo->prepare("
    SELECT comments.content, users.name AS author
    FROM comments
    JOIN users ON comments.user_id = users.id
    WHERE comments.post_id = ?
    ORDER BY comments.id DESC
    LIMIT 15
");
$commentStmt->execute([$postId]);
$comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);

$response = [
    "post" => $post,
    "recent_comments" => $comments
];

echo json_encode($response);
