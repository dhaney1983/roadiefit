<?php
require_once('../../../private/initialize.php');
$id = $_GET['id'] ?? '1';
$metric = find_metric_by_id($id);
 ?>

 <?php $page_title = 'View Metric' ?>
 <?php include(SHARED_PATH . '/staff_header.php');?>

 <div id="content">
  <a class="back-link" href="<?= url_for('/staff/metrics/index.php');?>">&laquo;Back to List</a>
  <div class="view metric">
    <h1>Metric: <?= h($metric['metric']); ?></h1>
    <div class="attributes">
      <dl>
        <dt>Description</dt>
        <dd><?= h($metric['description']); ?></dd>
      </dl>
    </div>
  </div>
 </div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
