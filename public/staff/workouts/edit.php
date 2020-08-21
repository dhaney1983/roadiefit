<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/workouts/index.php'));
}
$id = $_GET['id'];
$workout_name = '';
$author = '';
$metcon = '';
$time = '';
$instructions = '';
$stimulus = '';
$scales = '';

if(is_post_request()) {

  // Handle form values sent by new.php

  $workout_name = $_POST['workout_name'] ?? '';
  $author = $_POST['author'] ?? '';
  $metcon = $_POST['fkMetcon'] ?? '';
  $time = $_POST['time'] ?? '';
  $instructions = $_POST['instructions'] ?? '';
  $stimulus = $_POST['stimulus'] ?? '';
  $scales = $_POST['scales'] ?? '';

  echo "Form parameters<br />";
  echo "Workout Name: " . $workout_name . "<br />";
  echo "Author: " . $author . "<br />";
  echo "Metcon: " . $metcon . "<br />";
  echo "Time: " . $time . "<br />";
  echo "Instructions: " . $instructions . "<br />";
  echo "Stimulus: " . $stimulus . "<br />";
  echo "Scales: " . $scales . "<br />";
}

?>

<?php $page_title = 'Edit Workout'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?= url_for('/staff/workouts/index.php'); ?>">&laquo; Back to List</a>

  <div class="workout edit">
    <h1>Edit Workout</h1>
  <table>
    <tr>
      <td width="460">
        <form action="<?= url_for('/staff/workouts/edit.php?id=' . h(u($id))); ?>" method="post">
          <dl>
            <dt>Workout Name</dt>
            <dd><input type="text" name="workout_name" value="<?= h($workout_name); ?>" /></dd>
          </dl>
          <dl>
            <dt>Author</dt>
            <dd><input type="text" name="author" value="<?= h($author); ?>" /></dd>
          </dl>
          <dl>
            <dt>Metcon</dt>
            <dd><input type="text" name="fkMetcon" value="<?= h($metcon); ?>" /></dd>
          </dl>
          <dl>
            <dt>Time</dt>
            <dd><input type="text" name="time" value="<?= h($time); ?>" /></dd>
          </dl>
          <dl>
            <dt>Instruction</dt>
            <dd><textarea name="instructions" id="comments" cols="30" rows="10"><?= h($instructions); ?></textarea></dd>
          </dl>
          <dl>
            <dt>Stimulus</dt>
            <dd><textarea name="stimulus" id="comments" cols="30" rows="10"><?= h($stimulus); ?></textarea></dd>
          </dl>
          <dl>
            <dt>Scales</dt>
            <dd><textarea name="scales" id="comments" cols="30" rows="10"><?= h($scales); ?></textarea></dd>
          </dl>
          <div id="operations">
            <input type="submit" value="Submit Changes to Workout" />
          </div>
        </form>
    </td>
  <td alight="left" valign="top" width="460">
    <table border="0" align="left" valign="top" class="list">
      <tr>
        <th colspan="2">Exercises</th>
      </tr>
      <tr>
        <th width="75">Order</th>
        <th>Exercise</th>
      </tr>
    </table>
  </td>
</tr>
</table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
