<?php

require_once('../../../private/initialize.php');

// Sets ID from Get or POST requests
$id = $_GET['id'] ?? $_POST['id'];
// $workout_step=[];
// $workout_step['mod_id'] = '';
// $workout_step['step_order'] = '';
// $workout_step['exercise_id'] = '';
// $workout_step['reps'] = '';
//Makes sure id is set, if not, redirects to index
if(!isset($id)) {
  redirect_to(url_for('/staff/workouts/index.php'));
}

if(is_post_request()) {

  // Handle form values sent by New Workout form
  if($_POST['submit'] == 'Edit Workout'){
    $workout = [];
    $workout['workout_name'] = $_POST['workout_name'] ?? '';
    $workout['author'] = $_POST['author'] ?? '';
    $workout['metric_id'] = $_POST['metric_id'] ?? '';
    $workout['rounds'] = $_POST['rounds'] ?? '';
    $workout['workout_time'] = $_POST['workout_time'] ?? '';
    $workout['workout_type_id'] = $_POST['workout_type_id'] ?? '';
    $workout['instructions'] = $_POST['instructions'] ?? '';
    $workout['weight'] = $_POST['weight'] ?? '';
    $workout['stimulus'] = $_POST['stimulus'] ?? '';
    $workout['scales'] = $_POST['scales'] ?? '';
    $workout['id'] = $id;
    $result = update_workout($workout);
    if ($result === true) {
      redirect_to(url_for('/staff/workouts/view.php?id=' . h(u($id))));
    } else {
      $errors = $result;
    }

    // Handle form values set by new mod form
  } elseif ($_POST['submit'] == 'Add Mod') {
    $workout = find_workout_by_id($id);
    $mod = [];
    $mod['workout_id'] = $id ?? '';
    $mod['mod_type_id'] = $_POST['mod_type_id'] ?? '';
    $mod['mod_order'] = $_POST['mod_order'] ?? '';
    $mod['description'] = $_POST['description'] ?? '';
    $result = insert_mod($mod);
    if ($result === true) {
      $mod = [];
      $mod['id'] = '';
      $mod['workout_id'] = $id ?? '';
      $mod['mod_type_id'] = '';
      $mod['mod_order'] = '';
      $mod['description'] = '';
    } else {
      $errors = $result;
    }

  // Handle form values set by new workout step form
  } elseif ($_POST['submit'] == 'Add') {
    $workout = find_workout_by_id($id);
    $workout_step=[];
    $workout_step['mod_id'] = $_POST['mod_id'] ?? '';
    $workout_step['step_order'] = $_POST['step_order'] ?? '';
    $workout_step['exercise_id'] = $_POST['exercise_id'] ?? '';
    $workout_step['reps'] = $_POST['reps'] ?? '';
    $result = insert_workout_steps($workout_step);
    if ($result === true) {
      // $workout_steps = find_workout_steps_by_workout($id);



    } else {
      $errors = $result;
    }
    $mod = [];
    $mod['id'] = '';
    $mod['workout_id'] = $id ?? '';
    $mod['mod_type_id'] = '';
    $mod['mod_order'] = '';
    $mod['description'] = '';

  } elseif ($_POST['submit'] == 'Update') {
    $workout = find_workout_by_id($id);
    //
    $mod = [];
    $mod['id'] = $_POST['mod_id'] ?? '';
    $mod['workout_id'] = $id ?? '';
    $mod['mod_type_id'] = $_POST['mod_type_id'] ?? '';
    $mod['mod_order'] = $_POST['mod_order'] ?? '';
    $mod['description'] = $_POST['description'] ?? '';
    update_mod($mod);
    redirect_to(url_for('/staff/workouts/edit.php?id=' . h(u($id))));
    }

} else {

}

$workout = find_workout_by_id($id);


  $mod = [];
  $mod['id'] = '';
  $mod['workout_id'] = $id ?? '';
  $mod['mod_type_id'] = '';
  $mod['mod_order'] = '';
  $mod['description'] = '';





?>

<?php $page_title = 'Edit Workout'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?= url_for('/staff/workouts/index.php'); ?>">&laquo; Back to List</a>
  <div class="workout edit">
    <h1>Edit Workout</h1>
    <?= display_errors($errors); ?>
    <table>
      <tr>
        <td width="460" align="left" valign="top">
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
              <dt>Rounds</dt>
              <dd><input type="text" name="rounds" value="<?= h($workout['rounds']) ?>" /></dd>
            </dl>
            <dl>
              <dt>Time</dt>
              <dd><input type="text" name="workout_time" value="<?= h($workout['workout_time']); ?>" /></dd>
            </dl>
            <dl>
              <dt>Instruction</dt>
              <dd><textarea name="instructions" id="comments" cols="30" rows="10"><?= h($workout['instructions']); ?></textarea></dd>
            </dl>
            <dl>
              <dt>Weight</dt>
              <dd><textarea name="weight" id="comments" cols="30" rows="10"><?= h($workout['weight']); ?></textarea></dd>
            </dl>
            <dl>
              <dt>Stimulus</dt>
              <dd><textarea name="stimulus" id="comments" cols="30" rows="10"><?= h($workout['stimulus']); ?></textarea></dd>
            </dl>
            <dl>
              <dt>Scales</dt>
              <dd><textarea name="scales" id="comments" cols="30" rows="10"><?= h($workout['scales']); ?></textarea></dd>
            </dl>
            <div id="operations">
              <input type="submit" name="submit" value="Edit Workout" />
            </div>
          </form>
        </td>
        <td alight="left" valign="top" width="460">
          <!-- Mods Table -->
          <table border="1" align="left" valign="top" class="list">
            <tr>
              <!-- Header -->
              <th colspan="4">INSERT NEW MOD</th>
            </tr>

            <tr>
              <th width="75">Order</th>
              <th>Mod</th>
              <th>Description</th>
              <th>&nbsp;</th>
            </tr>

            <!-- New Mod Table -->
            <tr><form action="<?= url_for('/staff/workouts/edit.php?id=' . h(u($id))); ?>" method="post">
              <td><input type="text" size="5" name="mod_order" value="<?= $mod['mod_order']?>" /></td>
              <td>
                <select name="mod_type_id" />
                <option value=""></option>
                <?php
                $mod_type_set = find_all_mod_types();
                while($mod_type = mysqli_fetch_assoc($mod_type_set)){
                  echo "<option value=\"" . h($mod_type['id']) . "\"";
                  if($mod["mod_type_id"] == $mod_type['id']) {
                    echo "selected";
                  }
                  echo ">" . h($mod_type['mod_type']) . "</option>";
                }
                mysqli_free_result($mod_type_set);
                 ?>
               </td>
               <td><input type="text" size="" name="description" value="" /></td>
               <td>
                  <input type="hidden" name="workout_id" value="<?php echo $id; ?>">
                  <input type="submit" name="submit" value="Add Mod" /></form>
                </td>
              </form>
            </tr>
          </table>&nbsp;
          <!-- Exercise Steps Table -->
            <!-- New Exercise steps form -->
            <!-- exercise steps loop generating table -->
          <?php
            $mod_set = find_workout_mod_by_workout($id);
            while ($mod = mysqli_fetch_assoc($mod_set)) :
          ?>
          <!-- Exercise Steps Table -->
              <table border="2" align="left" valign="top" class="list">
                <tr>
                  <!-- Header -->
                  <th colspan="3">
                    <?php
                      $mod_type = find_mod_type_by_id($mod['mod_type_id']);
                      echo $mod_type['mod_type'] . " " . $mod['description'];
                    ?>
                  </th>
                  <th><a class="action" href="<?= url_for('/staff/workouts/delete_mod.php?id=' . h(u($mod['id'])) . '&workout_id=' . h(u($mod['workout_id'])));?>">delete</a></th>
                </tr>
                <tr>
                  <th colspan="4">
                    <dl>
                      <dt>Mod Description</dt>
                      <dd>
                        <form action="<?= url_for('/staff/workouts/edit.php?id=' . h(u($id)));?>" method="post">
                        <input type="text" name="description" value="<?= $mod['description'] ?>" />
                        <input type="hidden" name="mod_id" value="<?= $mod['id'] ?>" />
                        <input type="submit" name="submit" value="Update" />
                        </form>
                      </dd>
                    </dl>
                  </th>
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
                    <option value="">&nbsp;</option>
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
                      <input type="hidden" name="mod_id" value="<?php echo $mod['id']; ?>">
                      <input type="hidden" name="workout_id" value="<?php echo $id; ?>">
                      <input type="submit" name="submit" value="Add" /></form>
                    </td>
                </tr>

                <!-- exercise steps loop generating table -->
                <?php
                $workout_steps = find_workout_steps_by_mod($mod['id']);
                  while($workout_step = mysqli_fetch_assoc($workout_steps)){
                    $exerciseName = find_exercise_by_id($workout_step['exercise_id']);
                    echo "<tr>";
                    echo "<td>{$workout_step['step_order']}</td>";
                    echo "<td>{$exerciseName['exercise_name']}</td>";
                    echo "<td>{$workout_step['reps']}</td>";
                    echo "<td><a class=\"action\" href=\"" . url_for('/staff/workouts/delete_workout_step.php?id=' . h(u($workout_step['id']))) . '&workout_id=' . h(u($id));
                    echo "\">delete" . "</td>";
                    echo "</tr>";
                  }
                 ?>
              </table>
              <p>&nbsp;
          <?php endwhile; ?>
        </td>
      </tr>
    </table>
  </table>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
