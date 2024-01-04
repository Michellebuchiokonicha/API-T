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

// Blog post query
$result = $post->read();
// Get COunt
$num =$result->rowCount();

// Check if any posts
if($num > 0) {
    // Post array
    $posts_arr = array();
    $posts_arr['data'] =array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => $author,
            'category_name' => $category_name
        );

        // push to "data"
        array_push($posts_arr['data'], $post_item);
    }

    echo json_encode($posts_arr);

} else {
    // no posts
    echo json_encode(
        array('message' =>'No post found')
    );
}