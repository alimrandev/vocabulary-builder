<?php
    session_start();
    $user_id = $_SESSION['id'] ?? '';
    if($user_id){
        header("Location:words.php");
    }
    include_once "function.php";
    $status = $_GET['status'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <title>Vocabulary Builder</title>
    <style>
        body {
            margin-top: 30px;
            background: #eee;
        }

        #action{
            width: 220px;
        }
        .maintitle, .formaction{
            text-align: center;
        }
        .formc{
            margin-top: 30px;
            padding: 20px;
            background: #fff;
        }
    </style>
</head>
<body>
<div class="container" id="main">
    <h1 class="maintitle">
        <i class="fas fa-language"></i>My Vocabularies
    </h1>
    <div class="row navigation">
        <div class="column column-60 column-offset-20">
            <div class="formaction">
                <a href="#" id="login">Login</a> | <a href="#" id="register">Register Account</a> 
            </div>
            <div class="formc">
                <h3>Login</h3>

                <form action="task.php" method="POST" id="form01">
                    <fieldset>
                    <?php if($status) :?>
                        <blockquote>
                            <?php echo getStatusMassgae($status) ?>
                        </blockquote>
                    <?php endif ?>
                        <label for="email">Email</label>
                        <input type="text" placeholder="email address" id="email" name="email">
                        <label for="password">Password</label>
                        <input type="password" placeholder="password" id="password" name="password">
                        <input type="submit" value="Submit">
                        <input type="hidden" value="login" name="action" id="action">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="js/script.js"></script>
</html>
