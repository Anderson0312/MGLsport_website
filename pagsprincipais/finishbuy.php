<?php

session_start();
// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_confg.php";


/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/
// Variáveis do script
$form = [
    "email" => '',
    "cpf" => '',
    'name' => '',
    'birth' => '',
    'genero' => '',
    'password' => '',
    'password2' => '',
    'telefone' => '',
    'nomedest' => '',
    'cep' => '',
    'address' => '',
    'number' => '',
    'district' => '',
    'city' => '',

    'feedback' => ''
];

$show_form = true;
$product_cart =  '' ;
$total= 0;

if (!isset($_COOKIE['user'])) header('Location: /user/login.php');

if (isset($_POST['finish-buy'])) :

    //debug($_POST);
    // Obtém os valores dos campos, sanitiza e armazena nas variáveis.
    $form['registros_birth'] = sanitize('bith', 'string');
    $form['registros_email'] = $user['registros_email'];
    $form['registros_namefrist'] = sanitize('namefrist', 'string');
    $form['registros_cpf'] = sanitize('cpf', 'string');
    $form['registros_cep'] = sanitize('cep', 'string');
    $form['registros_street'] = sanitize('street', 'string');
    $form['registros_number'] = sanitize('number', 'string');
    $form['registros_district'] = sanitize('district', 'string');
    $form['registros_city'] = sanitize('city', 'string');
    $form['registros_telefone'] = sanitize('telefone', 'string');
    
    // Verifica se todos os campos form preenchidos
    if ($form['registros_birth'] === '' or $form['registros_email'] === '' or $form['registros_namefrist'] === '' or $form['registros_cpf'] === '' or $form['registros_cep'] === '' or $form['registros_street'] === '' or $form['registros_number'] === '' or $form['registros_district'] === '' or $form['registros_city'] === '' or $form['registros_telefone'] === '') :
        $form['feedback'] = '<h3 style="color:red">Erro: por favor, preencha todos os campos!</h3>';
  

    else :

        // String de atualização
        $sql = <<<SQL


-- Atualiza os dados caso a pessoa desejar antes do faturamento
UPDATE registros 
SET 
    registros_birth = '{$form['registros_birth']}',
    registros_name = '{$form['registros_namefrist']}',
    registros_cpf = '{$form['registros_cpf']}',
    registros_cep = '{$form['registros_cep']}',
    registros_telefone = '{$form['registros_telefone']}',
    registros_address = '{$form['registros_address']}',
    registros_number = '{$form['registros_number']}',
    registros_district = '{$form['registros_district']}',
    registros_city = '{$form['registros_city']}'
        

WHERE registros_id = '{$user['registros_id']}';

SQL;
    // Executa a query
    $res = $conn->query($sql);

    // Testa o resultado da atualização
    $result = $conn->affected_rows;   

endif;


else :

        // String de atualização
        $sql = <<<SQL

SELECT * FROM `registros`
WHERE registros_id = '{$user['registros_id']}'
AND registros_status = 'confirmed';

SQL;

    // Executa a consulta
    $res = $conn->query($sql);

    $users = $res->fetch_assoc();
    

    // Obtém somente primeiro nome do rementente.
    $first_name = explode(" ", $user['registros_name'])[0];

    // Cria mensagem de confirmação.
    $form['feedback'] = <<<OUT
        
    <h3>Olá {$first_name}!</h3>
    <p>Seu Pedido foi feito com sucesso.</p>
    <p><em>Obrigado...</em></p

    OUT;

    // Oculto o registro.
    $show_form = false;

    // Data de pedido.
    $now = date('d/m/Y \à\s H:i');

    // Enviar e-mail para o o usuario.

    $to = '{$email}';
    $sj = 'Confirmação de Pedido na loja MGL';
    $msg = <<<MSG

    Contato enviado pelo site para confirmação de Compra:

    Data: {}
    Remetente: {}
    E-mail: {}
    -----------------------------
    
    MSG;

        @mail($to, $sj, $msg);



endif; // if (isset($_POST['send']))


    //pega o id do url 
    if (isset($_GET['del'])) {
        $iddell = intval($_GET['del']); // adicioan o id na variavel
        if (isset($_SESSION['carrinho'][$iddell])) { // verifica se o id tem no carrinho
            unset($_SESSION['carrinho'][$iddell]); // deleta o id desejado

        }
    }

// verifica se tem algo no produto para finalizar a compra
if ($_SESSION['carrinho'] >= 0  ):

    // entrar na session e para cada produto pega os valores do array
    foreach($_SESSION['carrinho'] as $value) {

        // Consulta ao banco de dados para revisar produtos
        $sql = <<<SQL

        SELECT * FROM `shirts`
        WHERE shirts_id = '{$value['id']}}'
        AND shirts_status= 'on';

        SQL;

        // Executar a query e retorna dados na variável do banco de dados
        $res = $conn->query($sql);

         // roda o loop enquanto tiver retorno do banco de dados, retornando uma camisa
        while ($product = $res->fetch_assoc()) :

            $product_cart .= <<<HTML

                <div class="product-item-cart">    
                    <div class="product-item-cart-img">
                    <a href="/pagsprincipais/finishbuy.php?del={$product['shirts_id']}"><i class='bx bx-x' ></i></>
                        <a href="/pagsprincipais/viewproducts.php?id={$product['shirts_id']}"><img src="{$product['shirts_image']}" class="img_itens" alt="{$product['shirts_title']}"></a>
                    </div>
        
                    <div class="product-item-desc">
                        <h3><a href="/pagsprincipais/viewproducts.php?id={$product['shirts_id']}">{$product['shirts_title']}</a></h3>
                        <p class="description">{$product['shirts_descript']}</p>
                        <span class="product-price">R$ {$product['shirts_price']}</span>
                    </div>
                </div>

                HTML;
        $total = $product['shirts_price']+$total;
        endwhile;
        
    };

endif;



// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";


?>

<link rel="stylesheet" href="/css/cartstyle.css">

<div>  
    <h2 class="secondheader">
        FINALIZAR PEDIDO
    </h2>
</div>


<div class="form-finish-buy">
    <div class="form-details">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" name="finish-buy">

        <input type="hidden" name="finish-buy" value="true">

            <div class="form-title-finishpbuy">
                <h3>DETALHES DE FATURAMENTO</h3>
            </div>
            <div >
                <input type="text" name="email" id="email"  class="dados" value="<?php echo $user['registros_email'] ?>" disabled>
            </div>
            <div >
                <input type="text" name="namefrist" id="namefrist" class="dados" value="<?php echo $user['registros_name'] ?>">
            </div>
            <div >
                <input type="text" name="cpf" id="cpf" class="dados" value="<?php echo $users['registros_cpf'] ?>">
            </div>
            <div >
                <input type="date" name="bith" id="bith" class="dados" value="<?php echo $user['registros_birth'] ?>">
            </div>
            <div >
                <input type="text" name="cep" id="cep" class="dados" value="<?php echo $users['registros_cep'] ?>">
            </div>
            <div >
                <input type="text" name="street" id="street" class="dados" value="<?php echo $users['registros_address'] ?>">
            </div>
            <div >
                <input type="text" name="number" id="numero" class="dados" value="<?php echo $users['registros_number'] ?>">
            </div>
            <div >
                <input type="text" name="district" id="district" class="dados" value="<?php echo $users['registros_district'] ?>">
            </div>
            <div >
                <input type="text" name="city" id="city" class="dados" value="<?php echo $users['registros_city'] ?>">
            </div>
            <div >
                <input type="text" name="numberphone" id="numberphone" class="dados" value="<?php echo $user['registros_telefone'] ?>">
            </div>
        </form>
    </div>
    <div class="review-products">
        <div class="form-details">
            <div class="form-title-finishpbuy">
                <h3>REVISE SEU PEDIDO</h3>
            </div>
            <div>
                <?php echo $product_cart ?>
            </div>
            <div class='tot-pedido'>
                TOTAL
                <span>R$<?php echo$total ?></span>
            </div>
        </div>
    </div>


    <div class="review-products">
        <div class="form-details">
            <div class="form-title-finishpbuy">
                <h3>PAGAMENTOS</h3>
            </div>
        </div>
    </div>
</div>






<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_footer.php";

?>