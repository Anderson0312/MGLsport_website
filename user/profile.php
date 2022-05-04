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
if (!isset($_COOKIE['user'])):

if (isset($_POST['send-profile'])) :

    // debug($_POST);

    // Obtém os valores dos campos, sanitiza e armazena nas variáveis.
    $form['registros_name'] = sanitize('name', 'string');
    $form['registros_birth'] = sanitize('birth', 'string');
    $form['registros_email'] = $user['registros_email'];
    $form['registros_password'] = sanitize('password', 'string');
    $form['registros_telefone'] = sanitize('telefone', 'string');

    // Verifica se todos os campos form preenchidos
    if ($form['registros_name'] === '' or $form['registros_birth'] === '' or $form['registros_password'] === '' or $form['registros_telefone'] === '') :
        $form['feedback'] = '<h3 style="color:red">Erro: por favor, preencha todos os campos!</h3>';

    // Verifica se a data é válida
    elseif (!validate_date($form['registros_birth'])) :
        $form['feedback'] = '<h3 style="color:red">Erro: a data de nascimento está incorreta!</h3>';
        $form['registros_birth'] = $user['user_birth'];
    else :

        // String de atualização
        $sql = <<<SQL

UPDATE registros 
SET 
    registros_name = '{$form['registros_name']}',
    registros_birth = '{$form['registros_birth']}',
    registros_telefone = '{$form['registros_telefone']}'
        

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
            $first_name = explode(" ", $form['registros_name'])[0];

            // Cria mensagem de confirmação.
            $form['feedback'] = <<<OUT
                    
                <h3>Olá {$first_name}!</h3>
                <p>Seu cadastro foi atualizado com sucesso.</p>
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

else:
    header('Location:http://projetocurso.localhost/pagsprincipais/index.php');
endif;

 // Define o título DESTA página.
 $page_title = "";

 // Opção ativa no menu
 $page_menu = "logged";
 
 
 // Inclui o cbeçalho da página
 require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";
 
?>

<link rel="stylesheet" href="/css/styleprofil.css">

<div class='secondheader'>
    <h2>MINHA CONTA</h2>
</div>

<main class = 'main-profil'>

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




<div class="alteration">

<h2>Editar perfil</h2>

<?php echo $form['feedback']; ?>

<?php if ($show_form) : ?>

    <p>Altere os dados no formulário abaixo:</p>

    <form class="alter" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" name="edit-profile">

        <input type="hidden" name="send-profile" value="true">

        <p>
            <label for="name">Nome *</label>
            <input type="text" name="name" id="name" placeholder="Seu nome completo." value="<?php echo $form['registros_name'] ?>" >
        </p>

        <p>
            <label for="email">E-mail *</label>
            <input type="email" name="email" id="email" placeholder="Seu e-mail principal." value="<?php echo $form['registros_email'] ?>" disabled>
        </p>


        <p>
            <label for="telefone">Telefone *</label>
            <input type="text" name="telefone" id="telefone" placeholder="Seu telefone" value="<?php echo $form['registros_telefone'] ?>">
        </p>

        <p>
            <label for="birth">Nascimento *</label>
            <input type="date" name="birth" id="birth" placeholder="Sua data de nascimento" value="<?php echo $form['registros_birth'] ?>">
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

</div>

</main>
 
<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_footer.php";

?>