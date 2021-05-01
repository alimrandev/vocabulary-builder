<?php 
session_start();
include_once "config.php";

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
mysqli_set_charset($connection, "UTF-8");

if(!$connection){
    throw new Exception("Can't connect to the database");
}else{
    $status = 0;
    $action = $_POST['action'] ?? '';
    if("register" == $action){
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if($email && $password){
            //if email and password available 
            $password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO users(email, password) VALUES ('{$email}', '{$password}')";
            mysqli_query($connection, $query);
            $result = mysqli_error($connection);
            if($result){
                $status = 1;
            }else{
                $status = 3;
            }
        }else{
            $status = 2;
        }
    }elseif("login" == $action){
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        if($email && $password){
            $query = "SELECT id,password FROM users WHERE email = '{$email}'";
            $result = mysqli_query($connection, $query);
            if(mysqli_num_rows($result) > 0){
                $data = mysqli_fetch_assoc($result);
                $_password = $data['password'];
                $_id = $data['id'];
                if(password_verify($password, $_password)){
                    $_SESSION['id'] = $_id;
                    header("Location:words.php");
                    die();
                }else{
                    $status = 4;
                }
            }else{
                $status = 5;
            }
        }else{
            $status = 2;
        }
    }elseif("addWord" == $action){
        $word = $_POST['word'] ?? '';
        $meaning = $_POST['meaning'] ?? '';
        $user_id = $_POST['user_id'] ?? '';
        if($word && $meaning && $user_id){
            $query = "INSERT INTO words(word,meaning,user_id) VALUES ('{$word}' , '{$meaning}' , '{$user_id}')";
            mysqli_query($connection, $query);
            header("Location:words.php");
        }
    }

    header("Location:index.php?status={$status}");
}

mysqli_close($connection);