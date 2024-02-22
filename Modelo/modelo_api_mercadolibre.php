<?php

include_once 'conexion.php';
// Verificar si la conexión está establecida
$conn = Conexion::obtenerConexion();

// URL de la API de Mercado Libre
$url = "https://api.mercadolibre.com/sites/MLM/search?q=relojes";

// Obtener datos de la API
$response = file_get_contents($url);

// Decodificar la respuesta JSON
$data = json_decode($response, true);

// Verificar si hay datos
if (!empty($data['results'])) {
  // Recorrer los datos y guardarlos en la base de datos
  foreach ($data['results'] as $item) {
    $titulo = isset($item['title']) ? $item['title'] : '';
    $precio = isset($item['price']) ? $item['price'] : '';
    $stock = isset($item['available_quantity']) ? $item['available_quantity'] : '';
    $categoriaid = isset($item['category_id']) ? $item['category_id'] : '';
    $gategorianame = isset($item['category_name']) ? $item['category_name'] : '';
    $imagen = isset($item['thumbnail']) ? $item['thumbnail'] : '';

    // Insertar datos en la base de datos
    $sql = "INSERT INTO products (title, price, available_quantity, category_id, category_name, image_url) 
    VALUES ('$titulo', '$precio', '$stock', '$categoriaid', '$gategorianame', '$imagen')";

    if ($conn->query($sql) === TRUE) {
      echo "Datos insertados correctamente";
    } else {
      echo "Error al insertar datos: " . $conn->error;
    }
  }
  // Redirigir a la pantalla principal
  header("Location: ../Vista/articulos_relojes.php");
  exit();
} else {
  echo "No se encontraron datos en la API";
}

// Cerrar conexión
$conn->close();

?>
