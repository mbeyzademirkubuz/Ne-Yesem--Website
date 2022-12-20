<?php include('config/constants.php'); ?>

<html>
    <head>
        <title>Giriş Ekranı</title>
        <link rel="stylesheet" href="css/admin.css">
    </head>

    <body>

        <div class="login">
            <h1 class="text-center">Giriş Yap</h1>
            <br><br>

            <?php

                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset( $_SESSION['no-login-message']))
                {
                    echo  $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }

            ?>
            <br><br>

            <!--Giris programı burada baslar -->
            <form action=""method="POST" class="text-center">
                Adınızı giriniz: <br><br>
                <input class="text-center" type="text" name="customer_name" placeholder="Adınızı giriniz." size="50" style="height: 30px; font-size:10pt;"  ><br><br>
                Şifre: <br><br>
                <input class="text-center" type="password" name="password" placeholder="Şifreyi giriniz." size="50" style="height: 30px; font-size:10pt;"><br><br><br>
                <input type="submit" name="submit" value="Login" style= "height: 60px; width: 200px" class="btn-primary">
                <br><br>

            </form>
            <!--Giris programı burada biter -->

        </div>
        

    </body>
</html>

<?php

    if(isset($_POST['submit']))
    {
        $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']); //kullanıcı adı yanlış girildiğinde sitenin hata vermemesi için ilgili fonksiyon kullanılmıştır.
        
        $raw_password= md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password); //md5 fonksiyonu şifreyi çözmek için kullanılmaktadır.

        $sql = "SELECT * FROM tbl_customer WHERE customer_name='$customer_name' AND password='$password'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='success text-center'>Login Succesfull.</div>";
            $_SESSION['user'] = $customer_name;
            header('location:'.SITEURL);

        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'login-front.php');

        }
    }

?>