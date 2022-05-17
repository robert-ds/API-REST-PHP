<?php 

$method = strtoupper($_SERVER['REQUEST_METHOD']);
$token = sha1('SuperSecreto');

if($method === 'POST'){

  if(!array_key_exists('HTTP_X_CLIENT_ID', $_SERVER) || !array_key_exists('HTTP_X_SECRECT',$_SERVER)){
    http_response_code(400);
    die('Faltan parametros');
  }

  $clientId = $_SERVER['HTTP_X_CLIENT_ID'];
  $secrect  = $_SERVER['HTTP_X_SECRECT'];

  if($clientId !== '1' || $secrect !== 'SuperSecreto'){
    http_response_code(403);
    die('No autorizado');
  }

  echo "$token".PHP_EOL;

}elseif($method === 'GET'){

  if(!array_key_exists('HTTP_X_TOKEN', $_SERVER)){
    http_response_code(400);
    die('Faltan parametros');
  }

  if($_SERVER['HTTP_X_TOKEN'] == $token){
    echo 'true';
  }else{
    echo 'false';
  }

}else{
  echo 'false';
}

?>