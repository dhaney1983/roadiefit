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
          <td width="460" align="left" valign="top">
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
                <dd><?php if (!$workout['metric_id'] == 6): ?>
                  <?php echo h($metric['metric']);
                  else :
                    echo $workout['rounds'] . ' ' . $metric['metric'];
                  ?>
                <?php endif; ?></dd>
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
                <dt>Weight</dt>
                <dd><?= h($workout['weight']); ?></dd>
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
            <?php
              $mod_set = find_workout_mod_by_workout($id);
              while ($mod = mysqli_fetch_assoc($mod_set)) :
            ?>
            <!-- Exercise Steps Table -->
            <table border="2" align="left" valign="top" class="list">
              <tr>
                <!-- Header -->
                <th colspan="4">
                  <?php
                    $mod_type = find_mod_type_by_id($mod['mod_type_id']);
                    echo $mod_type['mod_type'];
                  ?>
                </th>
              </tr>
              <tr>
                <th width="75">Order</th>
                <th>Exercise</th>
                <th>Reps</th>
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
                  echo "</tr>";
                }
               ?>
            </table>&nbsp;<?php endwhile; ?>
          </td>
        </tr>
      </table>
      </div>
     </div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
