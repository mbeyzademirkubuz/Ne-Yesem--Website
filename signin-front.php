<?php include ('config/constants.php') ?>

<head>
        <title>Giriş Ekranı</title>
        <link rel="stylesheet" href="css/admin.css">
</head>

    <div class="login">
        <h1 class="text-center">Kayıt Ol</h1>
        <?php  
            if(isset($_SESSION['add'])){  //Checking whether the Session is Set of Not
                echo $_SESSION['add']; //session mesajı verir
                unset($_SESSION['add']); //session mesajını kaldırır
            }
        ?>
        <br><br>

        <form action="" method="POST" class= "text-center">
            <table class="tbl-30">
                <tr>
                    <td style="font-size:70%">Ad ve Soyad</td>
                    <td>
                        <input class= "text-center" type="text" name="full_name" placeholder="Adınızı Giriniz." size="50" style="height: 30px; font-size:10pt">
                    </td>
                </tr>

                <tr>
                    <td style="font-size:70%">Telefon Numarası </td>
                    <td>
                        <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required size="50" style="height: 30px; font-size:10pt">
                    </td>
                </tr>
                <tr>
                    <td style="font-size:70%">Email: </td>
                    <td>
                        <input class= "text-center" type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required size="50" style="height: 30px; font-size:10pt">
                    </td>
                </tr>
                <tr>
                    <td style="font-size:70%">Adres: </td>
                    <td>
                        <textarea class= "text-center" name="address" rows="30" placeholder="E.g. Street, City, Country" class="input-responsive" size="50" style="height: 50px; width:385px; font-size:10pt" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:70%">Password: </td>
                    <td>
                        <input class= "text-center" type="password" name= "password" placeholder="Şifrenizi giriniz." size="50" style="height: 30px; font-size:10pt;">
                    </td>
                </tr>

                <tr>
                    <td colspan="5">
                        <input class= "text-center" type="submit" name="submit" value= "Kullanıcı Oluştur" class="btn-secondary" size="50" style="height: 30px; font-size:10pt;" >
                    </td>
                </tr>
            </table>

        </form>



</div>

<?php
    //Process

    if(isset($_POST['submit']))
    {
        //buton clicced
        //echo "Butona Basıldı";
        $full_name = $_POST['full_name'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = md5($_POST['password']); //password encryption with MD5

        //Veritabanına kaydetmek için SQL sorgusu
        $sql ="INSERT INTO tbl_customer SET 
            customer_name='$full_name',
            customer_contact='$contact',
            customer_email='$email',
            customer_address='$address',
            password='$password'
        "; 
        
            //Veritabanına kayıt için 3. Execute sorgusu
        $res = mysqli_query($conn, $sql);

        if ($res==TRUE)
        {
            //echo "Veri eklendi.";
            //Session değşikeni oluşturma
            $_SESSION['add']= "Admin başarıyla eklendi!";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'foods.php');
        }
        else
        {
            //echo "Veri Insert Edilemedi! Bu veri hali hazırda kayıtlıdır!";
            //Session değşikeni oluşturma
            $_SESSION['add']= "Admin eklenemedi!";
            //Redirect Page to Add Admin
            header("location:".SITEURL);
        }

    }
    
?>