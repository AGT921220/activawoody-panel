<?php
include "includes/header.php";
?>
<style>
  .custom-button {
    padding: 10px 20px;
  }

  .image-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 20px;
  }

  .image-container {
    flex: 0 0 45%; /* Cada contè´¥iner ocuparè´° aproximadamente 45% da largura, permitindo duas por linha */
    margin: 10px;
    max-width: 100%;
    height: auto;
    position: relative;
  }

  .image-container img {
    display: block;
    width: 100%;
    height: auto;
  }

  .image-container p {
    text-align: center;
    margin: 5px 0;
  }

  .radio-overlay {
    position: absolute;
    top: 5px;
    left: 5px;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 50%;
    padding: 5px;
  }

  .radio-overlay input[type="radio"] {
    display: none;
  }

  .radio-overlay label {
    display: block;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid #007bff;
    cursor: pointer;
  }

  .radio-overlay input[type="radio"]:checked + label {
    background-color: #007bff;
  }

  form {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .submit-button {
    margin-top: 20px;
  }
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Alterar layout</h1>
    <!-- Custom codes -->
    <div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs"></i> Escolha um tema abaixo</h6>
        </div>
        <div class="card-body">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $selectedOption = $_POST['options'];
                echo "You selected: " . $selectedOption;

                // Read existing JSON data from file
                $jsonData = file_get_contents('./a/rtx/Setting.json');
                $data = json_decode($jsonData, true);

                // Update first record in JSON data
                $data[0]["RTXSetting"] = "mLayout";
                $data[0]["PanalData"] = $selectedOption;

                // Encode the updated data back to JSON
                $jsonData = json_encode($data, JSON_PRETTY_PRINT);

                // Write the updated JSON data to file
                file_put_contents('./a/rtx/Setting.json', $jsonData);
            }
            ?>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="image-row">
                    <div class="image-container">
                        <p>Layout padrè´™o</p>
                        <img src="./rtx/layout/d.png" alt="theme_d">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_d" value="541231">
                            <label for="theme_d"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 1</p>
                        <img src="./rtx/layout/1.png" alt="theme_1">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_1" value="364561">
                            <label for="theme_1"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 2</p>
                        <img src="./rtx/layout/2.png" alt="theme_2">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_2" value="54165982">
                            <label for="theme_2"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 3</p>
                        <img src="./rtx/layout/3.png" alt="theme_3">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_3" value="3849312">
                            <label for="theme_3"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 4</p>
                        <img src="./rtx/layout/4.png" alt="theme_4">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_4" value="225254">
                            <label for="theme_4"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 5</p>
                        <img src="./rtx/layout/5.png" alt="theme_5">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_5" value="758755">
                            <label for="theme_5"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 6</p>
                        <img src="./rtx/layout/6.png" alt="theme_6">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_6" value="theme_7">
                            <label for="theme_6"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 7</p>
                        <img src="./rtx/layout/7.png" alt="theme_7">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_7" value="theme_8">
                            <label for="theme_7"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 8</p>
                        <img src="./rtx/layout/8.png" alt="theme_8">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_8" value="theme_10">
                            <label for="theme_8"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 9</p>
                        <img src="./rtx/layout/9.png" alt="theme_9">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_9" value="theme_11">
                            <label for="theme_9"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 10</p>
                        <img src="./rtx/layout/10.png" alt="theme_10">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_10" value="theme_12">
                            <label for="theme_10"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 11</p>
                        <img src="./rtx/layout/11.png" alt="theme_11">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_11" value="theme_14">
                            <label for="theme_11"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 12</p>
                        <img src="./rtx/layout/12.png" alt="theme_12">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_12" value="theme_15">
                            <label for="theme_12"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 13</p>
                        <img src="./rtx/layout/13.png" alt="theme_13">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_13" value="theme_16">
                            <label for="theme_13"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 14</p>
                        <img src="./rtx/layout/14.png" alt="theme_14">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_14" value="theme_17">
                            <label for="theme_14"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 15</p>
                        <img src="./rtx/layout/15.png" alt="theme_15">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_15" value="theme_18">
                            <label for="theme_15"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 16</p>
                        <img src="./rtx/layout/16.png" alt="theme_16">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_16" value="theme_19">
                            <label for="theme_16"></label>
                        </div>
                    </div>
                    <div class="image-container">
                        <p>Layout 17</p>
                        <img src="./rtx/layout/17.png" alt="theme_17">
                        <div class="radio-overlay">
                            <input type="radio" name="options" id="theme_17" value="theme_20">
                            <label for="theme_17"></label>
                        </div>
                    </div>
                </div>
                <div class="submit-button">
                    <input type="submit" class="horizontal-space btn btn-success btn-icon-split" value="Salvar">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include "includes/footer.php";
?>
</body>
</html>
