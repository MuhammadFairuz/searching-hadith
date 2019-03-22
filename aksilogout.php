<?php
/**
 * Created by PhpStorm.
 * User: fairuz
 * Date: 12/6/2017
 * Time: 3:42 PM
 */
session_start();
session_destroy();
header('location:index.php');
?>