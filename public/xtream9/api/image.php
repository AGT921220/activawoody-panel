<?php
// Configuración de la base de datos SQLite
$dbPath = './.background.db';

// Función para obtener la URL de la imagen actual
function getCurrentImageUrl($db) {
    $result = $db->query("SELECT url FROM background_image ORDER BY id DESC LIMIT 1");
    if ($result) {
        $row = $result->fetchArray(SQLITE3_ASSOC);
        return $row ? $row['url'] : '';
    }
    return '';
}

// Función para leer la configuración de la marquesina
function readMarquesinaConfig() {
    $configFile = 'config.txt';
    if (file_exists($configFile)) {
        $configContent = file_get_contents($configFile);
        list($marquesinaStatus, $marquesinaTexto) = explode("\n", $configContent);
        return [
            'status' => trim($marquesinaStatus),
            'texto' => trim($marquesinaTexto)
        ];
    }
    return [
        'status' => 'activo',
        'texto' => 'Este es el texto en movimiento dentro de la marquesina.'
    ];
}

// Conectar a la base de datos y obtener configuración
try {
    $db = new SQLite3($dbPath);
    $currentImageUrl = getCurrentImageUrl($db);
    $marquesinaConfig = readMarquesinaConfig();
} catch (Exception $e) {
    $currentImageUrl = '';
    $marquesinaConfig = readMarquesinaConfig();
    $errorMessage = "Error al conectar con la base de datos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen de Fondo con Marquesina</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        #background-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: fixed;
            top: 0;
            left: 0;
        }
        .error-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            max-width: 80%;
        }
        .marquesina-container {
            width: 80%;
            max-width: 400px;
            height: 40px;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            white-space: nowrap;
            position: fixed;
            top: 100px;
            right: 51px;
            z-index: 2;
            display: <?php echo $marquesinaConfig['status'] === 'activo' ? 'block' : 'none'; ?>;
        }
        .marquesina-texto {
            display: inline-block;
            padding-left: 100%;
            white-space: nowrap;
            color: white;
            font-size: 1.5em;
            animation: mover 20s linear infinite;
        }
        @keyframes mover {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-100%, 0); }
        }
    </style>
</head>
<body>
    <?php if ($currentImageUrl): ?>
        <img id="background-image" src="<?php echo htmlspecialchars($currentImageUrl); ?>" alt="Imagen de Fondo">
        <div class="marquesina-container">
            <div class="marquesina-texto">
                <?php echo htmlspecialchars($marquesinaConfig['texto'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>
    <?php elseif (isset($errorMessage)): ?>
        <div class="error-message">
            <p><?php echo htmlspecialchars($errorMessage); ?></p>
        </div>
    <?php else: ?>
        <div class="error-message">
            <p>No se ha establecido ninguna imagen de fondo.</p>
        </div>
    <?php endif; ?>
</body>
</html>