<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 style="font-size: 50px;">Yönetici Güncelle</h1>

        <br><br>

        <?php 
            // 1.Secilen adminin ID si alinir.
            $id=$_GET['id'];

            // 2.Gerekli bilgileri almak icin SQL query olusturulur.
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            // Query calistirilir.
            $res=mysqli_query($conn, $sql);

            // Query nin uyggun olup olmadiig kontrol edilir.
            if($res==true)
            {
                // Data nin uygun olup olmadigi kontrol edilir.
                $count = mysqli_num_rows($res);
                // Admine ait data nin varligi kontrol edilir.
                if($count==1)
                {
                    // Detaylar alinir.
                    // echo "Admin Uygun Durumda";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username =  $row['username'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

             }

        ?>
        
        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Ad ve Soyad:</td>
                <td>
                    <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                </td>
            </tr>

            <tr>
                <td>Kullanıcı Adı:</td>
                <td>
                    <input type="text" name="username" value="<?php echo $username; ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="GÜncelle" class="btn-secondary">
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
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];

       $sql = "UPDATE tbl_admin SET
       full_name = '$full_name',
       username = '$username'
       WHERE id = '$id'       
       ";

       $res = mysqli_query($conn, $sql);

       if($res==true)
       {
        $_SESSION['update'] = "<div class='success'>Admin Başarılı Bir Şekilide Güncellendi.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

       }
       else
       {

        $_SESSION['update'] = "<div class= 'error'>Admin Güncelleme İşlemi Başarısız Oldu.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

       }
    } 

?>


<?php include('partials/footer.php'); ?>