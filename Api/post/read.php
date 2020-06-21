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

//blog post query
$result = $post->read();

//get row count
$num = $result->rowCount();

//check if any posts
if($num > 0) {
    // Post array
    $post_arr = [];
    $posts_arr['data'] = [];

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = [
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        ];

        array_push($posts_arr['data'], $post_item);
    }

    //Turn to JSON
    echo json_encode($posts_arr);

} else {

}