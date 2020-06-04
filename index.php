<?php
  require_once ("vendor/autoload.php");
  require_once ("includes/functions.php");

  $listing = DB::query('SELECT P.category, COUNT(P.category) as "SUM", C.name, C.id, C.slug as "slug" FROM product as P RIGHT OUTER JOIN `category` as C ON P.category=C.id GROUP BY P.category, "SUM", C.name, C.id, C.slug ORDER BY `SUM` DESC LIMIT 0, 8');

  echo $twig->render("index.html", array("listing" => $listing));

?>
