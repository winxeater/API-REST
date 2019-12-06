<?php
//Headers
header('Access-Control-Allow_Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

//Set ID to update
$post->id = $data->id;


//Delete 
if($post->update()){
    echo json_encode(
        array('message' => 'Post deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Error. Post not deleted')
    );
}