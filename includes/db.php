<?php

$connection =  mysqli_connect("localhost", "root", "", "cms");

if (!$connection) {
    die("Database Connection failed" . mysqli_connect_error());
}
