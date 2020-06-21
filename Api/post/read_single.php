<?php

//Headers
header('Access-Control-Allow-Origin');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

//instantiate blog post object
$post = new Post($db);

// Get ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get post
$row = $post->readSingle();

extract($row);

$post_arr = [
    'id' => $id,
    'title' => $title,
    'body' => $body,
    'author' => $author,
    'category_id' => $category_id,
    'category_name' => $category_name
];

// Make JSON
print_r(json_encode($post_arr));
