<?php

session_start();

session_destroy();
header('location: /codewithharry/Forums-Php/index.php');
