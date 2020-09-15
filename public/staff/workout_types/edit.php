<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php

  $workout_type = [];
  $workout_type['id'] = $id;
  $workout_type['workout_type'] = $_POST['workout_type'] ?? '';
  $workout_type['description'] = $_POST['description'] ?? '';
  $result = update_workout_type($workout_type);
  redirect_to(url_for('/staff/workout_types/view.php?id=' . h(u($id))));
} else {
  $workout_type = find_workout_type_by_id($id);
}

?>

<?php $page_title = 'Edit Workout Type'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/workout_types/index.php'); ?>">&laquo; Back to List</a>

  <div class="page edit">
    <h1>Edit Metric</h1>

    <form action="<?= url_for('/staff/workout_types/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Name</dt>
        <dd><input type="text" name="workout_type" value="<?=h($workout_type['workout_type'])?>" /></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><input type="text" name="description" value="<?= h($workout_type['description']) ?>" /></dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Update Workout Type" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
