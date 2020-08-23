<?php
require_once('../../../private/initialize.php');
$id = $_GET['id'] ?? '1';
$metcon = find_metcon_by_id($id);
 ?>

 <?php $page_title = 'View Metcon' ?>
 <?php include(SHARED_PATH . '/staff_header.php');?>

 <div id="content">
  <a class="back-link" href="<?= url_for('/staff/metcon/index.php');?>">&laquo;Back to List</a>
  <div class="view metcon">
    <h1>Metcon: <?= h($metcon['metcon']); ?></h1>
    <div class="attributes">
      <dl>
        <dt>Description</dt>
        <dd><?= h($metcon['description']); ?></dd>
      </dl>
    </div>
  </div>
 </div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
