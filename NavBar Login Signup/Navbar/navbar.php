<?php
$user = 1;

if($_SESSION['accountType'] == $user){
    include "navbarUser.html";
} else {
    include "navbarAdmin.html";
}
?>