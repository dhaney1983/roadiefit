<?php require_once('../../../private/initialize.php') ?>
  <?php
  $exercise_set = find_all_exercises();

?>

<?php $page_title = 'Exercises'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="exercise listing">
    <h1>Exercises</h1>
    <div class="actions">
      <a class="action" href="<?= url_for('/staff/exercises/new.php');?>"> Create New Exercise</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Video Link</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php while ($exercise = mysqli_fetch_assoc($exercise_set)) :?>
        <tr>
          <td><?= $exercise['id']?></td>
          <td><?= $exercise['exercise_name']?></td>
          <td><?= $exercise['category']?></td>
          <td><a href="<?= $subject['vidLink']?>">Video Link</a></td>
          <td><a class="action" href="<?= url_for('/staff/exercises/view.php?id=' . h(u($exercise['id'])));?>">View</a></td>
          <td><a class="action" href="<?= url_for('/staff/exercises/edit.php?id=' . h(u($exercise['id'])));?>">Edit</a></td>
          <td>Delete</td>
        </tr>
      <?php endwhile; ?>
    </table>
    <?php mysqli_free_result($exercise_set); ?>
  </div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
  </body>
</html>
