<?php
    include("../services/sistema.php");
    
    $manager_db = new App();
    
    $storage = $manager_db->space_storage();
    $storage_user = $manager_db->space_storage();
    // echo "<br><p>aa</p>";
    // echo 312*$manager_db->tx_mb;
    $percent_usage = (int) ($storage_user["used"]/$manager_db->space_total_storage)*100;
    if($percent_usage>100){
        $percent_usage = 100;
    }else{
        $percent_usage = $percent_usage;
    }
    // echo (int) ($storage_user["used"]/$manager_db->space_total_storage)*100;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/utils/css/flexbox.min.css">
    <link rel="stylesheet" href="src/components/main.css">
    <link rel="stylesheet" href="src/utils/fontawesome-free-5.15.4-web/css/all.min.css">
</head>
<body>
    <main>
        <header class="display-row align-center justify-space-around">
            <p class="logo-header display-row align-center justify-space-between"> <span data-span-left><</span> Caf-drive <span data-span-right>/></span> </p>
            <nav class="display-row align-center justify-space-between">
                <a href="logout.php">Logout <i class="fas fa-door-open"></i></a>
                <a href=""> Home <i class="fas fa-home"></i></a>
                <a href="">Account <i class="fas fa-user"></i></a>
            </nav>
            <button>Settings <i class="fas fa-searchengin"></i></button>
        </header>

        <div class="storage-user-info display-column align-flex-start justify-space-evenly">
            <p>Storage user</p>
            <div class="progress-bar">
                <?php
                    if(0<=$percent_usage && $percent_usage<50){
                        $color_progress = "#5fbfece1";
                    }else if(51<=$percent_usage && $percent_usage<70){
                        $color_progress = "orange";
                    }else{
                        $color_progress = "#ec1717";
                    }
                    echo "<div style='width: $percent_usage%;height: 100%;background: $color_progress;' class='progress-bar-content'></div>";
                ?>
            </div>
            <div class="info-storage display-row align-center justify-space-around">
                <p class="total-storage display-column align-flex-start justify-center">
                    <?php
                        echo "<span>{$manager_db->space_total_storage}MB</span>";
                    ?>
                    <span>total space</span>
                </p>
                <div class="content display-column align-flex-start justify-center">
                    <!-- <p>used 80MB</p>
                    <p>free 20MB</p>
                    <p>total files 23</p> -->
                    <?php
                        $_used_formated = (int) $storage_user['used'];
                        $_free_formated = (int) $storage_user['free'];
                        $_files_c = $manager_db->count_files();

                        echo "<p>used {$_used_formated}MB</p>";
                        echo "<p>free {$_free_formated}MB</p>";
                        echo "<p>total files $_files_c</p>";
                        echo "<div class='color-storage' style='background: $color_progress;'></div>";
                        echo "<div class='color-storage'></div>";
                    ?>
                </div>
            </div>
        </div>
        
        <div class="files-user display-column align-center">
            <div class="header display-row align-center justify-space-between">
                <div class="hero-header display-row align-center justify-space-between">
                    <i class="fas fa-file-image"></i>
                    <p class="display-column justify-center ">
                        <?php
                            echo "<span>$_files_c files</span>";
                        ?>
                        <span>your files</span>
                    </p>                
                </div>
                <button id="button-add">new file <i class="fas fa-plus"></i></button>
            </div>
            <div class="show-files display-column">
                <?php
                    $files_user = $manager_db->ver_arquivos();
                    foreach ($files_user as $key => $value) {
                        $content = $value['nome_ficheiro'];
                        $id = $value['id'];
                        $tamanho = $value['tamanho'];

                        echo "<div class='display-row align-center justify-space-around'>
                            <button>$content</button>
                            <a href='../../index.php?delete=true&id=$id&tamanho=$tamanho'>Delete</a>
                            <button>share</button>
                        </div>";
                    }
                    // echo "<p>0 files</p>";
                ?>
            </div>
        </div>

        <div id="add-file-page" class="display-row align-center justify-center">
            <form action="../../index.php?storage=true" enctype="multipart/form-data" method="post" target="blank" id="request-file" class="display-row align-center justify-flex-start">
                <p>you only add images</p>
                <p>Choice the file and add</p>
                <label for="choice-file" class="btnSelect">
                    Select file
                    <input type="file" name="fih" id="choice-file">
                </label>
                <label for="filename">
                    <!-- <span>name file</span> -->
                    <input type="text" name="filename" id="filename" placeholder="file name">
                </label>
                <input type="submit" value="add file" class="btnAdd">
            </form>
        </div>
    </main>

    <script>
        const pageFile = document.getElementById("add-file-page")
        const formScreen = document.getElementById("request-file")
        const label = document.querySelectorAll("label")
        var isShowed = false

        pageFile.style = `
                    width: 100%;
                    height: 20vh;
                    background: rgba(42,41,41,0);
                    position: absolute;
                    bottom: 0;
                    // display: none;
                    overflow: hidden;
        `
        formScreen.style = `
                    transform: translateY(100%);
                    width: 100%;
                    height: 100%;
                    gap: 30px;
                    padding: 30px 100px;
                    background: white;
                    transition: all .5s;
        `
        document.getElementById("button-add").addEventListener("click", () => {
            formScreen.style.transition = "transition: all .5s;"
            if(isShowed){
                displayElement = "none"
                transformElement = "100"
            }else{
                transformElement = "0"
                displayElement = "block"
            }
            isShowed = !isShowed
            pageFile.style.display = displayElement
            formScreen.style.transform = `translateY(${transformElement}%)`
        })
        label.forEach((element) => element.classList.add("display-column"))
    </script>
</body>
</html>

<?php
    require("session.php");
?> 