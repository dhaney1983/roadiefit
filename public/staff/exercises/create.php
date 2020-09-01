<?php

require_once('../../../private/initialize.php');
if(is_post_request()) {

  $exercise = [];
  $exercise['exercise_name'] = $_POST['exercise_name'];
  $exercise['category_id'] = $_POST['category_id'];
  $exercise['vidLink'] = $_POST['vidLink'];
  $exercise['instruction'] = $_POST['instruction'];

  $result = insert_exercise($exercise);
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('/staff/exercises/view.php?id=' . $new_id));

} else {
  redirect_to(url_for('/staff/exercises/new.php'));
}

?>
