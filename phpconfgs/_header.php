<?php

// Formata o título da página
if ($page_title == '') {
    $page_title = $site_name;
} else {
    $page_title = $site_name . ' - ' . $page_title;
}

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MGLsport</title>

    <link rel="shortcut icon" href="/imgbanner/ICONM.png" type="image/x-icon">

    <link rel="shortcut icon" href="" type="image/x-icon">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/stylelogin.css">
    <link rel="stylesheet" href="/css/styleitens.css">
    <link rel="stylesheet" href="/css/styleprofil.css">


    <!------------------ bootstrap ------------------>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAauU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons+Sharp">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>



    <!----------------- jquery carrosel style -------------------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!----------------- jquery carrosel style -------------------->   
    

</head>
<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <header class='header-container'>
    <div class="overside">
        <span>Aproveite o frete grátis em pedidos acima de 200!</span>
    </div>
    <div class="header">
    <h1> <a href="/pagsprincipais/index.php" class="title x"><?php echo $site_name; ?></a></h1>
        <div class="right">
        <?php if (!isset($_COOKIE['user'])) : ?>
            <div class="btn-login">
                <a href="/user/login.php"><span class="material-icons-sharp x">person</span></a>
            </div>
        <?php else : ?>     
            <div class="btn-login">
                <a href="/user/logged.php"><span class="material-icons-sharp x">person</span></a>
            </div>
        <?php endif; ?>
            <div class="btn-shopping-cart">
                <a href="/pagsprincipais/cart.php"><span class="material-icons-sharp x">shopping_cart</span></a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <button class="btn-menu">
            <a href="#"><span class="material-icons-sharp x">menu</span></a>
        </button>
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="" alt="">
                    <a href="/pagsprincipais/index.php" >
                        <h2 class='x'>MGL</h2>
                    </a>
                </div>
            </div>
            <div class="sidebar">
                <a href="/pagsmenu/newcolecion.php" class="active">
                    <h3>Nova coleção</h3>
                </a>
                <a href="/pagsmenu/Brasileiros.php">
                    <h3>Nacionais</h3>
                </a>
                <a href="/pagsmenu/Internacionais.php">
                    <h3>Internacionais</h3>
                </a>
                <a href="/pagsmenu/Selecao.php">
                    <h3>Selecão</h3>
                </a>
            </div>
        </aside>
    </div>
    </header>

    <!----------------- END OF HEADER -------------------->




    
