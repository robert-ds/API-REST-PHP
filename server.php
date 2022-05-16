<?php

$user = array_key_exists('PHP_AUTH_USER',$_SERVER) ? $_SERVER['PHP_AUTH_USER']: '';
$pwd = array_key_exists('PHP_AUTH_PW',$_SERVER) ? $_SERVER['PHP_AUTH_PW']: '';

if($user !== 'robert' || $pwd !== '1234'){
  die;
}

// Definimos los recursos disponibles
$allowedResourceTypes = [
  'books',
  'authors',
  'genres',
];

// Validamos que el recurso este disponible
$resourceType = $_GET['resource_type'];

if(!in_array($resourceType, $allowedResourceTypes)){
  die;
}

// Defino los Recursos, Simulando una base de datos
$books = [

  1 => [
    'titulo' => 'El Coronel no tiene quién le escriba',
    'id_autor' => 2,
    'id_genero' => 2,
  ],
  2 => [
    'titulo' => 'Viaje al centro de la tierra',
    'id_autor' => 4,
    'id_genero' => 5,
  ],
  3 => [
    'titulo' => '1000 y una noches',
    'id_autor' => 0,
    'id_genero' => 1,
  ],
  4 => [
    'titulo' => 'Historia de la Criptografía',
    'id_autor' => 5,
    'id_genero' => 3,
  ]

];

header('Content-Type: application/json');

// Levantamos el id del recurso buscado
$resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '' ;

// Generamos la respuesta asumiendo que el pedido es correcto
switch(strtoupper($_SERVER['REQUEST_METHOD'])){

  case 'GET':
    if(empty($resourceId)){
      echo json_encode($books);
    }else{
      if(array_key_exists($resourceId,$books)){
        echo json_encode($books[$resourceId]);
      }
    }
    
    break;

  case 'POST':
      // Resivimos el contenido del usuario en formato json
      $json = file_get_contents('php://input');
      
      // Lo almacenamos en un array. como ejemplo. Lo ideal seria una DB.
      $books[] = json_decode($json, true);

      // Obtenemos el id del nuevo libo indresado
      // echo array_keys($books)[count($books) -1];

      // Emitimos hacia la salida la ultima clave del arreglo de libros
      echo json_encode($books);
    break;

  case 'PUT':
    // Validamos que el recurso buscado exista
    if( !empty($resourceId) && array_key_exists($resourceId,$books)){
      $json = file_get_contents('php://input');

      // comprobamos el libro por id para luego reemplazar
      $books[$resourceId] = json_decode($json, true);

      // Retornamos la coleccion modificada en formato json
      echo json_encode($books);
    }
    break;

  case 'DELETE':
    // Validamos que el recurso exista
    if( !empty($resourceId) && array_key_exists($resourceId,$books)){
      // Eliminamos el recurso
      unset($books[$resourceId]);
    }

    // Retornamos la coleccion modificada en formato json, para comprobar que se ha eliminado un recurso
    echo json_encode($books);

    break;

}

?>