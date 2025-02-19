<?php
include('includes/header.php');

$backgrounds_dir = 'backgrounds/'; // Directory to store uploaded backgrounds
$logos_dir = 'logos/'; // Directory to store uploaded logos

// Ensure directories exist
if (!file_exists($backgrounds_dir)) {
    mkdir($backgrounds_dir, 0777, true);
}

if (!file_exists($logos_dir)) {
    mkdir($logos_dir, 0777, true);
}

// File paths initialized without extensions
$background_file = $backgrounds_dir . 'background_image';
$logo_file = $logos_dir . 'logo_image';

$success_message = '';
$error_message = '';

// Allowed file extensions
$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

function showModal($id) {
    echo "<script>$(document).ready(function() { $('#$id').modal('show'); });</script>";
}

// Function to get file extension
function getFileExtension($filename) {
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

// Handle background and logo uploads
if (isset($_POST['upload'])) {
    $upload_success = false;

    // Upload background
    if (isset($_FILES['background']) && $_FILES['background']['error'] === UPLOAD_ERR_OK) {
        $background_ext = getFileExtension($_FILES['background']['name']);
        if (in_array($background_ext, $allowed_extensions)) {
            $temp_name = $_FILES['background']['tmp_name'];
            $background_file_with_ext = $background_file . '.' . $background_ext;
            if (move_uploaded_file($temp_name, $background_file_with_ext)) {
                $upload_success = true;
                $success_message .= 'Background uploaded successfully. ';
            } else {
                $error_message .= 'Failed to move the uploaded background. ';
            }
        } else {
            $error_message .= 'Invalid background file type. ';
        }
    }

    // Upload logo
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $logo_ext = getFileExtension($_FILES['logo']['name']);
        if (in_array($logo_ext, $allowed_extensions)) {
            $temp_name = $_FILES['logo']['tmp_name'];
            $logo_file_with_ext = $logo_file . '.' . $logo_ext;
            if (move_uploaded_file($temp_name, $logo_file_with_ext)) {
                $upload_success = true;
                $success_message .= 'Logo uploaded successfully.';
            } else {
                $error_message .= 'Failed to move the uploaded logo. ';
            }
        } else {
            $error_message .= 'Invalid logo file type. ';
        }
    }

    // Show appropriate modal
    if ($upload_success) {
        showModal('successModal');
    } else {
        showModal('errorModal');
    }
}

// Handle background deletion
if (isset($_POST['delete_background'])) {
    foreach ($allowed_extensions as $ext) {
        $file_to_delete = $background_file . '.' . $ext;
        if (file_exists($file_to_delete)) {
            if (unlink($file_to_delete)) {
                $success_message = 'Background deleted successfully.';
                showModal('successModal');
                break;
            } else {
                $error_message = 'Failed to delete the background.';
                showModal('errorModal');
            }
        }
    }
}

// Handle logo deletion
if (isset($_POST['delete_logo'])) {
    foreach ($allowed_extensions as $ext) {
        $file_to_delete = $logo_file . '.' . $ext;
        if (file_exists($file_to_delete)) {
            if (unlink($file_to_delete)) {
                $success_message = 'Logo deleted successfully.';
                showModal('successModal');
                break;
            } else {
                $error_message = 'Failed to delete the logo.';
                showModal('errorModal');
            }
        }
    }
}

?>

<div class="col-md-6 mx-auto">
    <div class="card-body">
        <div class="card bg-primary text-white">
            <div class="card-header card-header-warning">
                <center>
                    <h2><i class="icon icon-image"></i> Upload Background & Logo</h2>
                </center>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <h3>Upload a Background and Logo</h3>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="form-label" for="background">Select Background</label>
                        <input class="form-control" name="background" type="file" accept="image/*" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="logo">Select Logo</label>
                        <input class="form-control" name="logo" type="file" accept="image/*" />
                    </div>
                    <div class="form-group">
                        <center>
                            <button class="btn btn-info" name="upload" type="submit">
                                <i class="icon icon-upload"></i> Upload
                            </button>
                        </center>
                    </div>
                </form>

                <!-- Display uploaded background if exists -->
                <?php foreach ($allowed_extensions as $ext): ?>
                    <?php $background_file_with_ext = $background_file . '.' . $ext; ?>
                    <?php if (file_exists($background_file_with_ext)): ?>
                        <div class="form-group">
                            <h4>Background Preview</h4>
                            <img src="<?=$background_file_with_ext . '?v=' . filemtime($background_file_with_ext) ?>" alt="Uploaded Background" class="img-fluid" />
                            <form method="post" id="deleteBackgroundForm">
                                <div class="form-group">
                                    <center>
                                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDeleteBackgroundModal">
                                            <i class="icon icon-trash"></i> Delete Background
                                        </button>
                                    </center>
                                </div>
                                <!-- Hidden field to trigger background deletion -->
                                <input type="hidden" name="delete_background" value="1">
                            </form>
                        </div>
                        <?php break; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <!-- Display uploaded logo if exists -->
                <?php foreach ($allowed_extensions as $ext): ?>
                    <?php $logo_file_with_ext = $logo_file . '.' . $ext; ?>
                    <?php if (file_exists($logo_file_with_ext)): ?>
                        <div class="form-group">
                            <h4>Logo Preview</h4>
                            <img src="<?=$logo_file_with_ext . '?v=' . filemtime($logo_file_with_ext) ?>" alt="Uploaded Logo" class="img-fluid" />
                            <form method="post" id="deleteLogoForm">
                                <div class="form-group">
                                    <center>
                                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDeleteLogoModal">
                                            <i class="icon icon-trash"></i> Delete Logo
                                        </button>
                                    </center>
                                </div>
                                <!-- Hidden field to trigger logo deletion -->
                                <input type="hidden" name="delete_logo" value="1">
                            </form>
                        </div>
                        <?php break; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= htmlspecialchars($success_message) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= htmlspecialchars($error_message) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Delete Background Modal -->
<div class="modal fade" id="confirmDeleteBackgroundModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteBackgroundModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteBackgroundModalLabel">Confirm Delete Background</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the background?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="$('#deleteBackgroundForm').submit();">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Delete Logo Modal -->
<div class="modal fade" id="confirmDeleteLogoModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLogoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLogoModalLabel">Confirm Delete Logo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the logo?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="$('#deleteLogoForm').submit();">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</body>
</html>
