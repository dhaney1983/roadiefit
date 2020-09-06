<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/workouts/index.php'));
}

$id = $_GET['id'];

$workout = find_workout_by_id($id);

if(is_post_request()){
  $result = delete_workout_and_steps($id);
  redirect_to(url_for('/staff/workouts/index.php'));
} else {
  find_workout_by_id($id);
}


$workout_title = 'Delete Workouts Category';
include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/workouts/index.php'); ?>">&laquo; Back to List</a>
  <div class="delete workout">
    <h1>DELETE WORKOUT: <?= h($workout['workout_name']); ?></h1>
    <p><strong>Are you sure you want to delete this workout?</strong></p>
    <form action="<?php echo url_for('staff/workouts/delete.php?id=' . h(u($id)));?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Workout Type" />
      </div>

  </div>

</div>
