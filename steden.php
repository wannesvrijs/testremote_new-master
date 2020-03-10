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

    <button id="toonDetails">Toon Details</button>
    <div class="row">

        <?php
        $template = $opmaakService->LoadTemplate("steden");
        print $opmaakService->ReplaceCities( $cities, $template);
        ?>

        <div class="detailButtons">
            <p class="detail">
                <?php
                $detail = $container->getDetailBigBen();
                print 'Hoogte: '.$detail->getHoogte().'<br>';
                print 'Bouwjaar: '.$detail->getBouwjaar().'<br>';
                print 'Inkomprijs: '.$detail->getInkom().'<br>';
                print '<a href="'.$detail->getWikiLink().'" target="_blank">Wiki</a>'
                ?>
            </p>
            <p class="detail">
                <?php
                $detail = $container->getDetailEiffeltoren();
                print 'Hoogte: '.$detail->getHoogte().'<br>';
                print 'Bouwjaar: '.$detail->getBouwjaar().'<br>';
                print 'Ontwerper: '.$detail->getDesigner().'<br>';
                print '<a href="'.$detail->getWikiLink().'" target="_blank">Wiki</a>'
                ?>
            </p>
            <p class="detail">
                <?php
                $detail = $container->getDetailTvToren();
                print 'Hoogte: '.$detail->getHoogte().'<br>';
                print 'Bouwjaar: '.$detail->getBouwjaar().'<br>';
                print 'Bezoekers/jaar: '.$detail->getVisitors().'<br>';
                print '<a href="'.$detail->getWikiLink().'" target="_blank">Wiki</a>'
                ?>
            </p>
        </div>

    </div>
</div>

</body>
</html>