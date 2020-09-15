<?php require_once('../../../private/initialize.php');

//create new workout
  # Checks to see if it's a post request, then checks to see if it is a submission
  # the new workout form
  # Create workout array
  # Submit new workout query to SQL
  # Receive workout ID
  # Redirect to edit page
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
    $id = mysqli_insert_id($db);
    redirect_to(url_for('/staff/workouts/edit.php?id=' . h(u($id))));

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
</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
