<?php include('partials/menu.php'); ?>

<div class= "main-content"> 
    <div class="wrapper"> 
        <h1 style="font-size: 50px;">Kategori Güncelle</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){

                $id= $_GET['id'];
                $sql= "SELECT * FROM tbl_category WHERE id =$id";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured= $row['featured'];
                    $active = $row['active'];
                    
                }
                else{
                    $_SESSION['no-category-found'] = "<div class='error'>Kategori Bulunamadı.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
            else{
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method ="POST" enctype ="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Yemek Adı: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Yemek Fotoğraf: </td>
                <td>
                    <?php 
                        if($current_image!= ""){
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                            <?php

                        }
                        else{
                            echo "<div class='error'> Fotoğraf Eklenmedi.</div>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Yeni Fotoğraf: </td>
                <td>
                <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Öne Çıkan:</td>
                <td>
                     <input <?php if($featured== "Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes

                     <input <?php if($featured== "No"){echo "checked";}?> type="radio" name="featured" value="No">No

                </td>
            </tr>

            <tr>
                <td>Aktif:</td>
                <td>
                     <input <?php if($featured== "Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes

                     <input <?php if($featured== "No"){echo "checked";}?> type="radio" name="active" value="No">No

                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Güncelle" class="btn-secondary">
                </td>
            </tr>

           

        </table>
        </form>

        <?php 
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];
                    if($image_name!=""){

                        
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destionation_path ="../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path,$destionation_path);

                        if($upload==false){
                            $_SESSION['upload'] = "<div class'error'> Fotoğraf Değiştirilemedi.</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                        if($current_image != ""){
                            $remove_path = "../images/category/".$current_image;

                            $remove= unlink($remove_path);
    
                            if($remove ==false){
                                $_SESSION['failed-remove']= "<div class='error'>Fotoğraf güncellenemedi.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die(); //işlem durur.
                            }

                        }
                    

                    }
                    else{
                        $image_name = $current_image;

                    }
                }
                else{
                     $image_name = $current_image;
                }


                //database güncelleme
                $sql2 = "UPDATE tbl_category SET 
                    title= '$title',
                    image_name='$image_name',
                    featured= '$featured',
                    active= '$active'
                    WHERE id=$id
                ";

                $res2= mysqli_query($conn, $sql2);
                if($res2==true){
                    $_SESSION['update'] = "<div class='success'> Kategori başarıyla güncellendi.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    $_SESSION['update'] = "<div class='error'> Kategori güncellenemedi.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');

                }


            }
        
        ?>
    </div>

</div>

<?php include('partials/footer.php'); ?>
