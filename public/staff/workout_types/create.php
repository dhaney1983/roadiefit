<?php
require_once('../../../private/initialize.php');

if (is_post_request()) {
  $workout_type = [];
  $workout_type['workout_type'] = $_POST['workout_type'];
  $workout_type['description'] = $_POST['description'];
  $result = insert_workout_type($workout_type);
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('/staff/workout_types/view.php?id=' . $new_id));

} else {

  redirect_to(url_for('/staff/workout_types/new.php'));

}

 ?>
