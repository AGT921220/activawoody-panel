<?php
include ('includes/header.php');
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
$folderPath = dirname($_SERVER['PHP_SELF']);
$currentDomain = $protocol . $_SERVER['HTTP_HOST'] . $folderPath.'/api/';


// Check if a form was submitted
function encr($data) {
        $key = 'zsdfkghgujkfdsjgklsdfbjghsdfkjgb';
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, '0123456789abcdef');
        $encrypted_hex = bin2hex($encrypted);
        return $encrypted_hex;
}

$encryptedapi = base64_encode($currentDomain);
    
?>

    	<div class="col-md-6 mx-auto">
			<div class="card-body">
				<div class="card bg-primary text-white">
					<div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-user"></i> Encrypted API Link</h2>
                        </center>
                    </div>
					<div class="alert alert-info alert-dismissible" role="alert">
						<center>
							<h4 style="color:black!important">Use the Encrypted link below as the API link of the apk file</h4>
						</center>
					</div>

					<div class="card-body">
				
				
				        
				        <div class="form-group">
								<div class="form-group form-float form-group-lg">
                                    <div class="form-line">
                                        <label class="form-label">API</label>
										<input type="text" class="form-control" name="password" value="<?php echo $encryptedapi; ?>">
									</div>
								</div>
							</div>

                        <center>
                            <button type="button" id="copyButton" class="btn btn-info">
                                <i class="icon icon-check"></i>Copy API
                            </button>
                        </center>
				
					</div>
				</div>
			</div>
		</div>


<?php include ('includes/footer.php'); ?>

<script>
    document.getElementById("copyButton").addEventListener("click", function() {
        var apiInput = document.getElementsByName("password")[0];
        apiInput.select();
        document.execCommand("copy");
        alert("API link copied to clipboard!");
    });
</script>

</body>
</html>