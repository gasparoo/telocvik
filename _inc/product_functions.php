<?php

function getHomeProducts()
{
    global $con;

    $sql = "SELECT * FROM products";

    $result = mysqli_query($con, $sql);

    $products = [];
    if (mysqli_num_rows($result) > 0) {

       $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_free_result($result);
    }

   return $products;
}

function getProductByID($id)
{
    global $con;

    $sqlP = "SELECT * FROM products  WHERE id='$id'";
    $sqlI = "SELECT * FROM product_images WHERE product_id='$id'";

    $result_product = mysqli_query($con, $sqlP);
    if(!$result_product) return 0;

    $result_image = mysqli_query($con, $sqlI);
    if(!$result_image) return 0;

    $product = mysqli_fetch_assoc($result_product);
    $images = mysqli_fetch_all($result_image, MYSQLI_ASSOC);
  
    mysqli_free_result($result_image);

    $product_info = [$product, $images];

   return $product_info;
}

function addComment($data)
{
    global $con;

    $user_id = $_SESSION['LOGGED_IN_USER_ID'];
    $post_id = $data['post_id'];
    $comment = $data['comment'];
    $date = $data['date'];

    $sql =   "INSERT INTO comments (user_id, post_id, comment, created_at) VALUES ('{$user_id}', '{$post_id}', '{$comment}', '{$date}')";

    $result = mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) > 0) {

        return true;
    }

   return false;
}

function getComments($post)
{
    global $con;

    $sql = "SELECT comments.*, users.name FROM comments INNER JOIN users ON comments.user_id=users.id WHERE post_id = '{$post}' ORDER BY id DESC";

    $result = mysqli_query($con, $sql);
    if(!$result) return 0;

    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $num_rows = mysqli_num_rows($result);
  
    mysqli_free_result($result);

   return ['comments' => $comments, 'comments_count' => $num_rows];
}

