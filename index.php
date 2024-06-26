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
<?php include 'partials/_header.php'; ?>

    
    <!-- Slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/slider1.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/slider2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/slider3.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Category container starts here -->
    <div class="container my-5" id="ques">
        <h4 class="text-center">iDiscuss - Browser Categories</h4>
        <div class="row">
            <!-- Fetch all the categories -->
            <!-- Use a for loop to iterate through categories -->
            <?php
        $sql = "SELECT * FROM `categories`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['category_id'];
    $cat = $row['category_name'];
    $cat_desc = $row['category_description'];
    echo '<div class="col-md-4">
        <div class="card my-3" style="width: 20rem;">
            <img src="https://source.unsplash.com/500x400/?'.$cat.'" class="card-img-top" alt="Images for Category">
            <div class="card-body">
                <h5 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                <p class="card-text">'.substr($cat_desc, 0, 100).'...</p>
                <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
            </div>
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