<?php
/* Script modificado basado en BoxBR Apks Rebrand Panels */

// Configuración de la base de datos SQLite
$dbPath = './api/.background.db';

// Crear o conectar a la base de datos
try {
    $db = new SQLite3($dbPath);
    $db->exec("CREATE TABLE IF NOT EXISTS background_image (id INTEGER PRIMARY KEY AUTOINCREMENT, url TEXT)");
} catch (Exception $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

// Función para obtener la URL de la imagen actual
function getCurrentImageUrl($db) {
    $result = $db->query("SELECT url FROM background_image ORDER BY id DESC LIMIT 1");
    if ($result) {
        $row = $result->fetchArray(SQLITE3_ASSOC);
        return $row ? $row['url'] : '';
    }
    return '';
}

$message = '';
$currentImageUrl = getCurrentImageUrl($db);

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_url'])) {
    $newImageUrl = filter_var($_POST['image_url'], FILTER_SANITIZE_URL);
    
    if (filter_var($newImageUrl, FILTER_VALIDATE_URL)) {
        $db->exec("DELETE FROM background_image"); // Eliminar imagen anterior
        $stmt = $db->prepare("INSERT INTO background_image (url) VALUES (:url)");
        $stmt->bindValue(':url', $newImageUrl, SQLITE3_TEXT);
        
        if ($stmt->execute()) {
            $currentImageUrl = $newImageUrl;
            $message = "Imagen de fondo actualizada correctamente.";
        } else {
            $message = "Error al guardar la nueva URL de imagen.";
        }
    } else {
        $message = "URL inválida. Por favor, introduce una URL válida.";
    }
}

// Incluir el header
include 'includes/header.php';

// Modal de confirmación
echo '<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' . "\n";
echo '    <div class="modal-dialog">' . "\n";
echo '        <div class="modal-content">' . "\n";
echo '            <div class="modal-header">' . "\n";
echo '                <h2>Confirmar</h2>' . "\n";
echo '            </div>' . "\n";
echo '            <div class="modal-body">' . "\n";
echo '                ¿Realmente deseas eliminar esta imagen?' . "\n";
echo '            </div>' . "\n";
echo '            <div class="modal-footer">' . "\n";
echo '                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>' . "\n";
echo '                <a class="btn btn-danger btn-ok">Eliminar</a>' . "\n";
echo '            </div>' . "\n";
echo '        </div>' . "\n";
echo '    </div>' . "\n";
echo '</div>' . "\n";

// Contenido principal
echo '<main role="main" class="col-15 pt-4 px-5">';
echo '<div class="row justify-content-center">';
echo '<div class="col-md-8">';
echo '<h1 class="h3 mb-4 text-gray-800">Background</h1>';

// Mostrar mensaje si existe
if ($message) {
    echo '<div class="alert alert-info">' . htmlspecialchars($message) . '</div>';
}

// Formulario para actualizar la imagen de fondo
echo '<form method="post" class="mb-4">';
echo '<div class="input-group">';
echo '<input type="text" name="image_url" class="form-control" placeholder="Introduce la URL de la nueva imagen de fondo" required>';
echo '<div class="input-group-append">';
echo '<button type="submit" class="btn btn-primary">Actualizar Imagen</button>';
echo '</div>';
echo '</div>';
echo '</form>';

// Mostrar imagen actual
if ($currentImageUrl) {
    echo '<h2 class="h4 mb-3">Imagen de Fondo Actual:</h2>';
    echo '<img src="' . htmlspecialchars($currentImageUrl) . '" alt="Imagen de Fondo Actual" class="img-fluid mb-3">';
} else {
    echo '<p>No hay imagen de fondo establecida actualmente.</p>';
}

echo '</div>'; // Cerrar col-md-8
echo '</div>'; // Cerrar row
echo '</main>';

echo '<br><br><br>';

// Incluir el footer
include 'includes/footer.php';

// Incluir script adicional si es necesario
if (file_exists('includes/boxbr.php')) {
    require 'includes/boxbr.php';
}

echo '</body>' . "\n";
?>