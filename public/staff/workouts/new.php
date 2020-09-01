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
      $workout['instructions'] = $_POST['instructions'] ?? '';
      $workout['stimulus'] = $_POST['stimulus'] ?? '';
      $workout['scales'] = $_POST['scales'] ?? '';
      $workout['workout_time'] = $_POST['workout_time'] ?? '';
      $workout['workout_type_id'] = $_POST['workout_type_id'] ?? '';
      $workout['submit'] = $_POST['submit'] ?? '';

    $new_workout = insert_workout($workout);
    $new_id = mysqli_insert_id($db);
    $workout_steps = find_workout_steps_by_workout($new_id);

    // $workout_steps = find_workout_steps_by_workout($new_id) ?? '';

    print_r($workout);
  // Create new workout_step
  /* If it IS a post request but the form submission is NOT the new workout form, it is the workout steps
     form.  It will create a new workout step */
      # create new_id variable from ID saved in hidden form field in exercise_steps.php
      # search for the workout that was just submitted
      # create workwout step array
      # create new workout step
      # search for workout steps, used in exercise step table
    } else {

      $new_id = $_POST['workout_id'];
      $workout = find_workout_by_id($new_id);

      $workout_step=[];
        $workout_step['workout_id'] = $_POST['workout_id'] ?? '';
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
      $workout['workout_time'] = '';
      $workout['workout_type_id'] = '';
      $workout['submit'] = '';

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
    <td width="460">
      <form action="<?= url_for('/staff/workouts/new.php'); ?>" method="post">
        <dl>
          <dt>Workout Name</dt>
          <dd><input type="text" name="workout_name" value="<?= h(u($workout['workout_name'])) ?>" /></dd>
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
          <dt>Time</dt>
          <dd><input type="text" name="workout_time" value="<?=$workout['workout_time'] ?>" /></dd>
        </dl>
        <dl>
          <dt>Instruction</dt>
          <dd><textarea name="instructions" id="comments" cols="30" rows="10"><?= $workout['instructions']; ?></textarea></dd>
        </dl>
        <dl>
          <dt>Stimulus</dt>
          <dd><textarea name="stimulus" id="comments" cols="30" rows="10"><?= $workout['stimulus']; ?></textarea></dd>
        </dl>
        <dl>
          <dt>Scales</dt>
          <dd><textarea name="scales" id="comments" cols="30" rows="10"><?= $workout['scales']; ?></textarea></dd>
        </dl>
        <div id="operations">
          <input type="submit" name="submit" value="workout" /></form>
        </div>
      </form>
    </td>
    <td alight="left" valign="top" width="460">
      <!-- If post request has been submitted, from either form, exercise_step.php is included -->
      <?php
      if (is_post_request()){
        include('exercise_steps.php');
      }
      ?>
      <?php ?>
    </td>
  </tr>
</table>
</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
