<?php

include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])){
        
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name!= ""){
            $path ="../images/food/".$image_name;

            $remove = unlink($path);

            if($remove==false){
                $_SESSION['upload']= "<div class='error'>Fotoğraf silinemedi.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

            $sql= "DELETE FROM tbl_foo WHERE id=$id";
            $res= mysqli_query($conn, $sql);

            if($res==true){
                $_SESSION['delete']= "<div class= 'success'>Yemek silindi.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else {
                $_SESSION['delete']= "<div class= 'error'>Yemek silinemedi.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }



        }


    
    else{
        
        $_SESSION['unautherized']= "<div class='error'>Yetkisiz Erişim!</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

    }

?>