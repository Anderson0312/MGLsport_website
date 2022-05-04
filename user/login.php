<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_confg.php";


// Define o titilo dessa pagina
$page_title = '';


// Se usuário já está logado, redireciona para a index.php
if (isset($_COOKIE['user'])) header('Location: /');

// Variáveis desta página
$form = [
    'email' => '',
    'password' => '',
    'keep' => '',
    'feedback' => ''
];

// Variável que exibe/oculta formulário.
$show_form = true;

// Detecta se o formulário foi enviado...
if (isset($_POST['send'])) :

    // Obtém os valores dos campos, sanitiza e armazena nas variáveis.
    // Atenção! A função "sanitize()" está em "/_config.php".
    $form['email'] = sanitize('email', 'email');
    $form['password'] = sanitize('password', 'string');

    // Tratamento de 'keep'.
    if (isset($_POST['keep'])) $form['keep'] = true;
    else $form['keep'] = false;

    // Verifica se todos os campos form preenchidos
    if ($form['email'] === '' or $form['password'] === '') :
        $form['feedback'] = '<h3 style="color:red">Erro: por favor, preencha todos os campos!</h3>';

    else :

        // Cria a query para verificar usuário e senha no bnco de dados.
        $sql = <<<SQL


        SELECT registros_id, registros_date, registros_name, registros_email, registros_birth, registros_telefone, registros_permission
        FROM `registros`
        WHERE registros_email = '{$form['email']}'
        AND registros_password = SHA2('{$form['password']}', 512)
        AND registros_status = 'confirmed'

SQL;


        // Executa a consulta.
        $res = $conn->query($sql);
    
        // Se não retornou apenas um registro
        if ($res->num_rows !== 1) :

            // Gera mensagem de erro
            $form['feedback'] = '<h3 style="color:red">Erro: credenciais não encontradas!</h3>';
 
            // Limpa campos do formulário
            $form['email'] = $form['password'] = '';

        else :

            // Obtém valor do cookie do banco de dados
            $user = $res->fetch_assoc();


            // Tempo de vida do cookie 
            if ($form['keep']) $cookie_live = time() + 86400 * 365;
            else $cookie_live = 0;

            // Cria cookie
            setcookie('user', json_encode($user), $cookie_live, '/');
            
            // Tudo certo? Carregue a página de feedback.
            header ('Location: /user/logged.php');

        endif;

    endif;

endif; // if (isset($_POST['send']))

// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";



?>

<?php // Conteúdo ?>



    <main class="loginbox ">
        <form class="form-login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <input type="hidden" name="send" value="true">
            <?php echo $form['feedback']; ?>

            <?php if ($show_form) : ?>

                <div class = 'text-information'>
                    <h2>Entrar</h2>
                    <p>Entre com seu email e senha para continuar</p>
                </div>

                <div class='dados'>
                    <div >
                        <input type="text" placeholder="Email" class="email" name="email" autofocus>
                    </div>
                    <div>
                        <input type="password" placeholder='Password' name="password" class="password">
                    </div>
                </div>

                <div class='button'>
                <label></label>
                    <button type="submit" class="txtbutton" >LOGIN</button>
                </div>

                <div class='checkbox'>
                    <input type="checkbox" checked="checked" class="chk" name="keep">
                    <label >Lembrar-me</label>
                </div>

                <p id="">Esqueceu sua senha? <a href="#" class="txtefet">Clique aqui</a> para recebê-la por e-mail </p>

                <p id="register"><a href="register.php" class="txtefet">Efetuar cadastrado</a> </p>
            <?php endif; ?>
        </form>


    </main>


<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_footer.php";

?>