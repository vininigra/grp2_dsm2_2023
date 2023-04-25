<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insere Dados</title>
</head>
<body>
    <p>
        Cadastro realizado com sucesso <br> <br>
    </p>
</body>
</html>


<?php
// Backend do cadastro de usuários do HTML
print_r($_POST);

$filename = "Usuarios.txt";

if(!file_exists('Usuarios.txt')){
    $handle=  fopen('Usuarios.txt','w');
 }else{
     $handle = fopen('Usuarios.txt','a');
 }
if(is_string($_POST['name'])&& $_POST['name'] != " "){
    print $_POST['name'];
    print "\n";
    fwrite($handle,$_POST['name']);
    fwrite($handle,",");

    fflush($handle);
}else{
    print "Nao pode ser vazio";
}
if(is_string($_POST['email'])&& $_POST['email'] != " "){
    print $_POST['email'];
    print "\n";
    fwrite($handle,$_POST['email']);
    fwrite($handle,",");
    
    fflush($handle);
}
if(is_string($_POST['dt_nascimento'])&& $_POST['dt_nascimento'] != " "){
    print $_POST['dt_nascimento'];
    print "\n";
    fwrite($handle,$_POST['dt_nascimento']);
    fwrite($handle,",");
    
    fflush($handle);
} 
if(is_string($_POST['senha'])&& $_POST['senha'] != " "){
    print $_POST['senha'];
    print "\n";
    fwrite($handle,$_POST['senha']);
    fwrite($handle,",");
    
    fflush($handle);
}
fwrite($handle,"\n");
fflush($handle);
fclose($handle);





?>
