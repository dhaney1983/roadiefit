<?php
require_once('../../../private/initialize.php');
$id = $_GET['id'] ?? '1';
$workout_type = find_workout_type_by_id($id);

 ?>

 <?php $page_title = 'View Workout Type' ?>
 <?php include(SHARED_PATH . '/staff_header.php');?>

 <div id="content">
  <a class="back-link" href="<?= url_for('/staff/workout_types/index.php');?>">&laquo;Back to List</a>
  <div class="view workout_type">
    <h1>Workout Type: <?= h($workout_type['workout_type']); ?></h1>
    <div class="attributes">
      <dl>
        <dt>Description</dt>
        <dd><?= h($workout_type['description']); ?></dd>
      </dl>
    </div>
  </div>
 </div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
