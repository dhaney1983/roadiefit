<?php
require_once('../../../private/initialize.php');

if (is_post_request()) {
  $metric = [];
  $metric['metric'] = $_POST['metric'];
  $metric['description'] = $_POST['description'];
  $result = insert_metric($metric['metric'], $metric['description']);
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('/staff/metrics/view.php?id=' . $new_id));

} else {

  redirect_to(url_for('/staff/metrics/new.php'));

}

 ?>
