<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_confg.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

 // Define o título DESTA página.
$page_title =  $shirt_painel_product = "";


// Verifica se é o admin tentando entrar na pagina
if  ($user['registros_permission'] == 'admin'):


    $sql = <<<SQL

    SELECT shirts_id, shirts_title, shirts_image, shirts_descript, shirts_size, shirts_team, shirts_colors, shirts_price
    FROM shirts 
    WHERE shirts_status = 'on' AND shirts_date <= NOW(); 


    SQL;

    // Executar a query e retorna dados na variável
    $res = $conn->query($sql);

    while ($shirts = $res->fetch_assoc()) {

        $shirt_painel_product .= <<<HTML


                <tr class='painel_product'>
                    <td> {$shirts['shirts_id']}  </td>
                    <td> {$shirts['shirts_title']} </td>
                    <td> {$shirts['shirts_price']} </td>
                    <td> {$shirts['shirts_team']} </td>
                    <td><img class='painel-img-product' src="{$shirts['shirts_image']}" ></td>
                    <td><a href="/admin/editproduto.php?id={$shirts['shirts_id']}" class="button-edit-product">Editar</a></td>

                    <td><a class="button-delet-product" href="/admin/deletproduto.php?id={$shirts['shirts_id']}">
                    Deletar
                    </a></td>
                </tr>
    HTML;

    }
    
    // se não for o admin tentando entrar joga para pagina index
    else:
        header('Location:http://projetocurso.localhost/pagsprincipais/index.php');
endif;

// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_header.php";

/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/
?>



<div class='secondheader'>
    <h2>PAINEL DE PRODUTOS</h2>
</div>

<div class='txtbutton-painel'>
        <a href="/admin/addproduto.php" class="button-add-product">ADICIONAR PRODUTO</a>
    </div>
<div class="container-table">
    
    <table class="table-striped-painel">
        <thead>
            <th>ID</th>
            <th>Produto</th>
            <th>Preço</th>
            <th>Times</th>
            <th>Foto</th>
            <th>Editar</th>
            <th>Deletar</th>
        </thead>
        <tbody>


        <?php echo $shirt_painel_product ?>

        </tbody>
    </table>
</div>




<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/phpconfgs/_footer.php";

?>