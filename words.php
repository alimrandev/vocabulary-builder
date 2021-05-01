<?php
require_once "function.php";
session_start();
$user_id = $_SESSION['id'] ?? '';
if(!$user_id){
    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Words</title>
</head>
<body>  
    <div class="display">
        <div class="display__left">
            <div class="display__menu">
                <h3 class="menu__title">Menu</h3>
                <a href="words.php" class="menu__item" data-target="#words">All Words</a>
                <a href="#" class="menu__item" data-target="#add">Add New Word</a>
                <a href="logout.php" class="logout">Logout</a>
            </div>
        </div>
        <div class="display__right">
            <h3 class="display__title">My Vocabularies</h3>
            <div class="add__form helement" style="display: none;" id="add" >
                <h3>Add New Word</h3>
                <form action="task.php" id="addForm" method="POST">
                    <label for="word">Word</label>
                    <input type="text" name="word" id="word">
                    <label for="meaning">Meaning</label>
                    <input type="text" name="meaning" id="meaning">
                    <input type="hidden" name="action" value="addWord">
                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                    <input type="submit" name="" id="submit" value="Submit">
                </form>
            </div>
            <div class="display__table helement" id="words">
                <div class="display__table__top">
                    <select name="" id="findWords">
                        <option value="all">#All</option>
                        <?php 
                            $charters = getWords($user_id);
                            $length = count($charters);
                            ?>
                        <?php if($length > 0):?>
                            <?php foreach($charters as $charecter):?>
                                <?php $char = $charecter['word'][0]?>
                                <?php echo $char ?>
                                 <option value="<?php echo strtolower($char)?>">#<?php  echo strtoupper($char)?></option>
                            <?php endforeach?>
                        <?php endif?>
                    </select>
                    <form action="words.php" method="POST" id="search-form">
                        <input type="text" placeholder="Search" name="search-words" id="search-input">
                        <input type="submit" name="search-submit" value="Submit">
                    </form>
                </div>
                <div class="display__table__bottom">
                    <table>
                        <thead>
                            <tr>
                                <th>Wrod</th>
                                <th>Defination</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(isset($_POST['search-words'])){
                                    $serchedWords = $_POST['search-words'];
                                    $words = getWords($user_id, $serchedWords);
                                }else{
                                    $words = getWords($user_id);
                                    $length = count($words);
                                }
                            ?>
                            <?php if($length > 0):?>
                                <?php foreach($words as $word):?>
                            <tr class="words">
                                <td><?php echo $word['word'] ?></td>
                                <td><?php echo $word['meaning'] ?></td>
                            </tr>
                                <?php endforeach ?>
                            <?php endif?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="js/script.js"></script>
</html>