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

            $year = $taakLoader->getSetYear();
            $week = $taakLoader->getSetWeek();

            for( $day=1; $day <= 7; $day++ )
            {
                $d = strtotime($year . "W" . $week . $day);
                $sqldate = date("Y-m-d", $d);

                $data = $taakLoader->findTakenByDate($sqldate);

                $taken = array();

                if(isset($data)) foreach( $data as $row )
                {
                    $taken[] = $row->getOmschrijving();
                }

                $takenlijst = "<ul><li>" . implode( "</li><li>" , $taken ) . "</li></ul>";

                echo "<tr>";
                echo "<td>" . date("l", $d). "</td>";
                echo "<td>" . date("d/m/Y", $d). "</td>";
                echo "<td>" . $takenlijst . "</td>";
                echo "</tr>" ;
            }

            echo "</table>";

            $link_vorige = "week.php?week=" . ($week == 1 ? 52 : $week - 1 ) . "&year=" . ($week == 1 ? $year - 1 : $year);
            $link_volgende = "week.php?week=" . ($week == 52 ? 1 : $week + 1 ) . "&year=" . ($week == 52 ? $year + 1 : $year);
            echo "<a href=$link_vorige>Vorige Week</a>&nbsp";
            echo "<a href=$link_volgende>Volgende Week</a>&nbsp";
            ?>

        </div>
    </div>
    </body>
</html>