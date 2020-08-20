<?php
  if(!isset($page_title)) { $page_title = 'Staff Area';}
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href=<?php echo url_for('/stylesheets/staff.css'); ?> />
    <title>RoadieFit - <?php echo $page_title ?></title>
  </head>
  <body>
    <header>
      <h1>Roadiefit Staff Area</h1>
    </header>

    <navigation>
      <ul>
        <li><a href=<?php echo url_for('/staff/index.php'); ?>>Menu</a></li>
      </ul>
    </navigation>
