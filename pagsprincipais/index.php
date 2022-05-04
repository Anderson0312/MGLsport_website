<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "./phpconfgs/_confg.php";


/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/


// Define o titilo dessa pagina
$page_title = 'Inicio';

// Opção ativa no menu
$page_menu = "index";



// Variável que contém a lista de Camisa (string).
$shirts_bestsellers = $shirts_popular = $shirts_releases = '';



/*
 * Query que obtém só Camisa:
 *    Ordenados pelo mais recente.
 *    Somente com o status 'on'.
 *    Somente da data atual e anteriores.
 */
$sql = <<<SQL

SELECT shirts_id, shirts_title, shirts_image, shirts_descript, shirts_size, shirts_team, shirts_colors, shirts_price
FROM shirts 
WHERE shirts_status = 'on' AND shirts_date <= NOW() AND shirts_id <= 8; 


SQL;

// Executar a query e retorna dados na variável
$res = $conn->query($sql);



while ($shirts = $res->fetch_assoc()) {

    $shirts_bestsellers .= <<<HTML

       
    <div class="item">
        <a href="/pagsprincipais/viewproducts.php?id={$shirts['shirts_id']}">
            <div class="card-content">
                <div class="card">
                    <img src="{$shirts['shirts_image']}" alt="">
                        <p class = "product-title">{$shirts['shirts_title']}</p>
                        <p class="product-desc">{$shirts['shirts_descript']}</p>
                        <span class="product-price">R$ {$shirts['shirts_price']}</span>
                        
                </div>
            </div>
        </a>
    </div>  



    HTML;

}


$sql = <<<SQL

SELECT shirts_id, shirts_title, shirts_image, shirts_descript, shirts_size, shirts_team, shirts_colors, shirts_price
FROM shirts 
WHERE shirts_status = 'on' AND shirts_date <= NOW() AND shirts_id <= 10
ORDER BY shirts_date DESC; 


SQL;


// Executar a query e retorna dados na variável
$res = $conn->query($sql);



while ($shirts = $res->fetch_assoc()) {

    $shirts_releases .= <<<HTML

       
    <div class="item">
        <a href="/pagsprincipais/viewproducts.php?id={$shirts['shirts_id']}">
            <div class="card-content">
                <div class="card">
                    <img src="{$shirts['shirts_image']}" alt="">
                        <p class = "product-title">{$shirts['shirts_title']}</p>
                        <p class="product-desc">{$shirts['shirts_descript']}</p>
                        <span class="product-price">R$ {$shirts['shirts_price']}</span>
                        
                </div>
            </div>
        </a>
    </div>  



    HTML;

}




/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/


// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "./phpconfgs/_header.php";

?>



<!----------------- END OF ASIDE -------------------->


<div class="banner">
    <div class="owl-carousel" id="carousel1">
        <div>
            <source media="(max-width: 426px)" srcset="../imgbanner/bannerMobile.jpeg">
            <img class='bannerimg' src="../imgbanner/bannerG.png" alt="">
        </div>
        <div>
            <source media="(max-width: 426px)" srcset="../imgbanner/bannerMobile.jpeg">
            <img class='bannerimg' src="../imgbanner/mosaico-a-partir.png" alt="">
        </div>
        <div>
            <source media="(max-width: 426px)" srcset="../imgbanner/bannerMobile.jpeg">
            <img class='bannerimg' src="../imgbanner/sitenoar.jpeg" alt="">
        </div>
        <div>
            <source media="(max-width: 426px)" srcset="../imgbanner/bannerMobile.jpeg">
            <img class='bannerimg' src="../imgbanner/comolavar.jpeg" alt="">
        </div>
    </div>
</div>


<!----------------- END OF BANNER -------------------->
<!----------------- SECTION -------------------->

<section>
    <div class='service-items'>
        <div class='service-items'>
            <div class='service-items-block'>
                <div class='icon-service'>
                    <i class='bx bx-package'></i>
                </div>
                <div>
                    <h4>FRETE GRÁTIS</h4>
                    <p>Para todo o Brasil</p>
                </div>
            </div>
            <div class='service-items-block'>
                <div class='icon-service'>
                    <i class='bx bx-credit-card-front' ></i>
                </div>
                <div>
                    <h4>PARCELE</h4>
                    <p>Em até 12x</p>
                </div>
            </div>
        </div>    

        <div class='service-items'>
            <div class='service-items-block'>
                <div class='icon-service'>
                <i class='bx bxl-whatsapp' ></i>
                </div>
                <div>
                    <h4>ENTRE EM CONTATO</h4>
                    <p>Fale diretamente conosco!</p>
                </div>
            </div>
            <div class='service-items-block'>
                <div class='icon-service'>
                <i class='bx bx-check-shield'></i>
                </div>
                <div>
                    <h4>SITE SEGURO</h4>
                    <p>Compre suas comprar com certificado de segurança</p>
                </div>
            </div>
        </div>  
    </div>
</section>
<!----------------- END SECTION -------------------->
<!----------------- CARD SESÕES -------------------->

<div class='secao-cards'>
    <a href="/pagsmenu/Brasileiros.php">
    <div class='container-cards'>
        <img src="/imgbanner/gabigol.jpg" class='img-card'>
        <div class='textbanner'>
            <h2>BRASILEIROS</h2>
            <div class='btn'>
                COMPRAR
            </div>
        </div>
    </div>
    </a>

    <a href="/pagsmenu/Internacionais.php">
    <div class='container-cards'>
        <img src="/imgbanner/neymar.jpg" class='img-card'>
        <div class='textbanner'>
            <h2>EUROPEUS</h2>
            <div class='btn'>
                COMPRAR
            </div>
        </div>
    </div>
    </a>


    <a href="/pagsmenu/Selecao.php">
    <div class='container-cards'>
        <img src="/imgbanner/messi.jpg" class='img-card'>
        <div class='textbanner'>
            <h2>SELEÇÂO</h2>
            <div class='btn'>
                COMPRAR
            </div>
        </div>
    </div>
    </a>
</div>

<!----------------- END OF SESÕES-------------------->
<!----------------- CARD PRODUCT BEST SELLER  -------------------->
<div class="title-colecion">
        <h1>MAIS VENDIDAS</h1>
    </div>

    <div class="owl-carousel owl-theme">
        
            <?php echo $shirts_bestsellers ?>
       
    </div>


<!----------------- END OF CARD PRODUCT BEST SELLER ---------------->

<div class="title-colecion">
        <h1>LANÇAMENTOS</h1>
    </div>

    <div class="owl-carousel owl-theme">
        
            <?php echo $shirts_releases ?>
       
    </div>
<!----------------- END OF CARD PRODUCT -------------------->
       

<!----------------- END OF CARD PRODUCT -------------------->



<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "./phpconfgs/_footer.php";

?>