<?php

header("Content-Type: application/json");

require "./connect.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["comment_id"]) || !isset($data["content"])) {
    echo json_encode(["error" => "comment_id and content are required"]);
    exit;
}

$commentId = $data["comment_id"];
$newContent = $data["content"];

$stmt = $pdo->prepare("UPDATE comments SET content = ? WHERE id = ?");
$success = $stmt->execute([$newContent, $commentId]);

if ($success) {
    echo json_encode(["message" => "Comment updated successfully"]);
} else {
    echo json_encode(["error" => "Failed to update comment"]);
}
