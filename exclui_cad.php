<?php
    error_reporting(E_ALL); // todas

    session_start();
    include_once("conexao.php");

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);     

    if (!empty($id)){
        $result_markers = "DELETE FROM markers WHERE id='$id'";
        $resultado_markers = mysqli_query($conn, $result_markers);
        if(mysqli_affected_rows($conn)){       
            echo '<script type="text/javascript">
            alert("Cadastro apagado com sucesso.");
            window.location="http://localhost/bmpr/";
        </script>';
        }else{       
            echo '<script type="text/javascript">
            alert("Erro ao apagar cadastro.");
            window.location="http://localhost/bmpr/";
        </script>';
        }
    }else{       
        echo '<script type="text/javascript">
        alert("Necessário selecionar um cadastro.");
        window.location="http://localhost/bmpr/";
    </script>';
    }
    


    