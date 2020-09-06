<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/metrics/index.php'));
}

$id = $_GET['id'];

$metric = find_metric_by_id($id);

if(is_post_request()){
  $result = delete_metric($id);
  redirect_to(url_for('/staff/metrics/index.php'));
} else {
  find_metric_by_id($id);
}


$page_title = 'Delete Exercises Category';
include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/metrics/index.php'); ?>">&laquo; Back to List</a>
  <div class="delete metric">
    <h1>DELETE METRIC: <?= h($metric['metric']); ?></h1>
    <p><strong>Are you sure you want to delete this metric?</strong></p>
    <form action="<?php echo url_for('staff/metrics/delete.php?id=' . h(u($id)));?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Exercise" />
      </div>

  </div>

</div>
