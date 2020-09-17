<?php require_once('../../../private/initialize.php');

if(is_post_request()) {
  $workout_type = [];
  $workout_type['workout_type'] = $_POST['workout_type'];
  $workout_type['description'] = $_POST['description'];
  $result = insert_workout_type($workout_type);
  if($result === true){
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/staff/workout_types/view.php?id=' . $new_id));
  } else {
    $errors = $result;
  }
} else {
    $workout_type = [];
    $workout_type['workout_type'] = '';
    $workout_type['description'] = '';
}


?>
<?php $page_title = 'Create Workout Type'; ?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/workout_types/index.php');?>">&laquo; Back to List</a>
<div class="workout type new">
  <h1>Create Workout Type</h1>
  <?= display_errors($errors); ?>
  <form action="<?= url_for('/staff/workout_types/new.php'); ?>" method="post">
    <dl>
      <dt>Name</dt>
      <dd><input type="text" name="workout_type" value="<?= $workout_type['workout_type']; ?>" /></dd>
    </dl>
    <dl>
      <dt>Description</dt>
      <dd><input type="text" name="description" value="" /></dd>
    </dl>

    <div id="operations">
      <input type="submit" value="Create New Workout Type" />
    </div>
  </form>

</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
