<?php
//Headers
header('Access-Control-Allow_Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instan DB e Connect
$database = new Database();
$db = $database->connect();

//Instan post
$post = new Post($db);

//Blog post query
$result = $post->read();
//Get row count
$num = $result->rowCount();

//Check se existe posts
if($num > 0){
    //Post array
    $posts_arr = array();
    $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name,
        );

        //push "data"
        array_push($posts_arr['data'], $post_item);
    }
    //turn to Json & output
    echo json_encode($posts_arr);

}else{
    //No posts
    echo json_encode(
        array('message' => 'No posts Found')
    );
}