<?php include ('partials-front/menu.php'); ?>

    <!-- Yemek arama bölümü -->
    <section class="food-search text-center">
        <div class="container">
            

            <?php
                 $search =mysqli_real_escape_string($conn, $_POST['search']); //yanlış yazılmış kelimeler aratıldığında sitenin hata vermemesi için ilgili fonksiyon ile 'search' kelimesi çekilmiştir.
            ?>

            <h2 class= "text-purple">Aramak İstediğiniz Yemek: <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>




    <!-- Menü bölümü -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menü</h2>

            <?php      
            

                $sql= "SELECT * FROM tbl_foo WHERE title LIKE '%$search%' OR description LIKE '%$search%'"; //aranan kelime, veritabanında kayıtlı kelimenin içinde arar.

                $res = mysqli_query($conn, $sql);

                $count= mysqli_num_rows($res);

                if($count>0){
                    while($row= mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description =$row['description'];
                        $image_name=$row['image_name'];

                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name==""){
                                        echo "<div class='error'>Fotoğraf bulunamadı.</div>";
                                    }
                                    else{

                                        ?>
                                             <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php

                                    }
                                ?>
                            </div>
                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Sipariş Ver</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else{
                    echo "<div class'error'>Yemek bulunamadı.</div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>


    <?php include ('partials-front/footer.php'); ?>