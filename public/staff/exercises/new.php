<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {

  $exercise = [];
  $exercise['exercise_name'] = $_POST['exercise_name'];
  $exercise['category_id'] = $_POST['category_id'];
  $exercise['vidLink'] = $_POST['vidLink'];
  $exercise['instruction'] = $_POST['instruction'];

  $result = insert_exercise($exercise);
  if($result === true){
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/staff/exercises/view.php?id=' . $new_id));
  } else {
    $errors = $result;
    // var_dump($errors);
  }

} else {
  $exercise['exercise_name'] = '';
  $exercise['category_id'] = '';
  $exercise['vidLink'] = '';
  $exercise['instruction'] = '';
}
?>
<?php $page_title = 'Create Exercise'; ?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/exercises/index.php');?>">&laquo; Back to List</a>
  <div class="exercise new">
    <h1>Create Exercise</h1>
    <?= display_errors($errors); ?>
    <form action="<?= url_for('/staff/exercises/new.php');?>" method="post">
      <dl>
        <dt>Exercise Name</dt>
        <dd><input type="text" name="exercise_name" value="<?= $exercise['exercise_name']?>"></dd>
      </dl>

      <dl>
        <dt>Category</dt>
        <dd><select name="category_id">
          <option value="">
          <?php
            $catagories_set = find_all_exercise_categories();
            while ($category = mysqli_fetch_assoc($catagories_set)) {
              echo "<option value=\"" . h($category['id']) . "\"";
              if ($exercise['category_id'] == $category['id']) {
                echo " selected";
              }
              echo">" . h($category['exercise_category']) . "</option>";
            }?>
        </select>
        <?php mysqli_free_result($catagories_set);?>
      </dd>
      </dl>

      <dl>
        <dt>Video Link</dt>
        <dd><input type="text" name="vidLink" value="<?= $exercise['vidLink'] ?>"></dd>
      </dl>

      <dl>
        <dt>Instructions</dt>
        <dd><textarea name="instruction" id="comments" cols="30" rows="20"><?= $exercise['instruction'] ?></textarea></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Submit New Exercise" />
      </div>
  </form>
  </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
