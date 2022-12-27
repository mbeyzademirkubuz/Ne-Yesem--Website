<?php include('partials/menu.php'); ?>


<?php
       if(isset($_GET['id'])){
            $id=$_GET['id'];

            $sql2= "SELECT * FROM tbl_foo WHERE id=$id";

            $res2= mysqli_query($conn, $sql2);

            $row2 = mysqli_fetch_assoc($res2);

            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured= $row2['featured'];
            $active= $row2['active'];

        }
        else{
            
            header('location:'.SITEURL.'admin/manage-food.php');
        }
?>

<div class="main-content">
    
    <div class="wrapper">
        <h1 style="font-size: 50px;">Yemek Güncelleme Ekranı</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Yemek Adı:</td>
                    <td>
                        <input type="text" name="title" value= "<?php  echo $title?>">
                    </td>
                </tr>

                <tr>
                    <td>İçerik:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php  echo $description?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Ücret:</td>
                    <td>
                        <input type="number" name="price" value="<?php  echo $price ?>">
                    </td>
                </tr>
                <tr>
                    <td>Yemek Fotoğraf:</td>
                    <td>
                        <?php

                            if($current_image==""){
                                echo "<div class='error'> Fotoğraf yüklenemedi.</div>";
                            }
                            else{
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="200px">
                                <?php
                                
                            }
                        ?>  
                    </td>
                </tr>

                <tr>
                    <td>Resim Seç:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Kategori:</td>
                    <td>
                        <select name="category">

                            <?php
                                $sql= "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res= mysqli_query($conn, $sql);

                                $count= mysqli_num_rows($res);

                                if($count>0){
                                    while($row= mysqli_fetch_assoc($res)){
                                        $category_title= $row['title'];
                                        $category_id= $row['id'];

                                        //echo "<option value='$category_id'>$category_title</option>";

                                        ?>

                                            <option <?php if($current_category== $category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                        <?php
                            

                                    }
                                }
                                else{
                                    echo "<option value='0'>Kategori aktif değildir.</option>";
                                }

                            ?>

                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Öne Çıkan:</td>
                    <td>
                        <input <?php if($featured== "Yes"){echo "checked";}?> type="radio" name="featured" value = "Yes">Yes
                        <input <?php if($featured== "No"){echo "checked";}?> type="radio" name="featured" value = "No">No
                    </td>
                </tr>
                <tr>
                    <td>Aktif:</td>
                    <td>
                        <input <?php if($featured== "Yes"){echo "checked";}?> type="radio" name="active" value = "Yes">Yes
                        <input <?php if($featured== "No"){echo "checked";}?> type="radio" name="active" value = "No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value = "<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value = "<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value = "  Güncelle  " class="btn-secondary">
                    </td>
                </tr>





            </table>

        </form>

        <?php
            if(isset($_POST['submit'])){
                $id= $_POST['id'];
                $title= $_POST['title'];
                $description= $_POST['description'];
                $price= $_POST['price'];
                $current_image= $_POST['current_image'];
                $category= $_POST['category'];

                $featured =$_POST['featured'];
                $active = $_POST['active'];


                if(isset($_FILES['image']['name'])){
                    $image_name= $_FILES['image']['name']; //yeni fotoğraf eklenir ve adlandırılır.

                    if($image_name!=""){
                        
                        $ext = end(explode('.',$image_name));

                        $image_name = "Food-Name-".rand(0000,9999).'.'.$ext;  //yeni isimlendirme yapılır.
                        $src_path = $_FILES['image']['tmp_name']; 
                        $dest_path = "../images/food/".$image_name;

                        $upload = move_uploaded_file($src_path, $dest_path);

                        if($upload==false){
                            $_SESSION['upload'] = "<div class='error'>Fotoğraf güncellenemedi.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php'); //fotoğraf yüklenmediğinde yemek yönetim sayfasına gider.
                            die();
                        }

                        if($current_image != ""){
                            $remove_path = "../images/food/".$current_image;

                            $remove= unlink($remove_path);

                            if($remove==false){
                                $_SESSION['remove-failed']= "<div class='error'>Fotoğraf kaldırılamadı.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php'); //fotoğraf yüklenmediğinde yemek yönetim sayfasına gider.
                                die();
                            }
                        }
                    }
                    else{
                        $image_name = $current_image; // seçilmediğinde default fotoğraf gelir
                    }
                }
                else{
                    $image_name = $current_image; // tıklanmadığında default fotoğraf gelir
                }

                //veri güncelleme sorgusu

                $sql3= "UPDATE tbl_foo SET   
                    title= '$title',
                    description= '$description',
                    price= '$price',
                    image_name= '$image_name',
                    category_id= '$category_id',
                    featured= '$featured',
                    active='$active'
                    WHERE id= $id
                ";

                $res3 = mysqli_query($conn, $sql3);  //sql sorgusu execute edilir.
                if($res3== true){
                    $_SESSION['update'] = "<div class= 'success'> Yemek başarıyla güncellenmiştir.</div>";
                    //header('location:'.SITEURL.'admin/manage-food.php'); //yemek güncellendikten sonra yemek yönetim sayfasına gider.
                    
                }
                else{
                    $_SESSION['update'] = "<div class= 'error'> Yemek güncellenememiştir.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php'); //fotoğraf yüklendikten sonra yemek yönetim sayfasına gider.
                }
                echo "<button onclick='<?php header('location:'.SITEURL.'admin/manage-food.php'); ?>'</button>";
            }
        ?>


    </div>

</div>
    

<?php include('partials/footer.php'); ?>