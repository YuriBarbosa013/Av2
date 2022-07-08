<?php
    include_once './conexão.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title> Incluir </title>
    </head> 
    <body>
            <a href="index.php">Listar</a><br>
            <a href="incluir.php">Incluir</a><br>
            <h1 style="margin: auto; width: 220px;">Incluir Ônibus</h1>

           <?php
            //Receber os dados do formulário
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); 

           if(!empty($dados['cadUsuario'])){
                $empty_input = false;

               $dados = array_map('trim', $dados); 
                if(in_array("", $dados)){
                    $empty_input = true;
                    echo "<center> <p style='color: red;'>Erro: Preencher todos os campos!!</p><center>";
                }
                
                if(!$empty_input){
                    $query_usuario = "INSERT INTO usuarios (marca, modelo, qtdAssentos, temBanheiro,temArCondicionado, chassi, placa)
                     VALUES ('" . $dados['marca'] . "', '" . $dados['modelo'] . "','" . $dados['qtdAssentos'] . "','" . $dados['temBanheiro'] . "', '" . $dados['temArCondicionado'] . "', '" . $dados['chassi'] . "', '" . $dados['placa'] . "')";
                    $cad_usuario = $conn->prepare($query_usuario);
                    $cad_usuario->execute();
                    
                   if($cad_usuario->rowCount() ){
                        echo "<center><p> Usuário cadastrado com sucesso!! </p></center><br>";
                    }else{
                        echo "Erro ao Cadastrar!<br>";
                    }
                }
            }
            ?>
            <form style="margin: auto; width: 220px;" name="cadUsuario" method="POST" action="">
                <label>Marca:</label><br>
                <input type="text" name="marca" id="marca" placeholder="Marca" ><br><br>
                <label>Modelo:</label>
                <input type="text" name="modelo" id="modelo" placeholder="Modelo" ><br><br>
                <label>QtdAssentos:</label>
                <input type="number" name="qtdAssentos" id="qtdAssentos" placeholder="QtdAssentos" ><br><br>
                <label>TemBanheiro:</label>
                <input type="number" name="temBanheiro" id="temBanheiro" placeholder="TemBanheiro" ><br><br>
                <label>TemArCondicionado:</label>
                <input type="number" name="temArCondicionado" id="temArCondicionado" placeholder="TemArCondicionado" ><br><br>
                <label>Chassi:</label>
                <input type="text" name="chassi" id="chassi" placeholder="Chassi" ><br><br>
                <label>Placa:</label>
                <input type="text" name="placa" id="placa" placeholder="Placa" ><br><br>

                <input type="submit" value="Cadastrar" onclick ="return validar()" >
               
            </form>
        
    </body>
</html>