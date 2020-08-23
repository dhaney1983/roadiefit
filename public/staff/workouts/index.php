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
        <th>Metcon</th>
        <th>Time</th>
        <th>Instructions</th>
        <th>Stimulus</th>
        <th>Scales</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php while ($workout = mysqli_fetch_assoc($workouts)) : ?>
        <tr>
          <td><?= h($workout['id'])?></td>
          <td><?= h($workout['workout_name'])?></td>
          <td><?= h($workout['author'])?></td>
          <td><?= h($workout['fkMetcon'])?></td>
          <td><?= h($workout['workoutTime'])?></td>
          <td><?= h($workout['instructions'])?></td>
          <td><?= h($workout['stimulus'])?></td>
          <td><?= h($workout['scales'])?></td>
          <td><a class="action" href="<?= url_for('/staff/workouts/view.php?id=' . h(u($workout['id'])));?>">View</a></td>
          <td><a class="action" href="<?= url_for('/staff/workouts/edit.php?id=' . h(u($workout['id'])));?>">Edit</a></td>
          <td>Delete</td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
