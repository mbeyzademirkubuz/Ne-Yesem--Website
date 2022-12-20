<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1 style="font-size: 50px;">Admin Ekle</h1>

        <br> <br>

        <?php  
            if(isset($_SESSION['add'])){  //Checking whether the Session is Set of Not
                echo $_SESSION['add']; //session mesajı verir
                unset($_SESSION['add']); //session mesajını kaldırır
            }
        ?>
        <br><br><br> 

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Adınızı Giriniz.">
                    </td>
                </tr>

                <tr>
                    <td>Kullanıcı Adı: </td>
                    <td>
                        <input type="text" name="username" placeholder="Kullanıcı adını giriniz:">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name= "password" placeholder="Şifrenizi giriniz.">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value= "Admin Ekle" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    //Process

    if(isset($_POST['submit']))
    {
        //buton clicced
        //echo "Butona Basıldı";
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encryption with MD5

        //Veritabanına kaydetmek için SQL sorgusu
        $sql ="INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        "; 
        
            //Veritabanına kayıt için 3. Execute sorgusu
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if ($res==TRUE)
        {
            //echo "Veri eklendi.";
            //Session değşikeni oluşturma
            $_SESSION['add']= "Admin başarıyla eklendi!";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');

        }
        else
        {
            //echo "Veri Insert Edilemedi! Bu veri hali hazırda kayıtlıdır!";
            //Session değşikeni oluşturma
            $_SESSION['add']= "Admin eklenemedi!";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
    
?>