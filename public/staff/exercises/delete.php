<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/exercises/index.php'));
}

$id = $_GET['id'];

$exercise = find_exercise_by_id($id);

if(is_post_request()){
  $result = delete_exercise($id);
  redirect_to(url_for('/staff/exercises/index.php'));
} else {
  find_exercise_by_id($id);
}


$page_title = 'Delete Exercises Category';
include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/exercises/index.php'); ?>">&laquo; Back to List</a>
  <div class="delete exercise">
    <h1>DELETE EXERCISE: <?= h($exercise['exercise_name']); ?></h1>
    <p><strong>Are you sure you want to delete this exercise?</strong></p>
    <form action="<?php echo url_for('staff/exercises/delete.php?id=' . h(u($id)));?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Exercise" />
      </div>

  </div>

</div>
