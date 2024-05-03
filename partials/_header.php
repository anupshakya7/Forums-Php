<?php

session_start();

echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/codewithharry/Forums-Php">iDiscuss</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/codewithharry/Forums-Php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Top Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
$sql = "SELECT  category_id,category_name FROM `categories` LIMIT 3";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    echo '<li><a class="dropdown-item" href="/codewithharry/Forums-Php/threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
}
echo '</ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php" >Contact</a>
          </li>
        </ul>';
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    echo '<form class="d-flex" action="/codewithharry/Forums-Php/search.php" method="GET">
          <input class="form-control me-2" style="width:100px;" type="search" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
          <span class="btn btn-secondary text-white mx-3">'.$_SESSION['email'].'</span>
          <a href="/codewithharry/Forums-Php/partials/_logout.php" class="btn btn-success">Logout</a>
        </form>';
} else {
    echo '<form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
        <div class="mx-2 text-center my-2">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign Up</button>
        </div>';
}

echo '</div>
    </div>
  </nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-success" role="alert">
    You can now login!
  </div>';
}

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
    echo '<div class="alert alert-danger" role="alert">
     Error!!!
</div>';
}

if(isset($_GET['success']) && $_GET['success'] == "false") {
    echo '<div class="alert alert-danger mb-0" role="alert">
     '.$_GET['error'].'
</div>';
}
