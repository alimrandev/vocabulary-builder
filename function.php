<?php
include_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);

if(!$connection){
    throw new Exception("Can't connect to the database");
}
function getStatusMassgae($statusCode){
    $status = [
        '0' => '',
        '1' => 'Duplicate email address',
        '2' => 'eamil or password empty',
        '3' => 'user successfully added',
        '4' => 'Useremail and Password don\'t match',
        '5' => 'User dosen\'t exist please register for a new user',
    ];

    return $status[$statusCode];
}

function getWords($user_id , $serchedWords = null){
    global $connection;
    if($serchedWords){
        $query = "SELECT * FROM words WHERE user_id = '$user_id' AND word LIKE '{$serchedWords}%' ORDER BY word";    
    }else{
        $query = "SELECT * FROM words WHERE user_id = '$user_id' ORDER BY word";
    }
    $result = mysqli_query($connection, $query);
    $data = [];
    while($_data = mysqli_fetch_assoc($result)){
        array_push($data, $_data);
    }
    return $data;
}
