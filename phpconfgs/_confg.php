<?php 
    // Configura a página de caracteres do PHP para UTF-8
    header("Content-type: text/html; charset=utf-8");


    
    /******************************************************
     * Gera variáveis do tema à partir do banco de dados. *
     ******************************************************/
   
    //Variaveis do Tema
    $site_name = 'MGL';

    // Define o título <title>...</title> de cada página
    $page_title = 'MGL';

    // logo do site
    $site_logo = '/imgbanner/Logo.png';

    // rodapé do site 
    $site_rodap = 'AndersonM';

    

    // Faz conexão com MySQL/MariaDB
    // Os dados da conexão estão em "_config.ini"
    $i = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/_confg.ini', true);

    foreach ($i as $key => $value) :
        if ($_SERVER['SERVER_NAME'] == $key) :

            // Conexão com MySQL/MariaDB usando "mysqli" (orientada a objetos)
            @$conn = new mysqli($value['server'], $value['user'], $value['password'], $value['database']);

            // Trata possíveis exceções
            if ($conn->connect_error) die("Falha de conexão com o banco e dados: " . $conn->connect_error);
        endif;
    endforeach;

        // Seta transações com MySQL/MariaDB para UTF-8
        $conn->query("SET NAMES 'utf8'");
        $conn->query('SET character_set_connection=utf8');
        $conn->query('SET character_set_client=utf8');
        $conn->query('SET character_set_results=utf8');
        
        // Seta dias da semana e meses do MySQL/MariaDB para "português do Brasil"
        $conn->query('SET GLOBAL lc_time_names = pt_BR');
        $conn->query('SET lc_time_names = pt_BR');
        

    // Define o fuso horário (opcional).
    date_default_timezone_set('America/Sao_Paulo');



    /*****************************************************************************
     * Verifica se tem usuário logado, obtendo os dados deste, direto do cookie. *
     *****************************************************************************/

    // Verifica se usuário está logado, testando o cookie dele.
    if (isset($_COOKIE['user'])) :

        // Obtém dados do usuário pelo cookie
        $user = json_decode($_COOKIE['user'], true);

        // Converte datas para pt-BR
        $user['birth_br'] = date_to_br($user['registros_birth']);
        $user['date_br'] = date_to_br($user['registros_date']);
        
        // Somente primeiro nome
        $user['first_name'] = explode(' ', $user['registros_name'])[0];


    else :

        // Define nome do usuário para o menu
        $user['first_name'] = '';

    endif;


    /********************
    * Funções globais. *
    ********************/

    // Função que sanitiza campos de formulário.
    function sanitize($field_name, $field_type)
    {

        // Variável com valor do campo filtrado.
        $field_value = '';

        // Aplica o filtro adequado ao tipo de campo.
        switch ($field_type):

                // Se é um campo 'string', remove caracteres perigosos.
            case 'string':
                $field_value = htmlspecialchars($_POST[$field_name]);
                break;

                // Se é um campo 'email', remove caracteres inválidos.
            case 'email':
                $field_value = filter_input(INPUT_POST, $field_name, FILTER_SANITIZE_EMAIL);
                break;

        endswitch;

        // Remove espaços antes e depois da string.
        $field_value = trim($field_value);

        // Remove espaços duplicados no meio da string.
        $field_value = preg_replace('/\\s\\s+/', ' ', $field_value);

        // Retorna o valor do campo já sanitizado.
        return $field_value;
    }

    // Valida datas

    function validate_date($date, $format ='Y-m-d') 
    {
        $d = Datetime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    // Converte 'system date' para 'BR date'.
    function date_to_br($sysdate)
    {

        // Se é data e hora...
        if (str_contains($sysdate, ' ')) return date('d/m/Y \à\s H:i', strtotime($sysdate));

        // Se é somente data...
        else return date('d/m/Y', strtotime($sysdate));
    }


    // Função para ajudar a 'debugar' o código.
    function debug($data, $exit = false)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if ($exit) exit;
    }
