<?php include('partials/menu.php'); ?>

<div class="main-conten">
    <div class="wrapper">
        <h1 style="font-size: 50px;">Kategori Ekle</h1>

        <br><br>

        <?php  
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);

            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                
                <tr>
                    <td>Kategori Adı: </td>
                    <td>
                        <input type="text" name="title" placeholder="Kategori Adı">
                    </td>
                </tr>
                <tr>
                    <td>Resim Seç:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>



                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Kategori Ekle" class="btn-secondary">
                    </td>
                        
                </tr>

            </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];

                if(isset($_POST['featured']))
                {
                     $featured = $_POST['featured'];

                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else{
                    $active = "No";
                }


                //print_r($_FILES['image']);
                //die();
                if(isset($_FILES['image']['name']))
                {
                        $image_name=$_FILES['image']['name'];
                        if($image_name != ""){

                        //fotoğrafların database'de yeniden adlandırılmasını sağlar.
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destionation_path ="../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path,$destionation_path);

                        if($upload==false){
                            $_SESSION['upload'] = "<div class'error'> Fotoğraf Eklenemedi.</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            die();
                        }
                    }
                }
                 else{
                    $image_name="";

                 }


                $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name='$image_name',
                    featured = '$featured',
                    active='$active'
                    ";
                $res = mysqli_query($conn, $sql);
                
                if($res= TRUE){
                    $_SESSION['add'] = "<div class= 'success'>Kategori Başarılı Bir Şekilde Eklendi.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    $_SESSION['add'] = "<div class= 'error'>Kategori Ekleme İşlemi Başarısız Oldu.</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }

            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>