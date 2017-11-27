<?php
$delete=$_GET['file'];
if (isset($_GET['file'])){
unlink("uploads/$delete");
    header('Location: index.php');
}