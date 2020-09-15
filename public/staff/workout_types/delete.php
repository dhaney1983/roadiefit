<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/workout_types/index.php'));
}

$id = $_GET['id'];

$workout_type = find_workout_type_by_id($id);

if(is_post_request()){
  $result = delete_workout_type($id);
  redirect_to(url_for('/staff/workout_types/index.php'));
} else {
  find_workout_type_by_id($id);
}


$workout_type_title = 'Delete Exercises Category';
include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/workout_types/index.php'); ?>">&laquo; Back to List</a>
  <div class="delete workout_type">
    <h1>DELETE WORKOUT TYPE: <?= h($workout_type['workout_type']); ?></h1>
    <p><strong>Are you sure you want to delete this workout_type?</strong></p>
    <form action="<?php echo url_for('staff/workout_types/delete.php?id=' . h(u($id)));?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Workout Type" />
      </div>

  </div>

</div>
