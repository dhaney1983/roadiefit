<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {
$workout[] = "";
  $workout['workout_name'] = $_POST['workout_name'] ?? '';
  $workout['author'] = $_POST['author'] ?? '';
  $workout['metric_id'] = $_POST['metric_id'] ?? '';
  $workout['instructions'] = $_POST['instructions'] ?? '';
  $workout['stimulus'] = $_POST['stimulus'] ?? '';
  $workout['scales'] = $_POST['scales'] ?? '';
  $workout['workout_time'] = $_POST['workout_time'] ?? '';
  $workout['workout_type_id'] = $_POST['workout_type_id'] ?? '';
  $result = insert_workout($workout);
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('/staff/workouts/view.php?id=' . $new_id));

  } else {
    redirect_to(url_for('/staff/workouts/new.php'));
  }

?>
