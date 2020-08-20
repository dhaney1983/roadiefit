<?php require_once('../../../private/initialize.php') ?>
  <?php $subjects = [
    ['id' => '1', 'exercise_name' => 'Sumo Deadlift', 'category' => 'Kettle Bell', 'instruction' => 'This that and the other', 'vidLink' => 'https://www.youtube.com/embed/cKx8xE8jJZs?start=60'],
    ['id' => '2', 'exercise_name' => 'Sumo Deadlift Lockout', 'category' => 'Kettle Bell', 'instruction' => 'This that and the other', 'vidLink' => 'https://www.youtube.com/embed/cKx8xE8jJZs?start=60'],
    ['id' => '3', 'exercise_name' => 'Face-the-Wall Squat', 'category' => 'Kettle Bell', 'instruction' => 'This that and the other', 'vidLink' => 'https://www.youtube.com/embed/cKx8xE8jJZs?start=60'],
  ];
?>

<?php $page_title = 'Exercises'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="exercise listing">
    <h1>Exercises</h1>
    <div class="actions">
      <a class="action" href="new.php"> Create New Exercise</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Instruction</th>
        <th>Video Link</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php foreach ($subjects as $subject): ?>
        <tr>
          <td><?php echo $subject['id']?></td>
          <td><?php echo $subject['exercise_name']?></td>
          <td><?php echo $subject['category']?></td>
          <td><?php echo $subject['instruction']?></td>
          <td><a href="<?php echo $subject['vidLink']?>">Video Link</a></td>
          <td><a class="action" href="<?= url_for('/staff/exercises/view.php?id=' . $subject['id']);?>"</a>View</td>
          <td>Edit</td>
          <td>Delete</td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
  </body>
</html>
