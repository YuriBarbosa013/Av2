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

    $query_usuario = "SELECT id, marca, modelo, qtdAssentos, temBanheiro, temArCondicionado, chassi, placa FROM usuarios WHERE id = $id LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->execute();

    if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
        $row_usuario = $result_usuario->fetch (PDO::FETCH_ASSOC);

    }else{
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
        header("Location: index.php");
        exit();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Editar </title>

    
    </head> 
    <body>
    <br><a href="index.php">Listar</a><br>
        <a href="incluir.php">Incluir</a><br><br>

            <h1 style="margin: auto; width: 220px;">Editar</h1>

        <?php

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($dados['EditUsuario'])){
            $empty_input = false;
            $dados = array_map('trim', $dados);
            if(in_array("", $dados)){
                $empty_input = true;
                echo "<p style='color: #f00;'> Erro: Preencher todos os campos!!</p>";
            }
            if(!$empty_input){
                echo"Editar <br>";
            }
        }

        ?>

            <form  name= "onibus "id="edit-usuario" method="POST" action="">
                <label>Marca</label>
                <input type="text" name="marca" id="marca" placeholder="Marca" value="<?php
                if(isset($dados['marca'])){
                    echo $dados['marca'];
                }elseif(isset ($row_usuario['marca'])){ echo $row_usuario['marca']; } ?>"><br><br>

                <label>Modelo</label>
                <input type="text" name="modelo" id="modelo" placeholder="Modelo" value="<?php
                if(isset($dados['modelo'])){
                    echo $dados['modelo'];
                }elseif(isset ($row_usuario['modelo'])){ echo $row_usuario['modelo']; } ?>"><br><br>

               <label>QtdAssentos</label>
               <input type="number" name="qtdAssentos" id="qtdAssentos" placeholder="QtdAssentos" value="<?php
                if(isset($dados['qtdAssentos'])){
                   echo $dados['qtdAssentos'];
                }elseif(isset ($row_usuario['qtdAssentos'])){ echo $row_usuario['qtdAssentos']; } ?>"><br><br>

                <label>TemBanheiro</label>
                <input type="number" name="temBanheiro" id="temBanheiro" placeholder="TemBanheiro" value="<?php
                if(isset($dados['temBanheiro'])){
                    echo $dados['temBanheiro'];
                }elseif(isset ($row_usuario['temBanheiro'])){ echo $row_usuario['temBanheiro']; } ?>"><br><br>

                <label>TemArCondicionado</label>
                <input type="number" name="temArCondicionado" id="temArCondicionado" placeholder="TemArCondicionado" value="<?php
                if(isset($dados['temArCondicionado'])){
                    echo $dados['temArCondicionado'];
                }elseif(isset ($row_usuario['temArCondicionado'])){ echo $row_usuario['temArCondicionado']; } ?>"><br><br>

                <label>Chassi</label>
                <input type="text" name="chassi" id="chassi" placeholder="Chassi" value="<?php
                if(isset($dados['chassi'])){
                    echo $dados['chassi'];
                }elseif(isset ($row_usuario['chassi'])){ echo $row_usuario['chassi']; } ?>"><br><br>

                <label>Placa</label>
                <input type="text" name="placa" id="placa" placeholder="Placa" value="<?php
                if(isset($dados['placa'])){
                    echo $dados['placa'];
                }elseif(isset ($row_usuario['placa'])){ echo $row_usuario['placa']; } ?>"><br><br>

                <input type="submit" value="Salvar" name="EditUsuario">
            </form>
    </body>
</html>