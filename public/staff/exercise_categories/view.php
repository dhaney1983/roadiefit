<?php
require_once('../../../private/initialize.php');
$id = $_GET['id'] ?? '1';
$exercise_category = find_exercise_category_by_id($id);

 ?>

 <?php $page_title = 'View Workout Type' ?>
 <?php include(SHARED_PATH . '/staff_header.php');?>

 <div id="content">
  <a class="back-link" href="<?= url_for('/staff/exercise_categories/index.php');?>">&laquo;Back to List</a>
  <div class="view workout_type">
    <h1>Exercise Category: <?= h($exercise_category['exercise_category']); ?></h1>
    <div class="attributes">
      <dl>
        <dt>Description</dt>
        <dd><?= h($exercise_category['description']); ?></dd>
      </dl>
    </div>
  </div>
 </div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
