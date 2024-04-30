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
            <a class="nav-link active" aria-current="page" href="codewithharry/Forums-Php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Category
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php" >Contact</a>
          </li>
        </ul>';
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    echo '<form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
          <span class="text-white mx-3">Welcome '.$_SESSION['email'].'</span>
          <button class="btn btn-success">Logout</button>
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
