<?php
if(isset($_SESSION['admin'])){
    print '<a href="logout.php" class="btn btn-outline-success my-2 my-sm-0">Log Out</a>';
} else {
    header("location:index.php");
}
?>