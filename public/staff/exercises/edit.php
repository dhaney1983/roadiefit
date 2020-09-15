<?php require_once('../../../private/initialize.php');

if(!isset($_GET['id'])){
  redirect_to(url_for('/staff/exercises/index.php'));
}

$id = $_GET['id'];


if (is_post_request()) {
  $exercise =  [''];
  $exercise['category_id'] = $_POST['category_id'] ?? '';
  $exercise['exercise_name'] = $_POST['exercise_name'] ?? '';
  $exercise['instruction'] = $_POST['instruction'] ?? '';
  $exercise['vidLink'] = $_POST['vidLink'] ?? '';
  $exercise['id'] = $id;
$result = update_exercise($exercise);
redirect_to(url_for('/staff/exercises/view.php?id=' . h(u($id))));


} else {
  $exercise = find_exercise_by_id($id);
}

?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/exercises/index.php'); ?>">&laquo; Back to List</a>
  <div class="exercise edit">
    <h1>Edit Exercise</h1>
    <form action="<?= url_for('/staff/exercises/edit.php?id=' . h(u($id)));?>" method="post">
      <dl>
        <dt>Exercise Name</dt>
        <dd><input type="text" name="exercise_name" value="<?= h($exercise['exercise_name']); ?>"></dd>
      </dl>

      <dl>
        <dt>Category</dt>
        <dd><select name="category_id">
          <option value="">
          <?php
          $exercise_category_set = find_all_exercise_categories();
            while ($exercise_category = mysqli_fetch_assoc($exercise_category_set)) {
              echo "<option value=\"" . h($exercise_category['id']) . "\"";
              if ($exercise['category_id'] == $exercise_category['id']) {
                echo " selected";
              }
              echo ">" . h($exercise_category['exercise_category']) . "</option>";
            }
          ?>
        </select>
        </dd>
      </dl>

      <dl>
        <dt>Video Link</dt>
        <dd><input type="text" name="vidLink" value="<?= h($exercise['vidLink']); ?>"></dd>
      </dl>

      <dl>
        <dt>Instructions</dt>
        <dd><textarea name="instruction" id="comments" cols="30" rows="20"><?= h($exercise['instruction']); ?></textarea></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Exercise" />
      </div>
  </form>
  </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
