<?php include ('partials-front/menu.php'); ?>

    <?php
        if(isset($_GET['food_id'])){
            $food_id= $_GET['food_id'];
           

            $sql= "SELECT * FROM tbl_foo WHERE id= $food_id";
            $res= mysqli_query($conn, $sql);
            $count= mysqli_num_rows($res);

            if($count==1){
                $row= mysqli_fetch_assoc($res);

                $title= $row['title'];
                $price= $row['price'];
                $image_name= $row['image_name'];
            }
            else{
                header('location:'.SITEURL);
            }
                       
        }        
        else{
            header('location:'.SITEURL);
        }

    ?>



    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search2">
        <div class="container">
            
            <h2 class="text-center text-black">Sipariş Bilgilerini Doldurunuz.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Seçilen Yemek</legend>

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
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value=<?php echo $title; ?>>
                            

                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value=<?php echo $price; ?>>

                        <div class="order-label">Adet</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>

                <?php
                            if(isset($_GET['customer_id'])){
                                $customer_id= $_GET['customer_id'];
                    
                                $sql2= "SELECT * FROM tbl_customer WHERE id= $customer_id";
                                $res2= mysqli_query($conn, $sql2);
                                $count2= mysqli_num_rows($res2);
                                if($count2==1){
                                    $row2= mysqli_fetch_assoc($res2);
                    
                                    $customer_name= $row2['full-name'];
                                    $customer_contact= $row2['contact'];
                                    $customer_email= $row2['email'];
                                    $customer_address= $row2['address'];   
                                }
                            }
                    
                ?>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">ID</div>
                    <input type="text" name="customer_id" placeholder="1" class="input-responsive" >

                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Mürüvvet Demirkubuz" class="input-responsive">

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="553 446 75 44" class="input-responsive">

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="beyzademirkubuz@gmail.com" class="input-responsive" >

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Yedişehitler Mah. 2940 Sokak No:10 Kat:1" class="input-responsive" ></textarea>

                    <input type="submit" name="submit" value="Siparişi Onayla" class="btn btn-primary">
                </fieldset>

            </form>


            <?php
                if(isset($_POST['submit'])){
                    $food= $_POST['food'];
                    $price= $_POST['price'];
                    $qty= $_POST['qty'];
                    $total= $price * $qty;  //Toplam tutar hesaplanır.
                    
                    $order_date= date("Y-m-d h:i:sa");
                    $durum= "Ordered";
                    //$status_col ='status';
                    $customer_id = $_POST['customer_id'];
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $sql3= "INSERT INTO tbl_order (food, price, qty, total, order_date, durum, customer_id) VALUES 
                        ('$food',
                        $price,
                        $qty,
                        $total,
                        '$order_date',
                        '$durum',
                        $customer_id)
                    ";

                    $res3= mysqli_query($conn, $sql3);
                    
                    if($res3==true){
                        $_SESSION['order']= "<div class='success text-center'>Sipariş başarıyla oluşturuldu.</div>";
                        //header('location:'.SITEURL);
                    }
                    else{
                        $_SESSION['order']= "<div class='error text-center'>Sipariş oluşturulamadı.</div>";
                        header('location:'.SITEURL);
                    }

                }
            ?>      

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include ('partials-front/footer.php'); ?>