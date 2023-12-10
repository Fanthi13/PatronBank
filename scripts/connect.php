<?php

try{
    $conn = new mysqli("localhost", "root", "", "patron_bank");
}catch(mysqli_sql_exception $e){
    echo $e->getMessage();
}