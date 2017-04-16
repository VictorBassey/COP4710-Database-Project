<?php
$user = 1;
$admin = 2;

if($_SESSION['accountType'] == $user){
    include "navbarUser.html";
} else if ($_SESSION['accountType'] == $admin) {
    include "navbarAdmin.html";
}else{
    include "navbarSuperAdmin.html";
}
?>