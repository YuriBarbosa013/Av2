<?php
    include_once './conexão.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type ="text/javascript">
            funcion validar() {
               var marca = onibus.marca.value;
               var modelo = onibus.modelo.value;
               var qtdAssentos = onibus.qtdAssentos.value;
               var temBanheiro = onibus.temBanheiro.value;
               var temArCondicionado = onibus.temArCondicionado.value;
               var chassi = onibus.chassi.value;
               var placa = onibus.placa.value;

               if (marca == ""){
                alert('Preencha o campo Marca.');
                onibus.marca.focus();
                return false;
               }
               if (modelo == ""){
                alert('Preencha o campo Modelo.');
                onibus.modelo.focus();
                return false;
               }
               if (qtdAssentos == ""){
                alert('Preencha o campo QtdAssentos.');
                onibus.qtdAssentos.focus();
                return false;
               }
               if (temBanheiro == ""){
                alert('Preencha o campo TemBanheiro.');
                onibus.temBanheiro.focus();
                return false;
               }
               if (temArCondicionado == ""){
                alert('Preencha o campo TemArCondicionado.');
                onibus.temArCondicionado.focus();
                return false;
               }
               if (chassi == ""){
                alert('Preencha o campo Chassi.');
                onibus.chassi.focus();
                return false;
               }
               if (placa == ""){
                alert('Preencha o campo Placa.');
                onibus.placa.focus();
                return false;
               }
            }
        </script>
        <title> Listar </title>
    </head> 
    <body>
            <a href="index.php">Listar Ônibus</a><br>
            <a href="incluir.php">Incluir</a><br>
            <h1 style="margin: auto; width: 220px;">Listar</h1>

            <?php
            //Receber o numero da página
            $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
            $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

            //Setar a quantidade de registros por página
            $limite_resultado = 20;

            //Calcular o inicio da visualização
            $inicio = ($limite_resultado * $pagina) - $limite_resultado;

           $query_usuarios = "SELECT id,marca,modelo,qtdAssentos,temBanheiro,temArCondicionado,chassi,placa  FROM usuarios LIMIT $inicio, $limite_resultado";
           $result_usuarios = $conn->prepare($query_usuarios);
           $result_usuarios->execute();

           if( ($result_usuarios) AND ($result_usuarios->rowCount () !=0) ){
               while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
                   
                   extract($row_usuario);
                   echo "ID: $id <br>";
                   echo "Marca: $marca <br>";
                   echo "Modelo: $modelo <br>";
                   echo "QtdAssentos: $qtdAssentos <br>";
                   echo "TemBanheiro: $temBanheiro <br>";
                   echo "temArCondicionado: $temArCondicionado <br>";
                   echo "Chassi: $chassi <br>";
                   echo "Placa: $placa <br><br>";
                   
                    echo "<a href='visualizar.php?id=$id'> Visualizar </a><br>";
                    echo "<a href='editar.php?id=$id'> Editar </a><br>";
                    echo "<hr>";
                    
               }
            }
            ?>
          <script src="js/custm.js"></script>
    </body>
    </head>
</html>