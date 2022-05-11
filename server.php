<?php
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
// Generamos la respuesta asumiendo que el pedido es correcto
switch(strtoupper($_SERVER['REQUEST_METHOD'])){
  case 'GET':
    echo json_encode($books);
    break;

  case 'POST':
    break;

  case 'PUT':
    break;

  case 'DELETE':
    break;
}

?>