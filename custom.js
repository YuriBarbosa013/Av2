const echo = document.querySelector("echo");

const listarUsuarios = async () =>{
    const dados =await fetch("./visualizar.php");
    const resposta = await dados.text();
    echo.innerHTML = resposta;
    
}

listarUsuarios();