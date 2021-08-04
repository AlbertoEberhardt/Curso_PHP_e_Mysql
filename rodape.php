<?php
    echo "<footer>
        <p>Acessado  por". $_SERVER['REMOTE_ADDR'] ." em ". date("d/m/y") ."</p>
        <p>Desenvolvido por Estudonauta &copy; 2021</p>
    </footer>";
    $banco -> close();
?>