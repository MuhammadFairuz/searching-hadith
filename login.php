<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>

    <![endif]-->
</head>

<body>

<script type="text/javascript">
    function login() {
        var user = $("#username").val();
        var pass = $("#password").val();
        $.ajax({
            type: "POST",
            url: "aksiLogin.php",
            data: {username : user, password : pass},
            error:function(){
                $("#notif").prepend("gagal");
            },
            success: function (html) {
                $("#notif").text("");
                $("#notif").prepend("<code>"+html+"</code>");

                if(html!="Username atau Password salah!"){
                    window.location="index.php";
                }
            },
        });
        return false;
    }

</script>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="title" style="border: mediumblue">
            <h2 style="text-align: center">Plagiarism Detection</h2>
        </div>
        <div class="login-panel panel panel-default">

            <div class="panel-heading" style="text-align: center">Login</div>
            <div class="panel-body">
                <form role="form">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Username" name="username" id="username" type="username" autofocus="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>
                        <a class="btn btn-primary" onclick="login()" style="width: 100%; height: 100%;">Login</a>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />
                            <div>

                                <p>Sudah Punya Akun?<a href="signup.php">SignUp</a></p>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>