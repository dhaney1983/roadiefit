<?php
require_once('../../../private/initialize.php');
$id = $_GET['id'] ?? '1';
$mod_type = find_mod_type_by_id($id);
 ?>

 <?php $page_title = 'View Mod Type' ?>
 <?php include(SHARED_PATH . '/staff_header.php');?>

 <div id="content">
  <a class="back-link" href="<?= url_for('/staff/mod_types/index.php');?>">&laquo;Back to List</a>
  <div class="view mod_type">
    <h1>Mod Type: <?= h($mod_type['mod_type']); ?></h1>
    <div class="attributes">
      <dl>
        <dt>Description</dt>
        <dd><?= h($mod_type['description']); ?></dd>
      </dl>
    </div>
  </div>
 </div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
