<?php
    include_once("conexao.php");

    $pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
    
    //Calcular o inicio da visualização
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    // consulta BD
    $result_cad = "SELECT * FROM markers ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
    $resultado_cad = mysqli_query($conn, $result_cad);
    
    // verifica se encontrou resultado no na Tabela
    if (($resultado_cad) AND ($resultado_cad->num_rows != 0)) {
        ?>
        <div class="container">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Total Efetivo</th>
                    <th scope="col">Afastado</th>
                    <th scope="col">Percentual Afastado</th>
                    <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php   
                    while ($row_cad = mysqli_fetch_assoc($resultado_cad)){
                    ?>
                    <tr>
                        <th><?php echo $row_cad['name'] ?></th>
                        <td><?php echo $row_cad['address'] ?></td>
                        <td><?php echo $row_cad['total_efetivo'] ?></td>
                        <td><?php echo $row_cad['afastado'] ?></td>
                        <td><?php echo $row_cad['percento_afastado'] . "%" ?></td>
                        <td><?php echo '<a href="edit_cad.php?id='.$row_cad['id'].'" class="btn btn-warning">Editar</a>&ensp;<a href="exclui_cad.php?id='.$row_cad['id'].'" class="btn btn-danger">Excluir</a>';?></td>
                        
                    </tr>
                    <?php       
                    }?>
                </tbody>
            </table>
        </div>
    <?php
    
    // Paginação - Somar a quantidade de cadastro no DB
    $result_pg = "SELECT COUNT(id) as num_result FROM markers";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);    

    // Quantidade de páginas
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    //Limitar os links antes depois
    $max_links = 2;
    
    echo '<br><br><br><br>';
    echo '<nav aria-label="Page navigation example">';
    echo '  <ul class="pagination justify-content-center">';
    echo '    <li class="page-item">';
    echo "<a class='page-link' href='#' tabindex='-1' aria-disabled='true' onclick='listar_cad(1, $qnt_result_pg)'>Primeira</a>";    
    echo '    </li>';
    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina -1; $pag_ant ++){
        if($pag_ant >=1){
            echo "<li class='page-item'><a class='page-link' href='#' onclick='listar_cad($pag_ant, $qnt_result_pg)'> $pag_ant</a></li>";
        }
    }
    echo '<li class="page-item active" aria-current="page">';
    echo '<a class="page-link" href="#">';
    echo "$pagina";
    echo '<span class="sr-only">(current)</span></a>';
    for($pag_dep = $pagina +1; $pag_dep <= $pagina + $max_links; $pag_dep ++){
        if($pag_dep <= $quantidade_pg){
            echo "<li class='page-item'><a class='page-link' href='#' onclick='listar_cad($pag_dep, $qnt_result_pg)'> $pag_dep</a></li>";
        }
    }    
    echo '    <li class="page-item">';
    echo "<a class='page-link' href='#' onclick='listar_cad($quantidade_pg, $qnt_result_pg)'> Última</a>";    
    echo '    </li>';
    echo '  </ul>';
    echo '</nav>';    
    } else {
    echo "Nenhum cadastro encontrado";
    }