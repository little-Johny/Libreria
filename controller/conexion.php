<?php
$user='root';
$password='';
$db_name='libreria';

try{
    $database = new PDO('mysql:host=localhost;dbname='.$db_name,$user,$password);
}catch(Exception $error){
    echo 'No se puede conectar con la base de datos '.$db_name.$error->getMessage();;
}