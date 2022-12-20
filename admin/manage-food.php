<?php include('partials/menu.php'); ?>

<div class= "main-content">
    <div class ="wrapper">
        <h1 style="font-size: 50px;">Yemekleri Yönet</h1>

        <br /> <br />



<!-- BUTON EKLEME -->

        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Yemek Ekle</a>

        <br /> <br /> <br />


        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);

            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);

            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);

            }
            if(isset($_SESSION['unautherized'])){
                echo $_SESSION['unautherized'];
                unset($_SESSION['unautherized']);

            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);

            }
       
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Yemek Adı</th>
                <th>Ücret</th>
                <th>Fotoğraf</th>
                <th>Öne Çıkan</th>
                <th>Aktiflik</th>
                <th>İşlemler</th>

            </tr>

            <?php
                $sql = "SELECT * FROM tbl_foo";
                $res= mysqli_query($conn, $sql);

                $count= mysqli_num_rows($res);

                $sn=1;

                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id= $row['id'];
                        $title= $row['title'];
                        $price= $row['price'];
                        $image_name= $row['image_name'];
                        $featured= $row['featured'];
                        $active= $row['active'];

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?>TL</td>
                            <td>
                                <?php 
                                    if($image_name==""){ //eğer fotoğraf yoksa 
                                        echo"<div class='error'>Fotoğraf eklenmedi.</div>";
                                    }
                                    else{
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name ?>" width="100px">
                                        <?php
                                    }
                                
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Yemeği Güncelle</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Yemeği Sil</a>
                            </td>

                         </tr>

                        <?php

                    }
                }
                else{
                    echo "<tr> <td colspan='7' class='error'>Yemek Eklenemedi.</td></tr>";
                }
            ?>


           
        </table>

            </div>
    
</div>

<?php include('partials/footer.php'); ?>