<?php
    session_start();

    $db = mysqli_connect("localhost","root","","login");

    $username = "";
    $password = "";
    $checkbox = "";
    $error = False;
    $usn = $username;
    $psw = $password;

    if(isset($_COOKIE['cookie_username'])){
        $cookie_username = $_COOKIE['cookie_username'];
        $cookie_password = $_COOKIE['cookie_password'];
        $usn = $cookie_username;
        $psw = $cookie_password;

        $sql = "select * from login where username = '$cookie_username'";
        $query = mysqli_query($db,$sql);
        $data = mysqli_fetch_array($query);
        if($data['password'] == $cookie_password){
            $_SESSION['session_username'] = $cookie_username;
            $_SESSION['session_password'] = $cookie_password;
        }
    }

    if(isset($_SESSION['session_username'])){
        if(isset($_POST['login'])){
            header("location:home.php");
        }
    }

    if(isset($_POST['login'])){
        $username   = $_POST['usn'];
        $password   = $_POST['psw'];
        if(isset($_POST['checkbox'])){
            $checkbox   = $_POST['checkbox'];
        }

        if($username == '' or $password == ''){
            echo "<script>alert('Silakan masukkan username dan password anda terlebih dahulu!');</script>";
            $error = True;
        }else{
            $sql = "select * from login where username = '$username'";
            $query = mysqli_query($db,$sql);
            $data   = mysqli_fetch_array($query);

            if($data['username'] != $username){
                echo "<script>alert('Username yang anda masukkan tidak tersedia!');</script>";
                $error = True;
            }elseif($data['password'] != $password){
                echo "<script>alert('Password yang anda masukkan tidak sesuai!');</script>";
                $error = True;
            }
            if($error == False){
                $_SESSION['session_username'] = $username;
                $_SESSION['session_password'] = $password;

                if($checkbox == 1){
                    $cookie_name = "cookie_username";
                    $cookie_value = $username;
                    $cookie_time = time() + (60 * 60 * 24 * 30);
                    setcookie($cookie_name,$cookie_value,$cookie_time,"/");

                    $cookie_name = "cookie_password";
                    $cookie_value = $password;
                    $cookie_time = time() + (60 * 60 * 24 * 30);
                    setcookie($cookie_name,$cookie_value,$cookie_time,"/");
                }
                header("location:home.php");
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <title>Login</title>
    </head>

    <body>
        <div class="container" style="margin-top: 10%">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header" style="background-color: black; color:white;">
                            <b style="font-size:20px;">User Login</b>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="usn" value="<?php echo $usn;?>" placeholder="Masukkan Username" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="psw" value="<?php echo $psw;?>" placeholder="Masukkan Password" class="form-control">
                                </div>

                                <div data-toggle="buttons">
                                    <label class="btn">
                                    <input type="checkbox" name="checkbox" value="1" <?php if($checkbox == '1') echo "checked"?> ><b> Ingat Password</b>
                                    </label>
                                </div>

                                <button type="submit" name="login" class="btn btn-success" style="margin-left:43%; padding-left:24px; padding-right:24px;"><b>Login</b></button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>