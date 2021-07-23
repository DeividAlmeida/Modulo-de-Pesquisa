<?php 
error_reporting(0);
require_once('functions.php');

//ler dimensões
$dimensoes = json_encode(DBRead('dimensoes','*','ORDER BY dimensao'));

// Ler perguntas
$perguntas = json_encode(DBRead('perguntas','*'));

//Adicionar dimensão
if(isset($_GET['dimensao'])){
    $query = DBCreate('dimensoes', ['dimensao'=>$_POST['dimensao']], true);
    if ($query != 0)  {
        echo $query;
    }else{
        echo 0;
    }
}

//Editar dimensão
if(isset($_GET['dimensaoEdita'])){
    $dm_nome = DBRead('dimensoes','*'," WHERE id = '{$_GET['dimensaoEdita']}'")[0];
    $pergunta = DBRead('perguntas','*',"WHERE dimensao = '{$dm_nome['dimensao']}'");
    $query = DBUpdate('dimensoes', ['dimensao'=>$_POST['dimensao']], "id = '{$_GET['dimensaoEdita']}'");
    
    if(is_array($pergunta)){
        foreach($pergunta as $chave=> $valor){
            DBUpdate('perguntas', ['dimensao'=>$_POST['dimensao']], "id = '{$valor['id']}'");
        }
    }
    if ($query != 0)  {
        echo $query;
    }else{
        echo 0;
    }
}

//Obter dimensão atualizada
if(isset($_GET['dimensaoAtualizada'])){
   echo json_encode(DBRead('dimensoes','*','ORDER BY dimensao'));
}

//Deletar dimensão
if(isset($_GET['Deletardimensao'])){
    $query  = DBDelete('dimensoes',"id = {$_GET['Deletardimensao']}");
    if ($query != 0)  {
        echo $query;
    }else{
        echo 0;
    }
}

//Adicionar pergunta
if(isset($_GET['pergunta'])){
    $query = DBCreate('perguntas', ['dimensao'=>$_POST['dimensao'],'pergunta'=>$_POST['pergunta']], true);
    if ($query != 0)  {
        echo $query;
    }else{
        echo 0;
    }
}

//Editar pergunta
if(isset($_GET['perguntaEdita'])){
    $query = DBUpdate('perguntas', ['dimensao'=>$_POST['dimensao'],'pergunta'=>$_POST['pergunta']], "id = '{$_GET['perguntaEdita']}'");
    if ($query != 0)  {
        echo $query;
    }else{
        echo 0;
    }
}

//Obter pergunta atualizada
if(isset($_GET['perguntaAtualizada'])){
    echo json_encode(DBRead('perguntas','*'));
 }

//Deletar pergunta
if(isset($_GET['Deletarpergunta'])){
    $query  = DBDelete('perguntas',"id = {$_GET['Deletarpergunta']}");
    if ($query != 0)  {
        echo $query;
    }else{
        echo 0;
    }
}

if(isset($_GET['status'])){
    $query = DBUpdate('perguntas', ['status'=>$_POST['status']], "id = '{$_GET['status']}'");
    if ($query != 0)  {
        echo $query;
    }else{
        echo 0;
    }
}