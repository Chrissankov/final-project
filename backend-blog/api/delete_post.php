<?php

header("Content-Type: application/json");
require "./connect.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["post_id"])) {
    echo json_encode(["error" => "post_id is required"]);
    exit;
}

$postId = $data["post_id"];

$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$success = $stmt->execute([$postId]);

if ($success && $stmt->rowCount() > 0) {
    echo json_encode(["message" => "Post deleted successfully"]);
} else {
    echo json_encode(["error" => "Post not found or already deleted"]);
}
