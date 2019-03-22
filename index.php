<?php
    session_start();
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scalae=1"/>

    <title>Plagiarism Detection</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/bootstrap-table.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <style id="hide-theme">
        body{
            display:none;
        }
    </style>
    <style type="text/css">
        #main {
            background-color:#72a8ff;
            background-color:#001333;
        }
    </style>
    <script type="text/javascript">
        function setTheme(name){
            var theme = document.getElementById('theme-css');
            var style = 'css/theme-' + name + '.css';
            if(theme){
                theme.setAttribute('href', style);
            } else {
                var head = document.getElementsByTagName('head')[0];
                theme = document.createElement("link");
                theme.setAttribute('rel', 'stylesheet');
                theme.setAttribute('href', style);
                theme.setAttribute('id', 'theme-css');
                head.appendChild(theme);
            }
            window.localStorage.setItem('lumino-theme', name);
        }
        var selectedTheme = window.localStorage.getItem('lumino-theme');
        if(selectedTheme) {
            setTheme(selectedTheme);
        }
        window.setTimeout(function(){
            var el = document.getElementById('hide-theme');
            el.parentNode.removeChild(el);
        }, 5);
    </script>
    <!-- End Theme Switcher -->
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>QAS </span> HADITS</a>
        </div>
    </div>
</nav>

<div id="sidbar-collapse" class="col-sm-3 col-lg-2 sidebar" >
<!--<div id="main" class="col-sm-3 col-lg-2 sidebar" >-->
    <div class="profile-sidebar">
        <?php
        if(isset($_SESSION['username']) and isset($_SESSION['password'])) {
            ?>
            <div class="profile-userpic">
                <img src="images/images.png" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">Fairuz</div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
            <?php
        }else {
            ?>
            <div class="profile-userpic">
                <img src="images/user.png" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">Username</div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span></div>
            </div>
            <div class="clear"></div>
            <?php
        }
        ?>
    </div>

    <div class="divider"></div>

    <ul class="nav menu" >
        <li class=""><a href="home.html"><em class="fa fa-home">&nbsp;</em> Home</a></li>

        <li class="parent"><a data-toggle="collapse" href="#sub item 1">
                <em class="fa fa-desktop">&nbsp;</em> Applikasi <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
                <em class="fa fa-chevron-circle-down"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li><a class="" href="search.html">
                        <span class="fa fa-arrow-right">&nbsp;</span> QAS Hadith
                    </a></li>
                <li><a class="" href="training.html">
                        <span class="fa fa-arrow-right">&nbsp;</span> Data Set
                    </a></li>
            </ul>
        </li>

        <li class="parent"><a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-recycle">&nbsp;</em> Preprocessing <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right">
                <em class="fa fa-chevron-circle-down"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li><a class="" href="preprocessing.html">
                        <span class="fa fa-arrow-right">&nbsp;</span> Preprocessing
                    </a></li>
                <li><a class="" href="lihatindeks.html">
                        <span class="fa fa-arrow-right">&nbsp;</span> Indexing
                    </a></li>
            </ul>
        </li>

        <?php
            if (isset($_SESSION['username']) and isset($_SESSION['password'])) {
                ?>
                <li><a href="aksilogout.php"><em class="fa fa-power-off">&nbsp;</em>Logout</a></li>
                <?php
            }else{
             ?>
                <li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em>Login</a></li>
                <?php
            }
            ?>
    </ul>
</div>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php
        include "modul.php";
    ?>
</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/bootstrap-table.js"></script>
<script src="js/custom.js"></script>

</body>
</html>