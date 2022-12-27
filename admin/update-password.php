<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class= "wrapper">
        <h1 style="font-size: 50px;">Şifre Değiştir</h1>

        <br><br><br>

        <?php 
            if(isset($_GET['id'])){
                $id=$_GET['id'];
            }

        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Eski Şifre:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Eski Şifre">
                    </td>
                </tr>

                <tr>
                <td>Yeni Şifre:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="Yeni Şifre">
                    </td>
                </tr>
                <tr>
                    <td>Yeni Şifreyi Tekrar Giriniz:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Yeni Şifreyi Tekrarla">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Şifre Değiştir" class="btn-secondary">
                    </td>
                </tr>



                </table>

        </form>
    </div>
</div>

<?php
    // Submit butonun tiklanabilirligi kontrol edilir.
    if(isset($_POST['submit']))
    {
       //  echo"Butona Tıklandı";
       $id = $_POST['id'];
       $current_password = md5($_POST['current_password']);
       $new_password = md5($_POST['new_password']);
       $confirm_password = md5($_POST['confirm_password']);

       $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password='$current_password'";

       $res = mysqli_query($conn, $sql); //sorguyu execute etme

       if($res==true)
       {
           // Data nin uygun olup olmadigi kontrol edilir.
           $count = mysqli_num_rows($res);
           // Admine ait data nin varligi kontrol edilir.
           if($count==1)
           {
               // Detaylar alinir.
               // echo "Admin Uygun Durumda";
               if($new_password==$confirm_password){
                $sql2 = "UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id = $id";
                $res2 = mysqli_query($conn, $sql2); //sorguyu execute etme

                    if($res2==true)
                    {
                        $_SESSION['change-pwd'] ="<div class='success'> Şifre başarıyla değiştirildi.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        $_SESSION['change-pwd'] ="<div class='error'> Şifre değiştirilemedi.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                     

                    }
                }
                else{
                    $_SESSION['pwd-not-match'] ="<div class='error'> Şifreler aynı değil.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
              
           }
           else
           {
               
            $_SESSION['user-not-found'] ="<div class='error'> Kullanıcı Bulunamadı.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
           }

       
    }
    }
?>

<?php include('partials/footer.php'); ?>