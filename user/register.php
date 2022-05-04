<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_confg.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Variáveis desta página

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

// Variável que exibe/oculta Registro.
$show_form = true;

// Detecta se o registro foi enviado...
if (isset($_POST['send'])) :

    // Obtém os valores dos campos, sanitiza e armazena nas variáveis.
    // Atenção! A função "sanitize()" está em "/phpconfgs/_config.php".

    $form['email'] = sanitize('email', 'email');
    $form['cpf'] = sanitize('cpf', 'string');
    $form['name'] = sanitize('nome', 'string');
    $form['birth'] = sanitize('user_birth', 'string');
    $form['genero'] = sanitize('genero', 'string');
    $form['password'] = sanitize('password', 'string');
    $form['password2'] = sanitize('password2', 'string');
    $form['telefone'] = sanitize('phone', 'string');
    $form['nomedest'] = sanitize('receber', 'string');
    $form['cep'] = sanitize('cep', 'string');
    $form['address'] = sanitize('address', 'string');
    $form['number'] = sanitize('number', 'string');
    $form['district'] = sanitize('district', 'string');
    $form['city'] = sanitize('city', 'string');

    // Verifica se todos os campos form preenchidos
    if ($form['email'] === '' or $form['cpf'] === '' or $form['name'] === '' or $form['birth'] === '' or $form['genero'] === '' or $form['password'] === '' or $form['password2'] === '' or $form['telefone'] === '' or $form['nomedest'] === '' or $form['cep'] === '' or $form['address'] === '' or $form['number'] === '' or $form['district'] === '' or $form['city'] === '') :
        $form['feedback'] = '<h3 style="color:red">Erro: por favor, preencha todos os campos!</h3>';

    // Verifica se as senhas digitadas coincidem
    elseif ($form['password'] !== $form['password2']) :
        $form['feedback'] = '<h3 style="color:red">Erro: as senhas não coincidem!</h3>';
        $form['password'] = $form['password2'] = '';

    elseif (!validate_date($form['birth'])) :
        $form['feedback'] = '<h3 style="color:red">Erro: a data de nascimento está incorreta!</h3>';
        $form['birth'] = '';

    else :

        /*
        // Pesquisa pelo e-mail
        $sql = "SELECT user_id FROM `registros` WHERE registros_email = 'contato@test.net';";
        $res = $conn->query($sql);

        // Se e-mail existe
        if ($res->num_rows > 0) :
            $form['feedback'] = '<h3 style="color:red">Erro: este e-mail já está em uso!</h3>';

        else :
            */

            // Cria a query para salvar no banco de dados.
    // Insere registro no banco de dados
        $sql = <<<SQL

    INSERT INTO registros (
        registros_email,
        registros_cpf,
        registros_name,
        registros_birth,
        registros_genero,
        registros_password,
        registros_telefone,
        registros_nomeentrega,
        registros_cep,
        registros_address,
        registros_number,
        registros_district,
        registros_city
        
    ) VALUES (
        '{$form['email']}',
        '{$form['cpf']}',
        '{$form['name']}',
        '{$form['birth']}',
        '{$form['genero']}',
        SHA2('{$form['password']}', 512),
        '{$form['telefone']}',
        '{$form['nomedest']}',
        '{$form['cep']}',
        '{$form['address']}',
        '{$form['number']}',
        '{$form['district']}',
        '{$form['city']}'
    );

SQL;


    // Salva registros no banco de dados.
    $conn->query($sql);

    // Obtém somente primeiro nome do rementente.
    $first_name = explode(" ", $form['name'])[0];

    // Cria mensagem de confirmação.
    $form['feedback'] = <<<OUT
        
    <h3>Olá {$first_name}!</h3>
    <p>Seu cadastro foi criado com sucesso.</p>
    <p><em>Obrigado...</em></p

OUT;

    // Oculto o registro.
    $show_form = false;

    // Data de envio.
    $now = date('d/m/Y \à\s H:i');

    // Enviar e-mail para o o usuario.

    $to = '{$email}';
    $sj = 'Confirmação de conta na loja MGL';
    $msg = <<<MSG

    Contato enviado pelo site para confirmação de conta:

    Data: {}
    Remetente: {}
    E-mail: {}
    -----------------------------
    
    MSG;

        @mail($to, $sj, $msg);

    endif;

endif; // if (isset($_POST['send']))




// Define o titilo dessa pagina
$page_title = '';


// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";

/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/

?>


<link rel="stylesheet" href="/css/styleregister.css">

    <main class="registerbox ">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

            <input type="hidden" name="send" value="true">

        <?php echo $form['feedback']; ?>

        <?php if ($show_form) : ?>

            <div class = 'text-information'>
                <h2>Cadastro</h2>
                <p>Por favor, preencha os campos abaixo para criar sua conta na loja</p>
            </div>

            <div class="dadosp">
                <h2>Dados Pessoais</h2>
            </div>


            <div >
                <label for="email">E-mail *</label>
                <input type="text" name="email" id="email" class="dados" placeholder="Seu e-mail principal." autofocus>
            </div>

            <div>
                <label for="cpf">CPF *</label>
                <input type="text" name="cpf" id="cpf" class="dados">
            </div>

            <div>
                <label for="nome">Nome Completo *</label>
                <input type="text" name="nome" id="nome"class="dados" >
            </div>

            <div>
                <label for="user_birth">Data de Nascimento *</label>
                <input type="date" name="user_birth" value="yyyy-mm-dd" class="dados">
            </div>

            <div>
                <label for="genero">Gênero *</label>
                <select name="genero" class="dados">
                    <option value="opc">selecione...</option>
                    <option value="masculino">Maculino</option>
                    <option value="feminino">Feminino</option>
                </select>
            </div>

            <div>
                <label for="password">Informa a Senha *</label>
                <input type="password" name="password" id="password" class="dados">
            </div>

            <div>
                <label for="password2">Confirme a Senha *</label>
                <input type="password" name="password2" id="password2" class="dados">
            </div>

            <div>
                <label for="phone">Telefone Principal*</label>
                <input type="text" name="phone" id="phone" class="dados">
            </div>

            <div class="dadosp">
                <h2>Endereço de Cadastro</h2> 
            </div>

            <div>
                <label for="receber">Nome do Destinatário *</label>
                <input type="text" name="receber" id="receber" class="dados" placeholder="Quem receberá a entrega?">
            </div>

            <div>
                <label for="cep">CEP *</label>
                <input type="number" name="cep" id="cep" class="dados">
            </div>

            <div>
                <label for="address">Endereço *</label>
                <input type="text" name="address" id="address" class="dados">
            </div>

            <div>
                <label for="number">Número *</label>
                <input type="text" name="number" id="number" class="dados">
            </div>

            <div>
                <label for="district">Bairro *</label>
                <input type="text" name="district" id="district" class="dados">
            </div>

            <div>
                <label for="city">Cidade *</label>
                <input type="text" name="city" id="city" class="dados">
            </div>


            <div class='button'>
                <label></label>
                <button type="submit" class="txtbutton" >CADASTRAR</button>
            </div>

        <?php endif; ?>

        </form>

    </main>

<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_footer.php";

?>

