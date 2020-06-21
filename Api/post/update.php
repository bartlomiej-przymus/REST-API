<?php

//Headers
header('Access-Control-Allow-Origin');
header('Content-Type: application/json');
header('Access-Control-Allow-Mthods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Mthods, Content-Type, Authorization, X-Requested-Width');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

//instantiate blog post object
$post = new Post($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//update
if($post->update())
{
    echo json_encode(
        ['message'=>'Post Updated']
    );
} else {
    echo json_encode(
        ['message'=>'Post Not Updated']
    );
}
