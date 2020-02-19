<?php
require_once "lib/autoload.php";

$css = array( "style.css");
$opmaakService->BasicHead( $css );
?>
<body>

<div class="jumbotron text-center">
    <h1>Detailpagina Afbeelding</h1>
</div>

<div class="container">
    <div class="row">

        <?php
        $cityLoader = $container->getCityLoader();
        $cities = $cityLoader->Load( $id = $_GET['id'] );

        $template = $opmaakService->LoadTemplate("stad");
        print $opmaakService->ReplaceCities( $cities, $template);
        ?>

    </div>
</div>

</body>
</html>