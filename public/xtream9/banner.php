<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = '<div class="alert alert-primary" id="flash-msg"><h4><i class="icon fa fa-check"></i>Marquee Updated!</h4></div>';

// Marquee control
$configFile = './api/config.txt';

// Read marquee status and text from config.txt
if (file_exists($configFile)) {
    $configContent = file_get_contents($configFile);
    if ($configContent === false) {
        die("Failed to read config file");
    }
    list($marquesinaStatus, $marquesinaTexto) = explode("\n", $configContent);
    $marquesinaStatus = trim($marquesinaStatus);
    $marquesinaTexto = trim($marquesinaTexto);
} else {
    $marquesinaStatus = 'activo';
    $marquesinaTexto = 'Este es el texto en movimiento dentro de la marquesina.';
}

if (isset($_POST['submit'])) {
    $newStatus = $_POST['status'] === 'activo' ? 'activo' : 'inactivo';
    $newText = $_POST['texto'];
    
    if (file_put_contents($configFile, $newStatus . "\n" . $newText) === false) {
        die("Failed to write to config file");
    }
    
    $marquesinaStatus = $newStatus;
    $marquesinaTexto = $newText;

    header('Location: banner.php?message=' . urlencode($message));
    exit;
}

include 'includes/header.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php
    if (isset($_GET['message'])) {
        echo $_GET['message'];
    }
    ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Marquee Control</h1>

    <!-- Content Row -->
    <div class="row">
        <!-- First Column -->
        <div class="col-lg-12">
            <!-- Custom codes -->
            <div class="card border-left-primary shadow h-100 card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cog"></i> Marquee Settings</h6>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label class="control-label requiredField" for="status">
                                <strong>Marquee Status:</strong>
                            </label>
                            <select class="select form-control text-primary" id="status" name="status">
                                <option value="activo"<?php echo $marquesinaStatus === 'activo' ? ' selected' : ''; ?>>Active</option>
                                <option value="inactivo"<?php echo $marquesinaStatus === 'inactivo' ? ' selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label requiredField" for="texto">
                                <strong>Marquee Text:</strong>
                            </label>
                            <input class="form-control" id="texto" name="texto" value="<?php echo htmlspecialchars($marquesinaTexto, ENT_QUOTES, 'UTF-8'); ?>" type="text" />
                        </div>
                        <button class="btn btn-success btn-icon-split" name="submit" type="submit">
                            <span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Update Marquee</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br>

<?php
include 'includes/footer.php';
?>

</body>
</html>