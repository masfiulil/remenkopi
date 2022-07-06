<?php
session_start();
//koneksi ke database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/css/boostrap.css" rel="stylesheet">
    <link href="assets/css/css/custom.css" rel="stylesheet">
    <link href="assets/css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Login Admin</title>
</head>

<body>
    <!-- Navbar-->
    <nav class="navbar navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img class="navbar-brand" src="assets/img/logo.png" alt=""></a>
        </div>
    </nav>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <br>
                <h2>Login Admin</h2>
                <br>
            </div>
        </div>
        <div>
            <div class="form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Masukkan data dengan benar</strong>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST">
                            <br>
                            <div class="form-group input-group">
                                <label class="label-user">Username</label>
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" name="user" />
                            </div>
                            <div class="form-group input-group">
                                <label class="label-pass">Password</label>
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="password" class="form-control" name="pass" />
                            </div>
                            
                            <button class="btn btn-primary" name="login">Login</button>
                            <hr>
                            
                        </form>
                        <?php
                        if (isset($_POST['login']))
                        {
                            $query = $koneksi->query("SELECT *FROM admin WHERE username='$_POST[user]' AND password ='$_POST[pass]'");
                            $yangcocok = $query->num_rows;
                            if ($yangcocok==1)
                            {
                                $_SESSION['admin']=$query->fetch_assoc();
                                echo "<div class='alert alert-info'>Login Sukses</div>";
                                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                            }
                            else
                            {
                                echo "<div class='alert alert-danger'>Login Gagal</div>";
                                echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>