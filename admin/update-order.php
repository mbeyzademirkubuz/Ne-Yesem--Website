<?php include('partials/menu.php'); ?>

<div class= "main-content"> 
    <div class="wrapper"> 
        <h1>Siparişi Güncelle</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id= $_GET['id'];
               

                //$sql= "SELECT * FROM tbl_order WHERE id= $id";
                
                $sql= "SELECT * FROM tbl_order t1 LEFT JOIN tbl_customer t2 ON t1.customer_id = t2.id UNION SELECT * FROM tbl_order t1 LEFT JOIN tbl_customer t2 ON t1.customer_id = t2.id";

                $res= mysqli_query($conn, $sql);

                $count= mysqli_num_rows($res);

                if($count>0){
                    $row =mysqli_fetch_assoc($res);
                    
                    
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $durum= $row['durum'];
                    $customer_id = $row['customer_id'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact']; //ikinci yazılanlar databasede olanlar
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else{
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else{
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method= "POST">

            <table class= "tbl-30">
            <tr>
                <td>Food Name: </td>
                <td><b><?php echo $food; ?></b></td>

            </tr>
            <tr>
                <td>Price</td>
                <td>
                    <b><?php echo $price; ?>TL</b>
                </td>
            </tr>
            <tr>
                <td>Qty: </td>
                <td>
                    <input type="number" name="qty" value="<?php echo $qty; ?>">
                </td>
            </tr>
            <tr>
                <td>Status: </td>
                <td>
                    <select name="durum">
                        <option <?php if($durum=="Ordered"){echo " selected";} ?> value="Ordered">Sipariş Verildi.</option>
                        <option <?php if($durum=="On Delivery"){echo " selected";} ?> value="On Delivery">Teslimat Yolda.</option>
                        <option <?php if($durum=="Delivered"){echo " selected";} ?> value="Delivered">Teslim edildi.</option>
                        <option <?php if($durum=="Canceled"){echo " selected";} ?> value="Canceled">Sipariş iptal edildi.</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Customer ID: </td>
                <td>
                    <input type="text" name="customer_id" value="<?php echo $customer_id; ?>">
                </td>
                    
            </tr>


            <tr>
                <td>Customer Name: </td>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                </td>
                    
            </tr>
            <tr>
                <td>Customer Contact: </td>
                <td>
                    <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                </td>
                    
            </tr>
            <tr>
                <td>Customer Email: </td>
                <td>
                    <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                </td>
                    
            </tr>
            <tr>
                <td>Customer Address: </td>
                <td>
                    <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                </td>
                    
            </tr>

            <tr>
                <td clospan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <input type="submit" name="submit" value="Siparişi Güncelle" class="btn-secondary">
                </td>
            </tr>

            </table>

        </form>

        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price*$qty;
                $durum = $_POST['durum'];
                $customer_id = $_POST['customer_id'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];


               /* $sql2= "UPDATE tbl_order t1 JOIN tbl_customer t2 ON (t2.id=t1.customer_id) SET
                        t1.qty= $qty,
                        t1.total=$total,
                        t1.status= $status
                        t1.customer_id= $customer_id,
                        t2.customer_name= $customer_name,
                        t2.customer_contact=$customer_contact,
                        t2.customer_email= $customer_email,
                        t2.customer_address=$customer_address
                        where t1.id=$id OR t2.id = $customer_id;";
*/

                $sql2= "UPDATE tbl_order SET
                    qty= $qty,
                    total=$total,
                    durum= '$durum',
                    customer_id= $customer_id
                    where id=$id;
                    ";
                $sql3= "UPDATE tbl_customer SET
                    customer_name= '$customer_name',
                    customer_contact=$customer_contact,
                    customer_email= '$customer_email',
                    customer_address='$customer_address'
                    where id= $customer_id
                "; 


                $res2=mysqli_query($conn, $sql2);
                $res3=mysqli_query($conn, $sql3); 

                if($res2==true && $res3==true){
                    $_SESSION['update']= "<div class='success'>Sipariş başarıyla güncellenmiştir.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else{
                    $_SESSION['update']= "<div class='error'>Sipariş başarıyla güncellenmiştir.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }

                



            }
        ?>

    </div>    

</div>        

<?php include('partials/footer.php'); ?>
