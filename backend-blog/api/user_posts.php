<?php

header("Content-Type: application/json");

require "./connect.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["user_id"])) {
    echo json_encode(["error" => "user_id is required"]);
    exit;
}

$userId = $data["user_id"];

$stmt = $pdo->prepare("
    SELECT posts.id, posts.title, posts.content, posts.user_id, users.name AS author
    FROM posts
    JOIN users ON posts.user_id = users.id
    WHERE posts.user_id = ?
    ORDER BY posts.id DESC
    LIMIT 10
");

$stmt->execute([$userId]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($posts);
