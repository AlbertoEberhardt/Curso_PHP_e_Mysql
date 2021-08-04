<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilo.css">
    <title>Listagem de jogos</title>
</head>
<body>
    <?php
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
        $ordem = $_GET["o"] ?? "n";
        $chave = $_GET["c"] ?? "";
    ?>
    <div id="corpo">
        <?php
            include_once "topo.php";
        ?>
        <h1>Escolha seu jogo</h1>
        <form method="GET" action="index.php" id="busca">
            Ordenar: 
            <a href="index.php?o=n&c=<?php echo "$chave" ?>">Nome</a>
             | 
             <a href="index.php?o=p&c=<?php echo "$chave" ?>">Produtora</a>
              | 
              <a href="index.php?o=n1&c=<?php echo "$chave" ?>">Nota Alta</a>
               | 
               <a href="index.php?n2&c=<?php echo "$chave" ?>">Nota baixa</a> |
               <a href="index.php">Mostrar Todos</a> | 
            Buscar: <input type="text" name="c" size="10" maxlength="40">
            <input type="submit" value="Buscar">
        </form>
        <table class="listagem">
            <?php
                $q = "select j.cod, j.nome, g.genero, p.produtoras, j.capa from jogos j join generos g on j.genero = g.cod join produtoras p on j.produtora = p.cod ";
                
                if(!empty($chave)){
                    $q .= "where j.nome like '%$chave%' or p.produtoras like '%$chave%' or g.genero like '%$chave%' ";
                }

                switch ($ordem){
                    case "p":
                        $q .= "ORDER BY p.produtoras";
                    break;
                    case "n1":
                        $q .= "ORDER BY j.nota desc";
                    break;
                    case "n2":
                        $q .= "order by j.nota asc";
                    break;
                    default:
                        $q .= "order by j.nome";
                    break; 
                }
                $busca = $banco -> query($q);
                if(!$busca){
                    echo "<tr><td>Infelizmente a ocorreu um erro na busca</tr></td>";
                }else{
                    if($busca -> num_rows == 0){
                        echo "<tr></td>Nehum registro encontrada</td></tr>";
                    }else{
                        while($reg = $busca -> fetch_object()){
                            $t = thumb($reg -> capa);
                            echo "<tr>
                            <td><img src='$t' class='mini'></td>
                            <td><a href='detalhes.php?cod={$reg -> cod}'>{$reg -> nome}<a/>
                            [{$reg -> genero}] <br>
                            {$reg -> produtoras}
                            </td>";
                            echo "<td>Adm</td>";
                        }
                    }
                }
            ?>
        </table>
    </div>
    <?php include_once "rodape.php";?>
</body>
</html>