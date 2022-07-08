<?php
session_start();
ob_start();

    include_once './conexão.php';

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
   
    if(empty($id)){
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Vizualizar </title>
    </head> 
    <body>
    <br><a href="index.php">Listar</a><br>
            <a href="incluir.php">Incluir</a><br><br>

            <h1 style="margin: auto; width: 220px;">Vizualizar</h1>

            <?php
           $query_usuario = "SELECT id, marca, modelo, qtdAssentos, temBanheiro,temArCondicionado, chassi, placa FROM usuarios WHERE id = $id";
           $result_usuario = $conn->prepare($query_usuario);
           $result_usuario->execute();

            if(($result_usuario) AND ($result_usuario->rowCount() !=0 )){
               $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

               extract($row_usuario); 

               echo "ID: $id <br>";
               echo "Marca: $marca <br>";
               echo "Modelo: $modelo <br>";
               echo "QtdAssentos: $qtdAssentos <br>";
               echo "TemBanheiro: $temBanheiro <br>";
               echo "TemArCondicionado: $temArCondicionado <br>";
               echo "Chassi: $chassi <br>";
               echo "Placa: $placa <br>";

              
            }else{
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
                header("Location: index.php");
            }

            ?>
    </body>
    </head>
</html>