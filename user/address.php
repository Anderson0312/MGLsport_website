<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_confg.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/
// Variáveis do script
$form['feedback'] = '';
$show_form = true;

// Se não estiver logado, vai para a 'index'.
if (!isset($_COOKIE['user'])) header('Location:http://projetocurso.localhost/user/login.php');

if (isset($_POST['send-address'])) :

    // debug($_POST);

    // Obtém os valores dos campos, sanitiza e armazena nas variáveis.
    $form['registros_cep'] = sanitize('cep', 'string');
    $form['registros_address'] = sanitize('address', 'string');
    $form['registros_number'] = sanitize('number', 'string');
    $form['registros_district'] = sanitize('district', 'string');
    $form['registros_city'] = sanitize('city', 'string');
    $form['registros_password'] = sanitize('password', 'string');
    
    // Verifica se todos os campos form preenchidos
    if ($form['registros_cep'] === '' or $form['registros_password'] === '' or $form['registros_address'] === '' or $form['registros_number'] === '' or $form['registros_district'] === '' or $form['registros_city'] === '') :
        $form['feedback'] = '<h3 style="color:red">Erro: por favor, preencha todos os campos!</h3>';

    else :

        // String de atualização
        $sql = <<<SQL

UPDATE registros 
SET 
    registros_cep = '{$form['registros_cep']}',
    registros_address = '{$form['registros_address']}',
    registros_number = '{$form['registros_number']}',
    registros_district = '{$form['registros_district']}',
    registros_city = '{$form['registros_city']}'
        

WHERE registros_id = '{$user['registros_id']}' 
AND registros_password = SHA2('{$form['registros_password']}', 512);

SQL;

        // Executa a query
        $res = $conn->query($sql);

        // Testa o resultado da atualização
        $result = $conn->affected_rows;

        // Se não atualizou...
        if ($result == 0) :
            $form['feedback'] = '<h3 style="color:red">Erro: a senha está incorreta!</h3>';

        // Se deu erro no SQL...
        elseif ($result == -1) :
            $form['feedback'] = '<h3 style="color:red">Erro: falha no acesso ao banco de dados!</h3>';

        // Se deu tudo certo...
        else :

            // Obtém somente primeiro nome do rementente.
            $first_name = explode(" ", $user['registros_name'])[0];

            // Cria mensagem de confirmação.
            $form['feedback'] = <<<OUT
                    
                <h3>Olá {$first_name}!</h3>
                <p>Seu Endereço foi atualizado com sucesso.</p>
                <p><em>Obrigado...</em></p>
                
OUT;

            // Oculto o formulário.
            $show_form = false;

        endif;

    endif;

else :

    // Obtendo dados do usuário direto do banco de dados.
    $sql = <<<SQL

SELECT * FROM `registros`
WHERE registros_id = '{$user['registros_id']}'
AND registros_status = 'confirmed';

SQL;

    // Executa a consulta
    $res = $conn->query($sql);

    // Se não retornar nada, volta para profile.
    if ($res->num_rows !== 1) header('Location: /user/profile.php');

    // Associa os dados ao formulário
    $form = $res->fetch_assoc();

    // Variáveis do script
    $form['feedback'] = '';

endif;

 // Define o título DESTA página.
 $page_title = "";

 // Opção ativa no menu
 $page_menu = "logged";
 

 // Define o título DESTA página.
 $page_title = "";

 // Opção ativa no menu
 $page_menu = "logged";
 
 
 // Inclui o cbeçalho da página
 require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";
 
?>



<div class='secondheader'>
    <h2>MINHA CONTA</h2>
</div>

<main class="main-profil">

    <div class="profil">
        <img src="/user/imguser/userpicture.jpeg" alt="">
        <p> <?php echo "{$user['registros_name']}   " ?> <?php echo "#{$user['registros_id']}"?></p>
    </div>

    <div class="opc_painel">
        <a href="/user/logged.php">
            <h3>PAINEL</h3>
        </a>

        <?php if  ($user['registros_email'] == 'andersonmoura812@gmail.com'): ?>
            <a href="/admin/painelproduto.php">
                <h3>PAINEL DE ADMIN</h3>
            </a>
        <?php endif; ?>

        <a href="/user/request.php">
            <h3>PEDIDOS</h3>
        </a>

        <a href="/user/address.php">
            <h3>ENDEREÇO</h3>
        </a>

        <a href="/user/profile.php">
            <h3>DETALHES DA CONTA</h3>
        </a>

        <a href="/user/password.php">
            <h3>ALTERAR SENHA</h3>
        </a>

        <a href="/user/logout.php">
            <h3>SAIR</h3>
        </a>
    </div>




<div class="infos">

<?php echo $form['feedback']; ?>

<?php if ($show_form) : ?>

<h2>Editar Endereço</h2>
        <p >Os endereços a seguir serão usados na pagina de filalização de compra por padrão.</p>


    <p>Altere os dados no formulário abaixo:</p>

    <form class="alter" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" name="edit-address">

        <input type="hidden" name="send-address" value="true">

        <p>
            <label for="cep">Cep *</label>
            <input type="text" name="cep" id="cep" placeholder="Seu cep." value="<?php echo $form['registros_cep'] ?>" >
        </p>

        <p>
            <label for="address">Endereço *</label>
            <input type="text" name="address" id="address" placeholder="Seu e-mail principal." value="<?php echo $form['registros_address'] ?>" >
        </p>

        <p>
            <label for="number">Número *</label>
            <input type="text" name="number" id="number" placeholder="Seu cep" value="<?php echo $form['registros_number'] ?>">
        </p>

        <p>
            <label for="district">Bairro *</label>
            <input type="text" name="district" id="district" placeholder="Seu telefone" value="<?php echo $form['registros_district'] ?>">
        </p>

        <p>
            <label for="city">Cidade *</label>
            <input type="text" name="city" id="city" placeholder="Sua data de nascimento" value="<?php echo $form['registros_city'] ?>">
        </p>

        <p>
            <label for="password">Senha atual *</label>
            <input type="password" name="password" id="password" placeholder="Sua senha." value="">
        </p>

        <div class="btn-edit">
            <button type="submit">Salvar Ateração</button>
        </div>
        


    </form>

<?php endif; ?>


</main>


 
<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_footer.php";

?>