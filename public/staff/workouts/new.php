<?php require_once('../../../private/initialize.php');

$test = $_GET['test'] ?? '';
if($test == '404') {
  error404();
} elseif($test == '500'){
  error500();
}elseif($test == 'redirect') {
  redirect_to(url_for('/staff/workouts/index.php'));
}

?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/workouts/index.php');?>">&laquo; Back to List</a>
<div class="metcon new">
  <h1>New Workout</h1>
  <table>
  <tr>
    <td width="460">
      <form action="<?= url_for('/staff/workouts/edit.php?id=' . h(u($id))); ?>" method="post">
        <dl>
          <dt>Workout Name</dt>
          <dd><input type="text" name="workout_name" value="" /></dd>
        </dl>
        <dl>
          <dt>Author</dt>
          <dd><input type="text" name="author" value="" /></dd>
        </dl>
        <dl>
          <dt>Metcon</dt>
          <dd><input type="text" name="fkMetcon" value="" /></dd>
        </dl>
        <dl>
          <dt>Time</dt>
          <dd><input type="text" name="time" value="" /></dd>
        </dl>
        <dl>
          <dt>Instruction</dt>
          <dd><textarea name="instructions" id="comments" cols="30" rows="10"></textarea></dd>
        </dl>
        <dl>
          <dt>Stimulus</dt>
          <dd><textarea name="stimulus" id="comments" cols="30" rows="10"></textarea></dd>
        </dl>
        <dl>
          <dt>Scales</dt>
          <dd><textarea name="scales" id="comments" cols="30" rows="10"></textarea></dd>
        </dl>
        <div id="operations">
          <input type="submit" value="Create Workout" />
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
<?php include(SHARED_PATH . '/staff_footer.php');?>
