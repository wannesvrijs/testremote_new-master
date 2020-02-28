<?php
require_once "lib/autoload.php";

$css = array( "style.css");
$opmaakService->BasicHead($css);
$MS->ShowMessages();
$taakLoader = $container->getTaakLoader();

$MS->ShowMessages();

?>
    <body>

    <div class="jumbotron text-center">
        <h1>Weekoverzicht</h1>
    </div>
    <?php $opmaakService->PrintNavBar(); ?>

    <div class="container">
        <div class="row">

    <table class="table">
        <tr>
            <th>Weekdag</th>
            <th>Datum</th>
            <th>Taken</th>
        </tr>
            <?php


            for( $day=1; $day <= 7; $day++ )
            {
                $tablerow = $taakLoader->getTableRow($day);
                echo $tablerow;
            }

            echo "</table>";

            $week = $taakLoader->getSetWeek();
            $year = $taakLoader->getSetYear();

            $link_vorige = "week.php?week=" . ($week == 1 ? 52 : $week - 1 ) . "&year=" . ($week == 1 ? $year - 1 : $year);
            $link_volgende = "week.php?week=" . ($week == 52 ? 1 : $week + 1 ) . "&year=" . ($week == 52 ? $year + 1 : $year);
            echo "<a href=$link_vorige>Vorige Week</a>&nbsp";
            echo "<a href=$link_volgende>Volgende Week</a>&nbsp";
            ?>

        </div>
    </div>
    </body>
</html>