<?php
require_once "lib/autoload.php";

$css = array( "style.css");
$opmaakService->BasicHead( $css );

?>
<body>

<div class="jumbotron text-center">
    <h1>Formulier File Upload</h1>
</div>

<?php $opmaakService->PrintNavBar(); ?>

<div class="container">
    <div class="row">

        <?php
        print $opmaakService->LoadTemplate("form_file_upload");
        $images = glob( "img/*.{jpg,png,gif}", GLOB_BRACE );
        foreach( $images as $img )
        {
            print "<div class='div_thumb'>";
            print "<img class='thumbnail' src='$img'><br>";
            print "<span class='img_name'>$img</span>";
            print "</div>";
        }
        ?>

    </div>
</div>

</body>
</html>