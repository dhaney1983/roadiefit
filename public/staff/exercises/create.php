<?php

require_once('../../../private/initialize.php');
if(is_post_request()) {
  $exerciseName = $_POST['exercise_name'];
  $category_id = $_POST['category_id'];
  $vidLink = $_POST['vidLink'];
  $instruction = $_POST['instruction'];

  $result = insert_exercise($exerciseName, $category_id, $vidLink, $instruction);
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('/staff/exercises/view.php?id=' . $new_id));

} else {
  redirect_to(url_for('/staff/exercises/new.php'));
}

?>
