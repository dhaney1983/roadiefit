<?php require_once('../../../private/initialize.php') ?>
<?php
$id = $_GET['id'] ?? '1';
 ?>

 <?php $page_title = 'View Workout' ?>
 <?php include(SHARED_PATH . '/staff_header.php');?>

 <div id="content">
   <a class="back-link" href="<?= url_for('/staff/workouts/index.php');?>">&laquo;Back to List</a>

   <div class="view workout">

   Workout ID: <?= h($id); ?>

  </div>
 </div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
