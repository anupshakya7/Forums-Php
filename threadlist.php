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
    <?php
    include 'partials/_header.php';
    ?>

    <?php include 'partials/_dbconnect.php' ?>
    <?php
        $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=".$id."";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <!-- Category container starts here -->
    <div class="container my-3" id="ques">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname;?> Forums</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis neque corrupti quis accusamus nesciunt velit odio eveniet eius quasi soluta fugiat, doloremque, repellat consequatur aspernatur praesentium quisquam ipsam itaque modi.</p>
            <button class="btn btn-success">Learn More</button>
        </div>
        <h1 class="py-2 mt-4">Browser Question</h1>
        <?php
        $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=".$id."";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $id = $row['thread_id'];

        echo '<div class="d-flex my-4">
        <div class="flex-shrink-0">
            <img src="images/userDefault.png" alt="..." width="44px" height="44px">
        </div>
        <div class="flex-grow-1 ms-3">
            <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
            '.$desc.'
        </div>
    </div>
    <hr>';
    }
    ?>
    </div>

    <?php
    include 'partials/_footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>