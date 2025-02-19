<?php 
include ('includes/header.php');

// Configuración de la base de datos SQLite
$db_path = 'api/ads.db';

// Definición de funciones auxiliares
function sanitizeString($str) {
    return htmlspecialchars(strip_tags($str), ENT_QUOTES, 'UTF-8');
}

function sanitizeAndValidateUrl($url) {
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        return false;
    }
    return $url;
}

function isImage($url) {
    $ext = strtolower(pathinfo($url, PATHINFO_EXTENSION));
    return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
}

// Inicializar variables
$res = false;
$error = null;
$success = null;
$editingAd = null;

try {
    // Crear o conectar a la base de datos SQLite
    $db = new SQLite3($db_path);

    // Verificar si la tabla existe y tiene la estructura correcta
    $tableCheck = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='ads'");
    if (!$tableCheck->fetchArray()) {
        // La tabla no existe, la creamos
        $db->exec('CREATE TABLE ads (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT,
            url TEXT,
            created_on TEXT
        )');
    }

    // Manejar la eliminación de anuncios
    if (isset($_GET['delete'])) {
        $id = filter_var($_GET['delete'], FILTER_SANITIZE_NUMBER_INT);
        $stmt = $db->prepare('DELETE FROM ads WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        if ($stmt->execute()) {
            $success = "Anuncio eliminado correctamente.";
        } else {
            $error = "Error al eliminar el anuncio.";
        }
    }

    // Manejar la edición de anuncios
    if (isset($_GET['edit'])) {
        $id = filter_var($_GET['edit'], FILTER_SANITIZE_NUMBER_INT);
        $stmt = $db->prepare('SELECT * FROM ads WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        $editingAd = $result->fetchArray(SQLITE3_ASSOC);
    }

    // Manejar el envío del formulario (crear nuevo o actualizar existente)
    if(isset($_POST['submit'])){
        $title = sanitizeString($_POST['title']);
        $url = sanitizeAndValidateUrl($_POST['url']);
        $created_on = date('Y-m-d H:i:s');
        
        if ($url === false) {
            $error = "URL inválida. Por favor, introduce una URL válida.";
        } else {
            if (isset($_POST['id'])) {
                // Actualizar anuncio existente
                $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                $stmt = $db->prepare('UPDATE ads SET title = :title, url = :url WHERE id = :id');
                $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
            } else {
                // Insertar nuevo anuncio
                $stmt = $db->prepare('INSERT INTO ads (title, url, created_on) VALUES (:title, :url, :created_on)');
                $stmt->bindValue(':created_on', $created_on, SQLITE3_TEXT);
            }
            
            $stmt->bindValue(':title', $title, SQLITE3_TEXT);
            $stmt->bindValue(':url', $url, SQLITE3_TEXT);
            
            if ($stmt->execute()) {
                $success = isset($_POST['id']) ? "Anuncio actualizado correctamente." : "Anuncio guardado correctamente.";
                $editingAd = null; // Limpiar el anuncio en edición después de actualizar
            } else {
                $error = "Error al " . (isset($_POST['id']) ? "actualizar" : "guardar") . " el anuncio: " . $db->lastErrorMsg();
            }
        }
    }

    // Obtener todos los anuncios
    $res = $db->query('SELECT * FROM ads ORDER BY created_on DESC');
    if ($res === false) {
        throw new Exception($db->lastErrorMsg());
    }

} catch (Exception $e) {
    $error = "Error de base de datos: " . $e->getMessage();
    $res = false;
}
?>

<div class="col-md-8 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-bullhorn"></i> <?php echo $editingAd ? 'Editar Anuncio' : 'Añadir Nuevo Anuncio'; ?></h2>
                </center>
            </div>
            
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

                <form method="post">
                    <?php if ($editingAd): ?>
                        <input type="hidden" name="id" value="<?php echo $editingAd['id']; ?>">
                    <?php endif; ?>
                    <div class="form-group ctinput">
                        <label class="form-label">Título del Anuncio</label>
                        <input class="form-control" name="title" type="text" required value="<?php echo $editingAd ? htmlspecialchars($editingAd['title']) : ''; ?>"/>
                    </div>
                    <div class="form-group ctinput">
                        <label class="form-label">URL del Anuncio</label>
                        <input class="form-control" name="url" type="url" required value="<?php echo $editingAd ? htmlspecialchars($editingAd['url']) : ''; ?>"/>
                    </div>
                    <div class="form-group ctinput">
                        <center>
                            <button class="btn btn-info" name="submit" type="submit">
                                <i class="icon icon-check"></i> <?php echo $editingAd ? 'Actualizar Anuncio' : 'Añadir Anuncio'; ?>
                            </button>
                            <?php if ($editingAd): ?>
                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">Cancelar Edición</a>
                            <?php endif; ?>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-md-8 mx-auto ctmain-table">
    <div class="card-body">
        <div class="card ctcard">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-list"></i> Anuncios Actuales</h2>
                </center>
            </div>
            
            <div class="card-body">
                <?php if ($res && $res->fetchArray(SQLITE3_ASSOC)): ?>
                    <?php $res->reset(); ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Anuncio</th>
                                <th>Fecha de Creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($ad = $res->fetchArray(SQLITE3_ASSOC)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($ad['title']); ?></td>
                                    <td>
                                        <?php if (isImage($ad['url'])): ?>
                                            <img src="<?php echo htmlspecialchars($ad['url']); ?>" alt="<?php echo htmlspecialchars($ad['title']); ?>" style="max-width: 200px; max-height: 200px;">
                                        <?php else: ?>
                                            <a href="<?php echo htmlspecialchars($ad['url']); ?>" target="_blank">Ver anuncio</a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($ad['created_on']); ?></td>
                                    <td>
                                        <a href="?edit=<?php echo $ad['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                                        <a href="?delete=<?php echo $ad['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este anuncio?');">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No hay anuncios para mostrar.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include ('includes/footer.php'); ?>