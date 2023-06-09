<?php

session_start();

if ( empty($_SESSION['tasks'])){
        $_SESSION['tasks'] = array();
}
if ( isset($_GET['task_name'])){
        if ($_GET['task_name'] != ""){
            array_push($_SESSION['tasks'], $_GET['task_name']);
            unset($_GET['task_name']);
             header("Location: http://localhost:8100"); 
            exit;
        }
        else {
            $_SESSION['message'] = "Preencha o campo 'Nome da Tarefa'.";
        }
    }
    

if ( isset($_GET['clear']) ) {
        unset($_SESSION['tasks']);
        unset($_GET['clear']);
}

if ( isset($_GET['key']) ) {
        array_splice($_SESSION['tasks'], $_GET['key'],1);
        unset($_GET['key']);
}



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
        <title>Gerenciador de Tarefa</title>
</head>
<body>
        
        <div class="container">
                <div class="header">
                        <h1>Gerenciador de Tarefa</h1>
                </div>

                <div class="form">
                      <form action="" method="get">
                        <label for="task_name">Tarefa:</label>
                        <input type="text" name="task_name" placeholder="Nome da Tarefa:">
                        <button type="submit">Cadastrar</button>
                      </form>
                      <?php 
                        if ( isset ($_SESSION['message']) ){
                                echo "<p style='color:#fff';>" . $_SESSION['message'] . "</p>";
                                unset($_SESSION['message']); 

                        }
                      ?>
                </div>

                <div class="separator">
                </div>
                
                <div class="list-tasks">
                        <?php
                                if ( isset($_SESSION['tasks']) ){
                                        echo "<ul>";

                                        foreach ( $_SESSION['tasks'] as $key => $task ) { 
                                                echo "<li>
                                                        <span>$task</span>
                                                        <button type='button' class='bt-clear' onclick='deletar$key()'>Remover</button>        
                                                        <script>
                                                                function deletar$key(){
                                                                        if ( confirm('Confirmar remoção?') ){
                                                                                window.location = 'http://localhost:8100/?key=$key';
                                                                        }
                                                                        return false;
                                                                }


                                                        </script>
                                                </li>";

                                        } 

                                        echo "</ul>";
                                }
                        ?>      
                        <form action="" method="get">
                                <input type="hidden" name="clear" value="clear">
                                <button type="submit" class="btn-clear">Limpar Tarefas</button>
                        </form>
                </div>

                <footer>
                        <p  class ="escritas" > Site produzido por <a  href =" https://github.com/LeonardoXavier1 " target =" _blank "> Leonardo Matheus Xavier Vieira </a> 🔥 </p>
                </footer>
                
                
        </div>

</body>
</html>
