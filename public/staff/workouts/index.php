<?php require_once('../../../private/initialize.php'); ?>
<?php $workouts = find_all_workouts();
?>
<?php $page_title = "Workouts" ?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
  <div class="exercise listing">
    <h1>Workouts</h1>
    <div class="actions">
      <a class="action" href="new.php"> Create New Workout</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Author</th>
        <th>Type</th>
        <th>Metric</th>
        <th>Time</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php while ($workout = mysqli_fetch_assoc($workouts)) :
        $metricName = find_metric_by_id($workout['metric_id']);
        $workoutType = find_workout_type_by_id($workout['workout_type_id']);
        ?>
        <tr>
          <td><?= h($workout['id'])?></td>
          <td><?= h($workout['workout_name']) ?? ''?></td>
          <td><?= h($workout['author']) ?? '' ?></td>
          <td><?php
                if (isset($workoutType['id'])) {
                  echo h($workoutType['workout_type']);
                }echo "&nbsp";
           ?></td>
          <td><?php
                if (isset($metricName['id'])) {
                  echo h($metricName['metric']);
                }echo "&nbsp";
           ?></td>
          <td><?= h($workout['workout_time'])?? '' ?></td>
          <td><a class="action" href="<?= url_for('/staff/workouts/view.php?id=' . h(u($workout['id'])));?>">View</a></td>
          <td><a class="action" href="<?= url_for('/staff/workouts/edit.php?id=' . h(u($workout['id'])));?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('/staff/workouts/delete.php?id=' . h(u($workout['id'])));?>">Delete</a></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
