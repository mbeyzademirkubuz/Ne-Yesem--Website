
<?php include('partials/menu.php'); ?>

        <!-- MAIN CONTENT STARTS -->
        <div class ="main-content">
            <div class = "wrapper">
               <h1  style="font-size: 50px;">ADMİN PANELİ</h1>
                <br><br>
               <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
                <br><br>

               <div class="col-4 text-center">

                    <?php
                        $sql= "SELECT * FROM tbl_category";
                        $res= mysqli_query($conn, $sql);
                        $count= mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                        <br />
                    Kategoriler
               </div>
               <div class="col-4 text-center">
                    <?php
                        $sql2= "SELECT * FROM tbl_foo";
                        $res2= mysqli_query($conn, $sql2);
                        $count2= mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                        <br />
                    Yemekler
               </div>
               <div class="col-4 text-center">
                    <?php
                        $sql3= "SELECT * FROM tbl_order";
                        $res3= mysqli_query($conn, $sql3);
                        $count3= mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                        <br />
                    Siparişler
               </div>
               <div class="col-4 text-center">
                    <?php
                        $sql4= "SELECT SUM(total) AS Total FROM tbl_order WHERE durum='Delivered'";  //Toplam kazancın doğru hesaplanılması için yalnızca teslim edilen sipariş kayıtlarının toplamını alır.
                        $res4= mysqli_query($conn, $sql4);
                        $row4= mysqli_fetch_assoc($res4);

                        $total_revenue= $row4['Total'];

                    ?>
                    <h1><?php echo $total_revenue; ?>TL</h1>
                        <br />
                    Toplam Gelir
               </div>
               
               <div class="clearfix" ></div>

            </div>
           
        </div>
        <!-- MAIN CONTENT ENDS -->

 <?php include('partials/footer.php') ?>     