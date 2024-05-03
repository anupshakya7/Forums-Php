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

        .container {
            min-height: 100vh;
        }
    </style>
    <title>iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/_header.php' ?>

    <!-- Search Results -->
    <div class="container my-3">
    <h1>Search Results for "<em><?php echo $_GET['query'] ?></em>"</h1>
        <?php
        $noresults = true;
    $sql = "SELECT * FROM `threads` WHERE match(thread_title,thread_desc) against ('".$_GET['query']."');";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $noresults = false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $description = $row['thread_desc'];

        //Display the search result
        echo '<div class="d-flex my-4">
        <div class="flex-shrink-0">
            <img src="images/userDefault.png" alt="..." width="44px" height="44px">
        </div>
        <div class="flex-grow-1 ms-3">
            <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
            '.$description.'
        </div>
    </div>';
    }

    if($noresults) {
        echo '<div class="alert alert-danger" role="alert">
        No Result Found
      </div>';
    }
    ?>
    </div>


    <!-- Search Results -->

    <?php include 'partials/_footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>