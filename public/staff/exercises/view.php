<?php

require_once('../../../private/initialize.php');
$id = $_GET['id'] ?? '1';
$exercise = find_exercise_by_id($id);

 ?>

 <?php $page_title = 'View Exercise' ?>
 <?php include(SHARED_PATH . '/staff_header.php');?>

 <div id="content">
   <a class="back-link" href="<?= url_for('/staff/exercises/index.php');?>">&laquo;Back to List</a>

   <div class="view exercise">
    <h1>Exercise: <?= h($exercise['exercise_name']) ?></h1>

    <div class = "attributes">
      <dl>
        <dt>Exercise Name</dt>
        <dd><?= h($exercise['exercise_name']) ?></dd>
      </dl>
      <dl>
        <dt>Category</dt>
        <dd><?= h($exercise['category']) ?></dd>
      </dl>
      <dl>
        <dt>Instruction</dt>
        <dd><?= h($exercise['instruction']) ?></dd>
      </dl>
      <dl>
        <dt>Instruction Video</dt>
        <dd><iframe width="560" height="315" src="<?= h($exercise['vidLink']) ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></dd>
      </dl>

    </div>


  </div>
 </div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
