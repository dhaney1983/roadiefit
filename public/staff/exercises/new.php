<?php

require_once('../../../private/initialize.php');

if (is_post_request()) {

} else {

}


?>
<?php $page_title = 'Create Exercise'; ?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/exercises/index.php');?>">&laquo; Back to List</a>
  <div class="exercise new">
    <h1>Create Exercise</h1>
    <form action="<?= url_for('/staff/exercises/create.php');?>" method="post">
      <dl>
        <dt>Exercise Name</dt>
        <dd><input type="text" name="exercise_name" value""></dd>
      </dl>

      <dl>
        <dt>Category</dt>
        <dd><select name="category_id">
          <?php
            $catagories_set = find_all_exercise_categories();

            while ($category = mysqli_fetch_assoc($catagories_set)) {
              echo "<option value=\"" . h($category['id']) . "\">" . $category['exercise_category'] . "</option>";
            }?>
        </select>
        <?php mysqli_free_result($catagories_set);?>
      </dd>
      </dl>

      <dl>
        <dt>Video Link</dt>
        <dd><input type="text" name="vidLink" value""></dd>
      </dl>

      <dl>
        <dt>Instructions</dt>
        <dd><textarea name="instruction" id="comments" cols="30" rows="20"></textarea></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Submit New Exercise" />
      </div>
  </form>
  </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
