<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_confg.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Variáveis desta página
$idprod = filter_input(INPUT_GET, 'id');

$form = [
        'feedback' => ''
];

if  ($user['registros_permission'] == 'admin'):

   
         $sql = <<<SQL

     DELETE FROM shirts 

         WHERE shirts_id = '{$idprod}';
             
     SQL;

    


         // Executa a query
         $res = $conn->query($sql);

         // Testa o resultado da atualização
         $result = $conn->affected_rows;

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
                 <p>O produto foi DELETADO com sucesso.</p>
                 <p><em>Obrigado...</em></p>
                           
OUT;

 endif;

    // se não for o admin tentando entrar joga para pagina index
    else:
        header('Location:http://projetocurso.localhost/pagsprincipais/index.php');
endif;

// Joga para pagina de painel
header('Location:http://projetocurso.localhost/admin/painelproduto.php');



// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";

/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/

?>


<main class="registerbox ">

        <?php echo $form['feedback']; ?>

</main>

