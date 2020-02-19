<?php
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once "lib/autoload.php";


$cityLoader = $container->getCityLoader();
$cities = $cityLoader->getCities();

$MS->ShowMessages();


$css = array( "style.css");
$opmaakService->BasicHead($css);

?>
<body>

<div class="jumbotron text-center">
    <h1>Leuke plekken in Europa</h1>
    <p>Tips voor citytrips voor vrolijke vakantiegangers!</p>
</div>

<?php $opmaakService->PrintNavBar(); ?>

<div class="container">
    <div class="row">

        <?php

        $template = $opmaakService->LoadTemplate("steden");
        print $opmaakService->ReplaceCities( $cities, $template);
        ?>

    </div>
</div>

</body>
</html>