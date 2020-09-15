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
