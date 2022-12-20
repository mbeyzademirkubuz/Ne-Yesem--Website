<?php include('partials/menu.php'); ?>

<div class= "main-content">
    <div class ="wrapper">
        <h1 style="font-size: 50px;">Siparişleri Yönet</h1>

 <br /> <br /> <br />

 <?php
    if(isset($_SESSION['update'])){
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
 ?>
 <br><br><br>

 <table class="tbl-full">
     <tr>
         <th>S.N.</th>
         <th>Yemek Adı</th>
         <th>Ücret</th>
         <th>Adet</th>
         <th>Toplam Tutar</th>
         <th>Sipariş Tarihi</th>
         <th>Sipariş Durumu</th>
         <th>Müşteri ID</th>
         <th>Müşteri Adı</th>
         <th> İletişim</th>
         <th>Email</th>   
         <th>Adres</th>
         <th>İşlemler</th>

     </tr>

     <?php
        //$sql = "SELECT * FROM tbl_order OUTER JOIN tbl_customer ON tbl_order.customer_id = tbl_customer.id";

        //iki tablonun birleştirilmesi için kullanılacak olan sorgu --FULL OUTER JOIN 

       /* $sql = "SELECT * FROM tbl_order t1 LEFT JOIN tbl_customer t2 ON t1.customer_id = t2.id 
        UNION 
        SELECT * FROM tbl_order t1 RIGHT JOIN tbl_customer t2 ON t1.customer_id = t2.id";*/

        $sql= "SELECT t1.id, t1.food, t1.price, t1.qty, t1.total, t1.order_date, t1.durum, t1.customer_id, t2.customer_name, t2.customer_contact, t2.customer_email, t2.customer_address
                FROM tbl_order t1 JOIN tbl_customer t2 ON t1.customer_id= t2.id";
       
        $res= mysqli_query($conn, $sql);

        $count= mysqli_num_rows($res);

        $sn=1;

        if($count>0){
            while($row=mysqli_fetch_assoc($res)){
                $id= $row['id'];
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $durum= $row['durum'];
                $customer_id = $row['customer_id'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact']; //ikinci yazılanlar databasede olanlar
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];

                ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td>

                            <?php
                                if($durum=="Ordered"){
                                    echo "<label style='color: yellow;'>$durum</label>";
                                }
                                elseif($durum=="On Delivery"){
                                    echo "<label style='color: orange;'>$durum</label>";
                                }
                                elseif($durum=="Delivered"){
                                    echo "<label style='color: green;'>$durum</label>";
                                }
                                elseif($durum=="Canceled"){
                                    echo "<label style='color: red;'>$durum</label>";
                                }
                            ?>
                        </td>
                        
                        <td><?php echo $customer_id; ?></td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Siparişi Güncelle</a>
                        </td>

                    </tr>

                <?php

            }

        }
        else{
            echo "<tr><td colspan='12' class='error'>Sipariş aktif değildir.</td></tr>";
        }
     ?>


 </table>

    </div>
    
</div>

<?php include('partials/footer.php'); ?>