<?php


// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_confg.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Variáveis desta página
// $idprod = filter_input(INPUT_GET, 'id');
$id = $_GET['id'];


$form = [
    "nome" => '',
    "img1" => '',
    'img2' => '',
    'img3' => '',
    'img4' => '',
    'descript' => '',
    'team' => '',
    'size' => '',
    'colors' => '',
    'pric' => '',
    'amount' => '',

    'feedback' => ''
];


// Verifica se é o admin tentando entrar na pagina
if  ($user['registros_permission'] == 'admin'):

// Detecta se o registro foi enviado...
if (isset($_POST['send-editprod'])):

    // Obtém os valores dos campos, sanitiza e armazena nas variáveis.
    // Atenção! A função "sanitize()" está em "/phpconfgs/_config.php".


    $form['nome'] = sanitize('nome', 'string');
    // $form['img1'] = sanitize('file1', 'email');
    // $form['img2'] = sanitize('file2', 'email');
    // $form['img3'] = sanitize('file3', 'email');
    // $form['img4'] = sanitize('file4', 'email');
    $form['descript'] = sanitize('descript', 'string');
    $form['team'] = sanitize('team', 'string');
    $form['size'] = sanitize('size', 'string');
    $form['colors'] = sanitize('colors', 'string');
    $form['pric'] = sanitize('pric', 'string');
    $form['amount'] = sanitize('amount', 'string');



        
    // Verifica se todos os campos form preenchidos
    if ($form['nome'] === '' or $form['descript'] === '' or $form['team'] === '' or $form['size'] === '' or $form['colors'] === '' or $form['pric'] === '' or $form['amount'] === ''):
        $form['feedback'] = '<h3 style="color:red">Erro: por favor, preencha todos os campos!</h3>';

    else :

    
        $sql = <<<SQL

    UPDATE shirts 
        SET 
        shirts_title = '{$form['nome']}',
        shirts_descript = '{$form['descript']}',
        shirts_team = '{$form['team']}',
        shirts_size = '{$form['size']}',
        shirts_colors = '{$form['colors']}',
        shirts_price = '{$form['pric']}',
        shirts_amount = '{$form['amount']}'

        WHERE shirts_id = '{$id}'
             
    SQL;

    
// }

        // Executa a query
        $res = $conn->query($sql);
        

        // Testa o resultado da atualização
        $result = $conn->affected_rows;

        debug($result);

        // Se não atualizou...
        if ($result == 0) :
            $form['feedback'] = '<h3 style="color:red">Erro: Algo deu errado!</h3>';

        // Se deu erro no SQL...
        elseif ($result == -1) :
            $form['feedback'] = '<h3 style="color:red">Erro: falha no acesso ao banco de dados!</h3>';

        // Se deu tudo certo...
        else :

            // Cria mensagem de confirmação.
            $form['feedback'] = <<<OUT
                    
                <h3>Olá </h3>
                <p>Sua atualizado foi enviado.</p>
                <p><em>Obrigado...</em></p>
                           
OUT;
    endif;
endif;

// Joga para pagina de painel
// header('Location:http://projetocurso.localhost/admin/painelproduto.php');

endif; // if (isset($_POST['send']))

// se não for o admin tentando entrar joga para pagina index
else:
    header('Location:http://projetocurso.localhost/pagsprincipais/index.php');
endif;


// Define o titilo dessa pagina
$page_title = '';


// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";

/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/

?>

<link rel="stylesheet" href="/css/styleregister.css">

<div class='secondheader'>
    <h2>PAINEL DE PRODUTOS</h2>
</div>

<main class="registerbox ">



    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype='multipart/form-data'>
        <input type="hidden" name="send-editprod" value="true">
        <?php echo $form['feedback']; ?>

        <div class = 'text-information'>
                <h2>Editar Produto</h2>
                <p>Por favor, preencha os campos abaixo para adicionar o Produto</p>
        </div>

        <div >
                <label for="email">Nome Do Produto *</label>
                <input type="text" name="nome" id="nome" class="dados" placeholder="" autofocus>
        </div>

        <div>
                <label for="cpf">Descrição *</label>
                <input type="text" name="descript" id="descript" class="dados">
        </div>

        <div>
                <label for="cpf">Time *</label>
                <input type="text" name="team" id="team" class="dados">
        </div>

        <div>
                <label for="cpf">Tamanho *</label>
                <input type="text" name="size" id="size" class="dados">
        </div>

        <div>
                <label for="cpf">Cor *</label>
                <input type="text" name="colors" id="colors" class="dados">
        </div>

        <div>
                <label for="cpf">Preço *</label>
                <input type="text" name="pric" id="pric" class="dados">
        </div>

        <div>
                <label for="cpf">Quantidade *</label>
                <input type="number" name="amount" id="amount" class="dados">
        </div>

        <div class='button'>
                <label></label>
                <button type="submit" class="txtbutton" >CADASTRAR PRODUTO</button>
        </div>
    </form> 

</main>

<?php


// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_footer.php";


?>