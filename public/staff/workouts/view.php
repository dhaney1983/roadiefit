<?php require_once('../../../private/initialize.php');
$id = $_GET['id'] ?? '1';
$workout = find_workout_by_id($id);
$metric = find_metric_by_id($workout['metric_id']);
$workout_type = find_workout_type_by_id($workout['workout_type_id']);
$workoutSteps_set = find_workout_steps_by_workout($id);
 ?>

 <?php $page_title = 'View Workout' ?>
 <?php include(SHARED_PATH . '/staff_header.php');?>

    <div id="content">
      <a class="back-link" href="<?= url_for('/staff/workouts/index.php');?>">&laquo;Back to List</a>
      <table>
        <tr>
          <td width="460">
            <div class="view workout">
            <h1><?= h($workout['workout_name']); ?></h1>
            <div class="attributes">
              <dl>
                <dt>Author</dt>
                <dd><?= h($workout['author']); ?></dd>
              </dl>
              <dl>
                <dt>Workout Type</dt>
                <dd><?= h($workout_type['workout_type']); ?></dd>
              </dl>
              <dl>
                <dt>Metric</dt>
                <dd><?= h($metric['metric']); ?></dd>
              </dl>
              <dl>
                <dt>Time</dt>
                <dd><?= h($workout['workout_time']); ?></dd>
              </dl>

              <dl>
                <dt>Instructions</dt>
                <dd><?= h($workout['instructions']); ?></dd>
              </dl>
              <dl>
                <dt>Stimulus</dt>
                <dd><?= h($workout['stimulus']); ?></dd>
              </dl>
              <dl>
                <dt>Scales</dt>
                <dd><?= h($workout['scales']); ?></dd>
              </dl>
            </div>
          </td>

          <td width="460" alight="left" valign="top">
            <table border="0" align="left" valign="top" class="list">
              <tr>
                <th colspan="3">Exercises</th>
              </tr>
              <tr>
                <th width="75">Order</th>
                <th width="75">Reps</th>
                <th>Exercise</th>
              </tr>
              <?php
              while ($workoutSteps = mysqli_fetch_assoc($workoutSteps_set)) :
              $exerciseName = find_exercise_by_id($workoutSteps['exercise_id']);?>
                <tr>
                  <td><?= h($workoutSteps['step_order']); ?></td>
                  <td><?= h($workoutSteps['reps']); ?></td>
                  <td>
                  <?php
                  if(isset($exerciseName['vidLink'])) :?>
                    <a href="<?= url_for('/staff/exercises/view.php?id=' . h(u($exerciseName['id'])));?>"><?= h($exerciseName['exercise_name']); ?>
                    </a>
                  <?php
                  elseif(!isset($exerciseName['vidLink'])) :
                    echo h($exerciseName['exercise_name']);
                  endif;
                  ?>
                  </td>
                </tr>
              <?php endwhile; ?>
            </table>
            <?php mysqli_free_result($workoutSteps_set); ?>
          </td>

        </tr>
      </table>

      </div>
     </div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
