<?php

//$servername = "pdb43.runhosting.com";
//$username = "3254879_harmonex";
//$password = "GOOGLE88";
//$dbname = "3254879_harmonex";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "harmonex";
// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
// Change character set to utf8
mysqli_set_charset($con, "utf8");
// Zone Time
date_default_timezone_set('Asia/Amman');
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

