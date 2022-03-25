<?php
session_start();
// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_confg.php";


/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/


// Variável que contém a lista de camisas (string).
$product_cart = '';

// obtém o ID da camisa a ser salva no carrinho.
    if (isset($_GET['id'])) {
        $product_id = intval($_GET['id']);
        if(isset($_SESSION['carrinho'][$product_id])) {
            $_SESSION['carrinho'][$product_id]['quantidade']++;
        } else {
            $_SESSION['carrinho'][$product_id] = array('id' => $product_id, 'quantidade' => 1);
        }
    } else {
        $product_id = 0;
    };


    
 

// verifica se tem algo no carrinho
if ($product_id >= 1)  {

    foreach($_SESSION['carrinho'] as $value) {
        
       
// Consulta a camisa pelo ID para
$sql = <<<SQL

SELECT *, DATE_FORMAT(shirts_date, '%d/%m/%Y às %H:%i') AS shirts_brdate
FROM shirts 
WHERE shirts_id = '{$value ['id']}'
AND shirts_status = 'on'
AND shirts_date <= NOW()

SQL;


$res = $conn->query($sql);

$product = $res->fetch_assoc();
debug($product);

foreach ($product as $value)
$product_cart = <<<HTML

    <div class="product-item">
        
        <div class="product-item-img">
            <a href="/pagsprincipais/viewproducts.php?id={$product['shirts_id']}"><img src="{$product['shirts_image']}" class="img_itens" alt="{$product['shirts_title']}"></a>
        </div>

        <div class="product-item-desc">
            <h3><a href="/pagsprincipais/viewproducts.php?id={$product['shirts_id']}">{$product['shirts_title']}</a></h3>
            <p class="description">{$product['shirts_descript']}</p>
            <span class="product-price">R$ {$product['shirts_price']}</span>
        </div>

    </div>


HTML;
}
}
// Define o titilo dessa pagina
$page_title = '';


// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";

?>

<?php // Conteúdo ?>


<?php  echo $product_cart ?>



<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_footer.php";

?>