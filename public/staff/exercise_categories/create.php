<?php
require_once('../../../private/initialize.php');

if (is_post_request()) {
  $exercise_category = [];
  $exercise_category['exercise_category'] = $_POST['exercise_category'];
  $exercise_category['description'] = $_POST['description'];
  $result = insert_exercise_category($exercise_category['exercise_category'], $exercise_category['description']);
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('/staff/exercise_categories/view.php?id=' . $new_id));

} else {

  redirect_to(url_for('/staff/exercise_categories/new.php'));

}

 ?>
