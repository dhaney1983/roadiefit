<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/workouts/index.php'));
}
$id = $_GET['id'];


if(is_post_request()) {

  // Handle form values sent by new.php
  if($_POST['submit'] == 'Edit Workout'){
    $workout = [];
      $workout['workout_name'] = $_POST['workout_name'] ?? '';
      $workout['author'] = $_POST['author'] ?? '';
      $workout['metric_id'] = $_POST['metric_id'] ?? '';
      $workout['workout_time'] = $_POST['workout_time'] ?? '';
      $workout['workout_type_id'] = $_POST['workout_type_id'] ?? '';
      $workout['instructions'] = $_POST['instructions'] ?? '';
      $workout['stimulus'] = $_POST['stimulus'] ?? '';
      $workout['scales'] = $_POST['scales'] ?? '';
      $workout['id'] = $id;
      $result = update_workout($workout);
      redirect_to(url_for('/staff/workouts/view.php?id=' . h(u($id))));
    } else {

      $workout = find_workout_by_id($id);

      $workout_step=[];
        $workout_step['workout_id'] = $id;
        $workout_step['step_order'] = $_POST['step_order'] ?? '';
        $workout_step['exercise_id'] = $_POST['exercise_id'] ?? '';
        if ($_POST['reps'] > 0) {
          $workout_step['reps'] = $_POST['reps'];
        } else {
          $workout_step['reps'] = "0";
        }
      insert_workout_steps($workout_step);
      redirect_to(url_for('/staff/workouts/edit.php?id=' . h(u($id))));

    }
  } else {
    $workout = find_workout_by_id($id);
    $workout_steps = find_workout_steps_by_workout($id);
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
            <dd><input type="text" name="workout_name" value="<?= h($workout['workout_name']); ?>" /></dd>
          </dl>
          <dl>
            <dt>Author</dt>
            <dd><input type="text" name="author" value="<?= h($workout['author']); ?>" /></dd>
          </dl>
          <dl>
            <dt>Workout Type</dt>
            <dd>
              <select name="workout_type_id">
                <option value="">
              <?php
                $workout_types = find_all_workout_types();
                while ($workout_type = mysqli_fetch_assoc($workout_types)) {
                  echo "<option value=\"" . $workout_type['id'] . "\"";
                  if ($workout['workout_type_id'] == $workout_type['id']) {
                  echo " selected";
                  }
                echo ">" . h($workout_type['workout_type']) . "</option>";
                }
              ?></select>
            </dd>
          </dl>
          <dl>
            <dt>Metric</dt>
            <dd>
              <select name="metric_id">
                <option value="">
              <?php
                $metrics = find_all_metrics();
                while ($metric = mysqli_fetch_assoc($metrics)) {
                  echo "<option value=\"" . $metric['id'] . "\"";
                  if ($workout['metric_id'] == $metric['id']) {
                  echo " selected";
                  }
                echo ">" . h($metric['metric']) . "</option>";
                }
              ?></select>
            </dd>
          </dl>
          <dl>
            <dt>Time</dt>
            <dd><input type="text" name="workout_time" value="<?= h($workout['workout_time']); ?>" /></dd>
          </dl>
          <dl>
            <dt>Instruction</dt>
            <dd><textarea name="instructions" id="comments" cols="50" rows="5"><?= h($workout['instructions']); ?></textarea></dd>
          </dl>
          <dl>
            <dt>Stimulus</dt>
            <dd><textarea name="stimulus" id="comments" cols="50" rows="5"><?= h($workout['stimulus']); ?></textarea></dd>
          </dl>
          <dl>
            <dt>Scales</dt>
            <dd><textarea name="scales" id="comments" cols="50" rows="5"><?= h($workout['scales']); ?></textarea></dd>
          </dl>
          <div id="operations">
            <input type="submit" name="submit" value="Edit Workout" />
          </div>
        </form>
      </td>
      <td alight="left" valign="top" width="460">
        <!-- Exercise Steps Table -->
        <table border="0" align="left" valign="top" class="list">
          <tr>
            <!-- Header -->
            <th colspan="4">Exercises</th>
          </tr>
          <tr>
            <th width="75">Order</th>
            <th>Exercise</th>
            <th>Reps</th>
            <th>&nbsp;</th>
          </tr>

          <!-- New Exercise steps form -->
          <tr><form action="<?= url_for('/staff/workouts/edit.php?id=' . h(u($id))); ?>" method="post">
            <td><input type="text" size="5" name="step_order" value="" /></td>
            <td>
              <select name="exercise_id" />
              <option value="">&nbsp</option>
              <?php
              $exercises_set = find_all_exercises();
              while($exercise = mysqli_fetch_assoc($exercises_set)){
                echo "<option value=\"" . h($exercise['id']) . "\"";
                echo ">" . h($exercise['exercise_name']) . "</option>";
              }
              mysqli_free_result($exercises_set);
               ?>
             </td>
              <td><input type="text" size="8" name="reps" value=""  /></td>
              <td>
                <input type="hidden" name="workout_id" value="<?php
                  echo $new_id;
                ?>">
                <input type="submit" name="submit" value="Add" /></form>
              </td>
            </form>
          </tr>

          <!-- exercise steps loop generating table -->
          <?php
            while($workout_step = mysqli_fetch_assoc($workout_steps)){
              $exerciseName = find_exercise_by_id($workout_step['exercise_id']);
              echo "<tr>";
              echo "<td>{$workout_step['step_order']}</td>";
              echo "<td>{$exerciseName['exercise_name']}</td>";
              echo "<td>{$workout_step['reps']}</td>";
              echo "<td>" . "delete" . "</td>";
              echo "</tr>";
            }
           ?>
        </table>

      </td>
    </tr>
    <tr>
      <td colspan="2">

      </td>
    </tr>
  </table>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
