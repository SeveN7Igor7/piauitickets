<?php
// Simula o processo de autenticação e retorno das credenciais do Firebase
$firebaseCredentials = array(
    'apiKey' => "AIzaSyB2JMVHvH8FKs_GEl8JVRoRfPDjY9Ztcf8",
    'authDomain' => "piauiticketsdb.firebaseapp.com",
    'databaseURL' => "https://piauiticketsdb-default-rtdb.firebaseio.com",
    'projectId' => "piauiticketsdb",
    'storageBucket' => "piauiticketsdb.appspot.com",
    'messagingSenderId' => "372256479753",
    'appId' => "1:372256479753:web:8b5890e8c94dc75daaf6d8",
    'measurementId' => "G-FMD1R115PG"
);

// Retorna as credenciais como JSON
header('Content-Type: application/json');
echo json_encode($firebaseCredentials);
?>
