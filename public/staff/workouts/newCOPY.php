<?php require_once('../../../private/initialize.php');

//create new workout
  # Checks to see if it's a post request, then checks to see if it is a submission
  # the new workout form
  # Create workout array
  # Submit new workout query to SQL
  # Receive workout ID
if(is_post_request()){
  if($_POST['submit'] == 'workout'){
    $workout = [];
      $workout['workout_name'] = $_POST['workout_name'] ?? '';
      $workout['author'] = $_POST['author'] ?? '';
      $workout['metric_id'] = $_POST['metric_id'] ?? '';
      $workout['rounds'] = $_POST['rounds'] ?? '';
      $workout['instructions'] = $_POST['instructions'] ?? '';
      $workout['weight'] = $_POST['weight'] ?? '';
      $workout['stimulus'] = $_POST['stimulus'] ?? '';
      $workout['scales'] = $_POST['scales'] ?? '';
      $workout['workout_time'] = $_POST['workout_time'] ?? '';
      $workout['workout_type_id'] = $_POST['workout_type_id'] ?? '';
      $workout['submit'] = $_POST['submit'] ?? '';

    $new_workout = insert_workout($workout);
    $new_id = mysqli_insert_id($db);


  // Create new Mod
  /* If it IS a post request but the form submission is NOT the new workout form, the else if statement checks the submit variable
  value for "add mod" */
      # create new_id variable from ID saved in hidden form field in mod form
      # search for the workout that was just submitted
      # create mod array
      # create new mod
    } elseif ($_POST['submit'] == 'Add Mod') {

      $new_id = $_POST['workout_id'];
      $workout = find_workout_by_id($new_id);

      $mod = [];
        $mod['workout_id'] = $new_id ?? '';
        $mod['mod_type_id'] = $_POST['mod_type_id'] ?? '';
        $mod['mod_order'] = $_POST['mod_order'] ?? '';
        $mod['description'] = $_POST['description'];
      $result = insert_mod($mod);

  // Create new workout_step
  /* If it IS a post request but the form submission is NOT the new workout form, the else if statement checks the submit variable
  value for "add mod" */
      # create new_id variable from ID saved in hidden form field in workout step form
      # search for the workout that was just submitted
      # create workout step array
      # create new workout step
      # search for workout steps, used in exercise step table
    } elseif ($_POST['submit'] == 'Add') {
      // code...
      $new_id = $_POST['workout_id'];
      $workout = find_workout_by_id($new_id);
      //
      $workout_step=[];
        $workout_step['mod_id'] = $_POST['mod_id'] ?? '';
        $workout_step['step_order'] = $_POST['step_order'] ?? '';
        $workout_step['exercise_id'] = $_POST['exercise_id'] ?? '';
        if ($_POST['reps'] > 0) {
          $workout_step['reps'] = $_POST['reps'];
        } else {
          $workout_step['reps'] = "0";
        }
      insert_workout_steps($workout_step);
      $workout_steps = find_workout_steps_by_workout($new_id);

    }
// GET Request
  # Clear Workout array
  # Clear workout sets array
} else {

    $workout = [];
      $workout['workout_name'] = '';
      $workout['author'] = '';
      $workout['metric_id'] = '';
      $workout['instructions'] = '';
      $workout['stimulus'] = '';
      $workout['scales'] = '';
      $workout['weight'] = '';
      $workout['workout_time'] = '';
      $workout['workout_type_id'] = '';
      $workout['submit'] = '';
      $workout['rounds'] = '';

      $workout_steps = [];

  }
?>

<?php $page_title = 'Create Workout'; ?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/workouts/index.php');?>">&laquo; Back to List</a>
<div class="workout new">
  <h1>New Workout</h1>
  <!-- Create workout table -->
  <table>
  <tr>
    <td width="460" align="left" valign="top">
      <form action="<?= url_for('/staff/workouts/new.php'); ?>" method="post">
        <dl>
          <dt>Workout Name</dt>
          <dd><input type="text" name="workout_name" value="<?= h($workout['workout_name']) ?>" /></dd>
        </dl>
        <dl>
          <dt>Workout Type</dt>
          <dd><select name="workout_type_id">
          <option value="0">&nbsp;</option>

          <!-- Workout Type Menu -->
          <?php
            $workoutType_set = find_all_workout_types();
            while ($workoutType = mysqli_fetch_assoc($workoutType_set)) {
              echo "<option value=\"{$workoutType['id']}\"";
              if ($workout['workout_type_id'] == $workoutType['id']) {
                echo " selected";
              }
              echo ">{$workoutType['workout_type']}</option>";
            }
           ?>

          </select></dd>
        </dl>

        <dl>
          <dt>Author</dt>
          <dd><input type="text" name="author" value="<?= h($workout['author']) ;?>" /></dd>
        </dl>
        <dl>
          <dt>Metric</dt>
          <dd><select name="metric_id">
            <option value="0">&nbsp;</option>

            <!-- Metric Menu -->
            <?php
              $metric_set = find_all_metrics();
              while ($metric = mysqli_fetch_assoc($metric_set)) {
                echo "<option value=\"{$metric['id']}\"";
                if ($workout['metric_id'] == $metric['id']) {
                  echo " selected";
                }
                echo ">{$metric['metric']}</option>";
              }
            ?>

          </select></dd>
        </dl>
        <dl>
          <dt>Rounds</dt>
          <dd><input type="text" name="rounds" value="<?= h($workout['rounds']) ?>" /></dd>
        </dl>
        <dl>
          <dt>Time</dt>
          <dd><input type="text" name="workout_time" value="<?=h($workout['workout_time']) ?>" /></dd>
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
          <input type="submit" name="submit" value="workout" /></form>
        </div>
      </form>
    </td>
    <td alight="left" valign="top" width="460">
      <!-- If post request has been submitted, from either form, exercise_step.php is included -->
      <?php
      if (is_post_request()): ?>
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
        <tr><form action="<?= url_for('/staff/workouts/new.php'); ?>" method="post">
          <td><input type="text" size="5" name="mod_order" value="" /></td>
          <td>
            <select name="mod_type_id" />
            <option value=""></option>
            <?php
            $mod_type_set = find_all_mod_types();
            while($mod_type = mysqli_fetch_assoc($mod_type_set)){
              echo "<option value=\"" . h($mod_type['id']) . "\"";
              echo ">" . h($mod_type['mod_type']) . "</option>";
            }
            mysqli_free_result($mod_type_set);
             ?>
           </td>
           <td><input type="text" size="" name="description" value="" /></td>
           <td>
              <input type="hidden" name="workout_id" value="<?php echo $new_id; ?>">
              <input type="submit" name="submit" value="Add Mod" /></form>
            </td>
          </form>
        </tr>
      <!-- Exercise Steps Table -->
        <!-- New Exercise steps form -->
        <!-- exercise steps loop generating table -->
        <?php
          $mod_set = find_workout_mod_by_workout($new_id);
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
                          <form action="<?= url_for('/staff/workouts/edit.php') ?>" method="post">
                          <input type="text" name="description" value="<?= $mod['description'] ?>" />
                          <input type="hidden" name="mod_id" value="<?= $mod['id'] ?>" />
                          <input type="hidden" name="id" value="<?php echo $new_id; ?>">
                          <input type="submit" name="submit" value="Update" />
                        </form>
                        </dd>
                      </dl>
                    </th>
                  </tr>
                </tr>
                <tr>
                  <th width="75">Order</th>
                  <th>Exercise</th>
                  <th>Reps</th>
                  <th>&nbsp;</th>
                </tr>

                <!-- New Exercise steps form -->

                <tr><form action="<?= url_for('/staff/workouts/new.php'); ?>" method="post">
                  <td><input type="text" size="5" name="step_order" value="" /></td>
                  <td>
                    <select name="exercise_id" />
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
                      <input type="hidden" name="workout_id" value="<?php echo $new_id; ?>">
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
                    echo "<td><a class=\"action\" href=\"" . url_for('/staff/workouts/delete_workout_step.php?id=' . h(u($workout_step['id']))) . '&workout_id=' . h(u($new_id));
                    echo "\">delete" . "</td>";
                    echo "</tr>";
                  }
                 ?>
              </table><?php endwhile; ?>
    </td>
  </tr>
</table>
<?php
  endif;
?>

</td>
</tr>
</table>
</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
