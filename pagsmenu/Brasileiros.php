<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_confg.php";


/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Variável que contém a lista de Camisa (string).
$shirts_list = '';

/*
 * Query que obtém só Camisa:
 *    Ordenados pelo mais recente.
 *    Somente com o status 'on'.
 *    Somente da data atual e anteriores.
 */
$sql = <<<SQL

SELECT shirts_id, shirts_title, shirts_image, shirts_descript, shirts_size, shirts_team, shirts_team, shirts_colors, shirts_price
FROM shirts 
WHERE shirts_status = 'on' AND shirts_date <= NOW()  AND shirts_pais = 'Brasil'
ORDER BY shirts_id desc;

SQL;

// Executar a query e retorna dados na variável do banco de dados
$res = $conn->query($sql);

// roda o loop enquanto tiver retorno do banco de dados, retornando uma camisa
while ($art = $res->fetch_assoc()) {

    $shirts_list .= <<<HTML


    <div class="product-item">
    
        <div class="product-item-img">
            <a href="/pagsprincipais/viewproducts.php?id={$art['shirts_id']}"><img src="{$art['shirts_image']}" class="img_itens" alt="{$art['shirts_title']}"></a>
        </div>
    
        <div class="product-item-desc">
            <h3><a href="/pagsprincipais/viewproducts.php?id={$art['shirts_id']}">{$art['shirts_title']}</a></h3>
            <p class="description">{$art['shirts_descript']}</p>
            <span class="product-price">R$ {$art['shirts_price']}</span>
        </div>
    
    </div>


HTML;
}

/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/


// Define o titilo dessa pagina
$page_title = '';

// Opção ativa no menu
$page_menu = "index";

// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";

?>

<?php // Conteúdo ?>


<!----------------- CONTEUDO-------------------->


<div>  
    <h2 class="secondheader">
        TIMES BRASILEIROS
    </h2>
</div>

<div class="container-catalogo">
   
    <?php echo $shirts_list ?>
    
</div>




<!----------------- END OF CONTEUDO -------------------->




<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_footer.php";

?>