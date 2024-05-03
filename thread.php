<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #ques{
            min-height:550px;
        }
    </style>
    <title>iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php
    include 'partials/_header.php';
    ?>

    <?php
        $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=".$id."";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];

        $sql2 = "SELECT email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['email'];
    }

    if($noResult) {
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
            <p class="lead">Be the first person to ask a question</p>
        </div>
    </div>';
        echo var_dump($noResult);
    }
    ?>

<?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        //Insert into comment db
        $comment = $_POST['comment'];
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment);

        $userId = $_POST['sno'];

        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_created`) VALUES ('$comment', '$id', '$userId', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }

    if ($showAlert) {
        echo '<div class="alert alert-success" role="alert">
        Your Comment has been Added! Please wait for community to respond
      </div>';
    }
    ?>
    
    <!-- Category container starts here -->
    <div class="container my-3" id="ques">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title;?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis neque corrupti quis accusamus nesciunt velit odio eveniet eius quasi soluta fugiat, doloremque, repellat consequatur aspernatur praesentium quisquam ipsam itaque modi.</p>
            <p><b>Posted By: <em><?php echo $posted_by; ?></em></b></p>
        </div>
        <?php
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            echo '        <div class="container">
            <h1 class="py-2">Post a Comment</h1>
            <form action="'.$_SERVER['REQUEST_URI'].'" method="POST" class="card p-3">
                <input type="hidden" name="sno" value="'.$_SESSION['user_id'].'">
                <div class="mb-3">
                    <label for="desc" class="form-label">Type your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Post Comment</button>
            </form>
        </div>';
        } else {
            echo "<h1 class='py-2'>Post a Comment</h1><p class='mt-2'>You are logged in. Please login to be able to post a Comment</p>";
        }

    ?>


        <div class="container" id="ques">
            <h1 class="py-2">Descussion</h1>
            <?php
             $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id=" . $id . "";
    $result = mysqli_query($conn, $sql);
    $noResult = true;

    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $id = $row['comment_id'];
        $content = $row['comment_content'];
        $comment_time = $row['comment_created'];

        $comment_user_id = $row['comment_by'];

        $sql2 = "SELECT email FROM `users` WHERE sno='$comment_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);

        echo '<div class="d-flex my-4">
                     <div class="flex-shrink-0">
                         <img src="images/userDefault.png" alt="..." width="44px" height="44px">
                     </div>
                     <div class="flex-grow-1 ms-3">
                     <p class="font-weight-bold my-0"><b>'.$row2['email'].' at '.$comment_time.'</b></p>
                         ' . $content . '
                     </div>
                 </div>
                 <hr>';
    }
    if ($noResult) {
        echo '<div class="jumbotron jumbotron-fluid">
                         <div class="container">
                             <p class="lead">Be the first person to write a comment</p>
                         </div>
                     </div>';
    }
    ?>
        </div>
    </div>

    <?php
    include 'partials/_footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>