<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #ques {
            min-height: 550px;
        }
    </style>
    <title>iDiscuss - Coding Forums</title>
</head>

<body>
<?php include 'partials/_dbconnect.php' ?>
<?php include 'partials/_header.php'; ?>

    <?php
    $id = $_GET['catid'];
$sql = "SELECT * FROM `categories` WHERE category_id=" . $id . "";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $catname = $row['category_name'];
    $catdesc = $row['category_description'];
}
?>

    <?php
$showAlert = false;
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    //Insert into thread into db
    $th_title = $_POST['title'];

    $th_title = str_replace('<', '&lt;', $th_title);
    $th_title = str_replace('>', '&gt;', $th_title);

    $th_desc = $_POST['desc'];

    $th_desc = str_replace('<', '&lt;', $th_desc);
    $th_desc = str_replace('>', '&gt;', $th_desc);

    $userId = $_POST['sno'];

    $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `created`) VALUES ('$th_title', '$th_desc', '$id', '$userId', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $showAlert = true;
}

if ($showAlert) {
    echo '<div class="alert alert-success" role="alert">
        Your Thread has been Added! Please wait for community to respond
      </div>';
}
?>

    <!-- Category container starts here -->
    <div class="container my-3" id="ques">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forums</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis neque corrupti quis accusamus nesciunt velit odio eveniet eius quasi soluta fugiat, doloremque, repellat consequatur aspernatur praesentium quisquam ipsam itaque modi.</p>
            <button class="btn btn-success">Learn More</button>
        </div>
        <?php
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
        echo '<div class="container">
            <h1 class="py-2">Start a Discussion</h1>
            <form action="'.$_SERVER['REQUEST_URI'].'" method="POST" class="card p-3">
                <input type="hidden" name="sno" value="'.$_SESSION['user_id'].'">
                <div class="mb-3">
                    <label for="problem_title" class="form-label">Problem Title</label>
                    <input type="text" class="form-control" id="problem_title" name="title" aria-describedby="problem_title_hint">
                    <div id="problem_title_hint" class="form-text">Keep your title as short and crisp as possible</div>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Ellaborate your Concern</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
    } else {
        echo "<h4 class='mt-4'>You are logged in. Please login to be able to start a Discussion</h4>";
    }
?>
    
        <h1 class="py-2 mt-4">Browser Question</h1>
        <?php
$id = $_GET['catid'];
$sql = "SELECT * FROM `threads` WHERE thread_cat_id=" . $id . "";
$result = mysqli_query($conn, $sql);
$noResult = true;

while ($row = mysqli_fetch_assoc($result)) {
    $noResult = false;
    $title = $row['thread_title'];
    $desc = $row['thread_desc'];

    $id = $row['thread_id'];
    $thread_time = $row['created'];
    $thread_user_id = $row['thread_user_id'];

    $sql2 = "SELECT email FROM `users` WHERE sno='$thread_user_id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);



    echo '<div class="d-flex my-4">
        <div class="flex-shrink-0">
            <img src="images/userDefault.png" alt="..." width="44px" height="44px">
        </div>
        <div class="flex-grow-1 ms-3">
            <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
            ' . $desc . '
            <p class="font-weight-bold my-0"><b>Added By: '.$row2['email'].'</b> at '.$thread_time.'</p>
        </div>
    </div>
    <hr>';
}
if ($noResult) {
    echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
                <p class="lead">Be the first person to ask a question</p>
            </div>
        </div>';
}
?>


    </div>

    <?php
include 'partials/_footer.php';
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>