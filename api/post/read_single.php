<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';


// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instatiate blog post object

$post = new Post($db);

// get id
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// get post

$post->read_single();

// create an array
$posts_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' =>$post->author,
    'category_id' => $post->category_id,
    'category_name' =>$post->category_name
);

// makejson
print_r(json_encode($posts_arr));