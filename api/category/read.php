<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instatiate Category object

$category = new Category($db);

// Blog category query
$result = $category->read();
// Get COunt
$num =$result->rowCount();

// Check if any category
if($num > 0) {
    // Category array
    $cat_arr = array();
    $cat_arr['data'] =array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $cat_item = array(
            'id' => $id,
            'name' => $name
        );

        // push to "data"
        array_push($cat_arr['data'], $cat_item);
    }

    echo json_encode($cat_arr);

} else {
    // no categories
    echo json_encode(
        array('message' =>'No categories found')
    );
}