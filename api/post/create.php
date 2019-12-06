<?php
//Headers
header('Access-Control-Allow_Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instan DB e Connect
$database = new Database();
$db = $database->connect();

//Instan post
$post = new Post($db);

//Get data
$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//Create 
if($post->create()){
    echo json_encode(
        array('message' => 'Post created')
    );
}else{
    echo json_encode(
        array('message' => 'Error. Post not created')
    );
}