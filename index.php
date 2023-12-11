<?php
     include_once("helpers/url.php");

     session_start();

     $listaTarefas = [];   

     if(!isset($_SESSION['tarefas_pendentes'])) {
          $_SESSION['tarefas_pendentes'] = [];
     }

     if($_SERVER['REQUEST_METHOD'] === 'POST') {
          if(!empty($_POST['tarefa'])) {
               array_push($_SESSION['tarefas_pendentes'], $_POST['tarefa']);
               
          } elseif (isset($_POST['delete'])) {
               $indice = (int)$_POST['delete'];
               unset($_SESSION['tarefas_pendentes'][$indice]);
          }
     }


     $listaTarefas = $_SESSION['tarefas_pendentes'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="<?php echo $BASE_URL ?>/css/styles.css">
     <title>Todo List</title>
</head>
<body>

     <main id="main-container">
          <h1 id="title">TodoList</h1>     
               <form action="index.php" method="POST" id="formulario">
                    <input type="text" name="tarefa" class="texto" placeholder="Digite sua tarefa">
                    <button type="submit" class="enviar">
                         <img src="<?php echo $BASE_URL ?>/images/enviar.png" alt="Enviar">
                    </button>
               </form> 
               <?php foreach($listaTarefas as $indice => $tarefa): ?>   
                    <ul class="exibir">   
                              <li><?php  ?> - <?php echo $tarefa ?>
                                   <form action="index.php" method="POST">
                                        <input type="hidden" name="delete" value=<?php echo $indice ?> >
                                        <button type="submit" class="delete">
                                             <img src="<?php echo $BASE_URL ?>/images/deletar.png" alt="Deletar">
                                        </button>
                                   </form>
                              </li>      
                    </ul>
               <?php endforeach; ?> 
     </main>

</body> 
</html>