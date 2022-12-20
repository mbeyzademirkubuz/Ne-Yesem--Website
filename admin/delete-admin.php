<?php

// Constant.php dosyasi dahil edilir.
include('../config/constants.php');

    // 1. Silinecek olan Adminin ID si alinir.
    $id = $_GET['id'];

    // 2. Admini silmek için bir SQL query olusturulur.
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Query calistirilir.
    $res = mysqli_query($conn, $sql); 

    // Query nin basarili bir bicimde execute edilip edilmediği kontrol edilir.
    if($res==true)
    {
        // Query basrili bir sekilde execute edildi.
        //echo"Admin Silindi";
        $_SESSION['delete']= "<div class='success'>Admin Başarılı Bir Şekilde Silindi.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // Admin silme islemi basarisiz oldu.
        //echo"Admin Silme İşlemi Başarısız oldu!";

        $_SESSION['delete'] = "<div class='error'>Admin Silme İşlemi Başarısız Oldu. Lütfen Daha Sonra Tekrar Deneyiniz.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');


    }

// Manage Admin sayfasini hata veya basari ( succes / error) mesaji alindiginda yeniden yonlendirmek icin.


?>