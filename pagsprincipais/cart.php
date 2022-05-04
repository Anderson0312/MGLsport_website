<?php

session_start();
// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_confg.php";


/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/


// Variável que contém a lista de camisas (string).
$product_cart =  '' ;
$total = 0;

// verifica se o array do carrinho foi criado se não foi criado cria
if(!isset($_SESSION['carrinho']))
{
   $_SESSION['carrinho'] = array();
  };
  
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

    //pega o id do url 
    if (isset($_GET['del'][$product_id])) {
        $iddell = intval($_GET['del']); // adicioan o id na variavel
        if (isset($_SESSION['carrinho'][$iddell])) { // verifica se o id tem no carrinho
            unset($_SESSION['carrinho'][$iddell]); // deleta o id desejado
        }
    }


// verifica se tem algo no carrinho
//perguntar para o professor pq o id não esta carregando aqui

if ($product_id >= 0  )  {

    foreach($_SESSION['carrinho'] as $value) {
        // Consulta a camisa pelo ID para
        $sql = <<<SQL


        SELECT *, DATE_FORMAT(shirts_date, '%d/%m/%Y às %H:%i') AS shirts_brdate
        FROM shirts 
        WHERE shirts_id = '{$value['id']}'
        AND shirts_status = 'on'
        AND shirts_date <= NOW()

        SQL;

        // Executar a query e retorna dados na variável do banco de dados
        $res = $conn->query($sql);

        // roda o loop enquanto tiver retorno do banco de dados, retornando uma camisa
        while ($product = $res->fetch_assoc()) :
            
            $product_cart .= <<<HTML
            
            <div class="product-item-cart">    
                <div class="product-item-cart-img">
                <a href="/pagsprincipais/cart.php?del={$product['shirts_id']}" id='x'><i class='bx bx-x' ></i></>
                    <a href="/pagsprincipais/viewproducts.php?id={$product['shirts_id']}"><img src="{$product['shirts_image']}" class="img_itens" alt="{$product['shirts_title']}"></a>
                </div>
    
                <div class="product-item-desc">
                    <h3><a href="/pagsprincipais/viewproducts.php?id={$product['shirts_id']}">{$product['shirts_title']}</a></h3>
                    <p class="description">{$product['shirts_descript']}</p>
                    <span class="product-price">R$ {$product['shirts_price']}</span>
                </div>
                <div class="quant-buttons">
                    <input type="button" value="-" class="button-less" onclick="less()">
                    <input type="number" value="1" id="quantity" step="1" min="0" max="10"> 
                    <input type="button" value="+" class="button-more" onclick="more()">
                </div>
            </div>
            
            
            
            
    HTML;
    $total = $product['shirts_price']+$total;
endwhile;
};
};


// Define o titilo dessa pagina
$page_title = '';


// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";
?>

<?php // Conteúdo ?>

<link rel="stylesheet" href="/css/cartstyle.css">

<div>  
    <h2 class="secondheader">
        CARRINHO DE COMPRAS
    </h2>
</div>

<form class="container-cart-all" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

    <div class="container-product-cart">
        <div class="product-mount">
            <h4>Produto</h4>
            <h4>Quantidade</h4>
        </div>

        <div class="container-cart">
            
            <?php  echo $product_cart ?>
            
        </div >

        <button class="buttonpadrao"><a href="./">CONTINUAR COMPRANDO</a></button>
    </div>



    <div class="table-finish"> 
        <table class="headertab">
            <thead>
                <th>TOTAL NO CARRINHO</th>
            </thead>
        </table>

        <div class="subtot">
            <h4>subtotal</h4>
            <h3>R$ <?php echo $total ?></h3>
        </div>

        <div class="cep">
            <h4>entrega</h4>
            <div>
                <label for="cep">Digite seu endereço para ver as opções de entrega</label>
                <input type="text" class="input-cep">
                <br>
                <button>ATUALIZAR</button>
            </div>
        </div>

        <div class="total-cart">
            <h4>total</h4>
            <h3>R$ <?php echo $total ?></h3>
        </div>

        <div class="btn-finish-cart">
            <button><a href="/pagsprincipais/finishbuy.php">FINALIZAR COMPRA</a> </button>
        </div>

        <div class="table-cupom">
            
            <h4 id="cupom"><i class='bx bx-purchase-tag-alt'></i>Cupom</h4>
            
            <div>
                <input type="text" class="input-cupom" placeholder="Digite o cupom">
                
                <button>Aplicar cupom</button>
            </div>
        </div>
        
    </div>

</form>

<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_footer.php";

?>