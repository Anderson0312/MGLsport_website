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
    
if (isset($_POST['send-password'])) :

    // debug($_POST);

    // Obtém os valores dos campos, sanitiza e armazena nas variáveis.
    $form['registros_passwordold'] = sanitize('passwordold', 'string');
    $form['registros_passwordnew'] = sanitize('passwordnew', 'string');
    $form['registros_passwordnew2'] = sanitize('passwordnew2', 'string');

    // Verifica se todos os campos form preenchidos
    if ($form['registros_passwordold'] === '' or $form['registros_passwordnew'] === '' or $form['registros_passwordnew2'] === '') :
        $form['feedback'] = '<h3 style="color:red">Erro: por favor, preencha todos os campos!</h3>';

    // Verifica se as senhas digitadas coincidem
    elseif ($form['registros_passwordnew'] !== $form['registros_passwordnew2']) :
        $form['feedback'] = '<h3 style="color:red">Erro: as senhas não coincidem!</h3>';
        $form['registros_passwordnew'] = $form['registros_passwordnew2'] = '';

    else :

        // String de atualização
        $sql = <<<SQL

UPDATE registros 
SET 
    registros_password = SHA2('{$form['registros_passwordnew']}',512)
WHERE registros_id = '{$user['registros_id']}' 
AND registros_password = SHA2('{$form['registros_passwordold']}', 512);


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

            // Cria mensagem de confirmação.
            $form['feedback'] = <<<OUT
                    
                <h3>Olá </h3>
                <p>Sua atualizado foi enviado.</p>
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
        <h2>Editar Senha</h2>
    
        <?php echo $form['feedback']; ?>

<?php if ($show_form) : ?>

    <p>Altere os dados no formulário abaixo:</p>

    <form class="alter" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" name="edit-profile">

        <input type="hidden" name="send-password" value="true">

        <p>
            <label for="passwordold">Senha Atual *</label>
            <input type="password" name="passwordold" id="passwordold" placeholder="Sua senha atual." value="">
        </p>

        <p>
            <label for="passwordnew">Senha Nova *</label>
            <input type="password" name="passwordnew" id="passwordnew" placeholder="Sua nova senha." value="">
        </p>

        <p>
            <label for="passwordnew2">Confirmação da Senha *</label>
            <input type="password" name="passwordnew2" id="passwordnew2" placeholder="Confirme a senha." value="">
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