<?php
// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// instantiate category

$category = new Category($db);

// get id
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// get category
$category->read_single();

// create an array
$cat_arr = array(
    'id' => $category->id,
    'name' => $category->name,
);

// make json
print_r(json_encode($cat_arr));
