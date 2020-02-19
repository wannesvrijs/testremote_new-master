<?php
require_once "lib/autoload.php";

$css = array( "style.css" );
$opmaakService->BasicHead( $css );
?>
<body>

<div class="jumbotron text-center">
    <h1>Formulier Stad</h1>
</div>

<div class="container">
    <div class="row">

        <?php

        $cityLoader = $container->getCityLoader();
        $city = $cityLoader->findOneById($id = $_GET['id']);

        $template = $opmaakService->LoadTemplate("stad_form");
        print $opmaakService->ReplaceCities( $city, $template);
        ?>

    </div>
</div>

</body>
</html>