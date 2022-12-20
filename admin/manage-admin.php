<?php include('partials/menu.php'); ?>

        <!-- MAIN CONTENT STARTS -->
        <div class ="main-content">
            <div class = "wrapper" >
               <h1 style="font-size: 50px;">Yöneticileri Yönet</h1>
               <br /> 
               

               <?php  
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add']; //session mesajı verir
                    unset($_SESSION['add']); //session mesajını kaldırır
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete']; //session mesajı verir
                    unset($_SESSION['delete']); //session mesajını kaldırır
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update']; //session mesajı verir
                    unset($_SESSION['update']); //session mesajını kaldırır
                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found']; //session mesajı verir
                    unset($_SESSION['user-not-found']); //session mesajını kaldırır
                }
                if(isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match']; //session mesajı verir
                    unset($_SESSION['pwd-not-match']); //session mesajını kaldırır
                }
                if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd']; //session mesajı verir
                    unset($_SESSION['change-pwd']); //session mesajını kaldırır
                }

               ?>
               <br><br><br> 


               <!-- BUTON EKLEME -->

                <a href="add-admin.php" class="btn-primary">Yönetici Ekle</a>

                <br /> <br /> <br />

                <table class="tbl-full">
                    <tr>
                        <th>Sıra Numarası</th>
                        <th>Ad ve Soyad</th>
                        <th>Kullanıcı Adı</th>
                        <th>İşlemler</th>
     
                    </tr>

                    <?php
                        //Bütün adminleri ekranda gösterecek sorgu
                        $sql = "SELECT * FROM tbl_admin";
                        //Execute sorgu
                        $res =mysqli_query($conn, $sql);

                        //Sorgunun çalışıp çalışmadığını kontrol eder
                        if($res==TRUE){
                            $count = mysqli_num_rows($res); //bütün satırlar gelir

                            $sn=1; //Create variable and addign the value


                            if($count>0){
                                while($rows=mysqli_fetch_assoc($res)){ //tüm verileri getirme
                                    $id= $rows['id'];
                                    $full_name= $rows['full_name'];
                                    $username= $rows['username'];

                                    //Tablodaki veriler display edilir
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Şifre Değiştir</a> 
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Yönetici Güncelle</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Yönetici Sil</a>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else{

                            }

                        }
                    ?>


                    
                </table>

            </div>
           
        </div>
        <!-- MAIN CONTENT ENDS -->

<?php include('partials/footer.php'); ?>