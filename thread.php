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
        $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=".$id."";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }
    ?>
    <!-- Category container starts here -->
    <div class="container my-3" id="ques">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title;?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis neque corrupti quis accusamus nesciunt velit odio eveniet eius quasi soluta fugiat, doloremque, repellat consequatur aspernatur praesentium quisquam ipsam itaque modi.</p>
            <p><b>Posted By: Harry</b></p>
        </div>
        <h3 class="mt-4">Discussion</h3>
    </div>

    <?php
    include 'partials/_footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>