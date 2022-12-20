<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ne Yesem?</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section style="background-color:#661f8c;" class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logoo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a style="font-size:20px; color: white"  href="<?php echo SITEURL; ?>">Ana Ekran</a>
                    </li>
                    <li>
                        <a style="font-size:20px; color: white" href="<?php echo SITEURL; ?>categories.php">Kategoriler</a>
                    </li>
                    <li>
                        <a style="font-size:20px; color: white" href="<?php echo SITEURL; ?>foods.php">Yemekler</a>
                    </li>
                    <li>
                        <a style="font-size:20px; color: white" href="#">İletişim</a>
                    </li>
                    <li>
                        <a style="font-size:20px; color: white" href="<?php echo SITEURL; ?>logout-front.php">Giriş Yap</a>
                    </li>
                    <li>
                        <a style="font-size:20px; color: white" href="<?php echo SITEURL; ?>signin-front.php">Kayıt Ol</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
