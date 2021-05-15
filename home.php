<?php
    session_start();
    $checkbox1 = "";

    if(!isset($_COOKIE['cookie_username'])){
        $_COOKIE['cookie_username'] = 'Tidak ada';
        $_COOKIE['cookie_password'] = 'Tidak ada';
    }

    if(!isset($_SESSION['session_username'])){
        header("location:login.php");
    }

    if(isset($_POST['checkbox1'])){
        $checkbox1   = $_POST['checkbox1'];
    }

    if(isset($_POST['logout'])){
        if($checkbox1 == 1){
            $_SESSION['session_username'] = "";
            $_SESSION['session_password'] = "";
            session_destroy();

            $cookie_name = "cookie_username";
            $cookie_value = "";
            $time = time() - (60 * 60);
            setcookie($cookie_name,$cookie_value,$time,"/");

            $cookie_name = "cookie_password";
            $cookie_value = "";
            $time = time() - (60 * 60);
            setcookie($cookie_name,$cookie_value,$time,"/");
        }

        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <title>Home</title>
    </head>

    <body>
        <div style="margin:3%">
            <p><b>Session yang tersimpan sebagai berikut</b></p>
                <div style="display:flex;">
                    <p>Session Username  : </p><?php print_r($_SESSION['session_username']);?>
                </div>
                <div style="display:flex;">
                    <p>Session Password  : </p><?php print_r($_SESSION['session_password']);?>
                </div>
            <p><b>Cookie yang tersimpan sebagai berikut</b></p>
                <div style="display:flex;">
                    <p>Cookie Username  : </p><?php print_r($_COOKIE['cookie_username']);?>
                </div>
                <div style="display:flex;">
                    <p>Cookie Password  : </p><?php print_r($_COOKIE['cookie_password']);?>
                </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header" style="background-color: black; color:white;">
                            <b style="font-size:20px;">Logout</b>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <p class="text-center"><b>Klik Logout untuk keluar sistem</b></p>
                                <div style="display:flex; flex-direction:column; justify-content:space-evenly;">
                                    <label class="btn">
                                    <input type="checkbox" name="checkbox1" value="1" <?php if($checkbox1 == '1') echo "checked"?> > Lupakan Password
                                    </label>
                                    <button type="submit" name="logout" class="btn btn-danger" style="margin-left:30%; margin-right:30%;"><b>Logout</b></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>