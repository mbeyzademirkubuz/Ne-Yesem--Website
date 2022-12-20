<?php  

include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name'])){  //fotoğraf ismi ve id alındı.
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];    //atama işlemleri yapıldı.

    if($image_name!= ""){
        $path = "../images/category/".$image_name;
        $remove = unlink($path);

        if($remove == false){
            $_SESSION['remove'] = "<div class='error'>Fotoğraf Silinemedi.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }

    }

    $sql = "DELETE FROM tbl_category WHERE id= $id"; //silme komutu
    $res = mysqli_query($conn, $sql);   //kod execute edilir. 
 
    if($res== true){
        $_SESSION['delete'] = "<div class= 'success'> Kategori başarıyla Silindi.</div>";  //ilgili mesaj ekrana basılır. 
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else{

    }

}
    else{
        $_SESSION['delete'] = "<div class= 'error'> Kategori silinemedi.</div>"; //ilgili mesaj ekrana basılır. 
        header('location:'.SITEURL.'admin/manage-category.php');

    }

?>