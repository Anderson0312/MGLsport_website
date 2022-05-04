<?php

session_start();
// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_confg.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Variável que contém a lista de camisas (string).
$shirt_view =  $shirts_likeyou = '' ;
$pacella = 0;


// obtém o ID da camisa a ser exibida.
if (isset($_GET['id'])) {
    $shirts_id = intval($_GET['id']);
} else {
    $shirts_id = 0;
}

// Armadilha 1: caso usuario tente acessar a página sem id ou uma string.
if ($shirts_id === 0) header('Location: /pagsprincipais/index.php');

// Consulta a camisa pelo ID para
$sql = <<<SQL

SELECT *, DATE_FORMAT(shirts_date, '%d/%m/%Y às %H:%i') AS shirts_brdate
FROM shirts 
WHERE shirts_id = '{$shirts_id}'
AND shirts_status = 'on'
AND shirts_date <= NOW()

SQL;

// Executar a query e retorna dados na variável do banco de dados
$res = $conn->query($sql);

// verifica se retornou uma Camisa, se não retornou joga para pagina inicial
if ($res->num_rows != 1) header('Location: /pagsprincipais/index.php');


// Obtém dados na forma de array
$shirt = $res->fetch_assoc();
 
$parcela  = number_format($shirt['shirts_price'] / 1, 2, ',', '.');
$parcela3 = number_format($shirt['shirts_price'] / 3, 2, ',', '.');
$parcela2 = number_format($shirt['shirts_price'] / 2, 2, ',', '.');


$shirt_view = <<<HTML


<div class="container-view-product">
    <div class="imgs-view-product" >
        <div id="m_image" class='div-princ-view'>
            <img class="img-princ" src="{$shirt['shirts_image']}" alt="" >
        </div>
        <div id="s_image" class='img-seconds-view'>
            <img src="{$shirt['shirts_image_2']}" alt="">
            <img src="{$shirt['shirts_image_3']}" alt="">
            <img src="{$shirt['shirts_image_4']}" alt="">
            <img src="{$shirt['shirts_image']}" alt="">
        </div>
    </div>


    <div class="product-info">
        <p class="navegation">
            <a href="/pagsprincipais/index.php">Home  >></a>
            <a href="/pagsprincipais/index.php">Loja</a>
        </p>


        <h2 class = "title-product-view">
            {$shirt['shirts_title']}
        </h2>


        <div class="payment">

            <p>R$ {$shirt['shirts_price']}</p>
            <p> 3 x de  <strong> {$parcela3} </strong> </p>

        </div>


        <div class="zise-shirt">
            <p id="p-size">Tamanho: </p>

            <div> 
                <p>P</p>

                <p>M</p>

                <p>G</p>  

                <p>GG</p>  
            </div>
        </div>
            

        <div class="inputs-buy">

                <a href="/pagsprincipais/cart.php? id={$shirt['shirts_id']}  "><button class="btn-buy">Adicionar no carrinho</button></a>

            <div class="frete">
                <p>Calcular o prazo e valor do frete</p>

                <input type="text"><a href=""><button>CALCULAR</button></a>

            </div>
        </div>


        <table class="table-installment">

            <thead>
                <tr>
                    <th>PARCELAMENTO</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>1x DE <strong>R$ {$parcela} </strong></td>
                    <td class="parcell"><strong>R$ {$parcela}</strong></td>
                </tr>

                <tr>
                    <td>2x DE <strong>R$ {$parcela2}</strong></td>
                    <td class="parcell"><strong>R$ {$parcela}</strong></td>
                </tr>

                <tr>
                    <td>3x DE <strong>R$ {$parcela3}</strong></td>
                    <td class="parcell"><strong>R$ {$parcela}</strong></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>


    <div class="div-table-description">
        <table class="table-description">

            <thead>
                <tr>
                    <th>DESCRIÇÃO</th>
                </tr>
                <tr>
                    <th>INFORMAÇÃO ADICIONAL</th>
                </tr>
                <tr>
                    <th>AVALIAÇÃO</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><strong>{$shirt['shirts_title']}</strong></td>
                </tr>
                <tr>
                    <td><strong>-Tecido:</strong> 100% Poliéster </td>
                </tr>
                <tr>
                    <td><strong>-Detalhes:</strong> Mantém o suor longe da pele, enquanto os recursos de fluxo de ar anatomicamente colocados oferecem uma superior regulagem de temperatura para manter o corpo seco e fresco durante o uso. </td>
                </tr>
                <tr>
                    <td><strong>Sobre nós:</strong> Especializada em camisas de futebol e artigos esportivos, a loja virtual surgiu em 2021 na cidade de Rio de janeiro (RJ) e reúne uniformes completos dos mais variados clubes brasileiros, internacionais e seleções - dos mais consagrados aos menos conhecidos. Com a maior variedade em camisas de times de futebol no mercado nacional, a FutFanatics trabalha em parceria com as principais marcas esportivas para comercializar somente produtos originais e com garantia de qualidade.</td>
                </tr>
            </tbody>
            
        </table>
    </div>



HTML;




/*
 * Query que obtém só Camisa:
 *    Ordenados pelo mais recente.
 *    Somente com o status 'on'.
 *    Somente da data atual e anteriores.
 */

$sql = <<<SQL

SELECT shirts_id, shirts_title, shirts_image, shirts_descript, shirts_size, shirts_team, shirts_colors, shirts_price
FROM shirts 
WHERE shirts_status = 'on' AND shirts_date <= NOW() AND shirts_id <= 8 ; 

SQL;

// Obtém dados na forma de array
$res = $conn->query($sql);

// roda o loop enquanto tiver retorno do banco de dados, retornando uma camisa
while ($carrocel = $res->fetch_assoc()) {
    
    
    $shirts_likeyou .= <<<HTML

       
    <div class="item">
        <a href="/pagsprincipais/viewproducts.php?id={$carrocel['shirts_id']}">
            <div class="card-content">
                <div class="card">
                    <img src="{$carrocel['shirts_image']}" alt="">
                        <p class = "product-title">{$carrocel['shirts_title']}</p>
                        <span class="product-price"> {$carrocel['shirts_price']}</span>
                        <p class="product-desc">{$carrocel['shirts_descript']}</p>
                </div>
            </div>
        </a>
    </div>  



    HTML;
}


// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";

?>

<link rel="stylesheet" href="/css/styleview.css">

<main>


    <div class="view-product">
    
        <?php echo $shirt_view ?>

    </div>

    <div class="title-colecion">
        <h3>VOCÊ VAI GOSTAR</h3>
    </div>

    <div class="owl-carousel owl-theme">
        
            <?php echo $shirts_likeyou ?>
    
    </div>


</main>

 
<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_footer.php";

?>

