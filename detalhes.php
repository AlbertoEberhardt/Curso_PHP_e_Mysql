<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilo.css">
    <title>Titulo da pagina</title>
</head>
<body>
    <?php
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
    ?>
    <div id="corpo">
        <?php
            include_once "topo.php";
            $c = $_GET['cod'] ?? 0;
            if($c == 0){
                echo "Está página não existe";
            }else{
                $busca = $banco -> query("select * from jogos where cod = $c");
                if(!$busca){
                    echo "Erro {$banco -> error}";
                }else{
                    $reg = $busca -> fetch_object();
                }
            }
        ?>
        <h1>Detalhes do jogo</h1>
        <table class="detalhes">
            <?php
                $t = thumb($reg -> capa);
                echo "<tr>
                        <td rowspan='3'><img src ='$t' class='full'></td>
                        <td><h2>{$reg -> nome}</h2>
                        Nota: ". number_format($reg -> nota, 1, ".", ",") ." / 10</td>
                    </tr>
                    <tr>
                        <td>{$reg -> descricao}</td>
                    </tr>
                    <tr>
                        <td>Admin</td>
                    </tr>"
            ?>
        </table>
        <a href="index.php"><img src="icones/icoback.png"></a>
    </div>
    <?php include_once "rodape.php";?>
</body>
</html>