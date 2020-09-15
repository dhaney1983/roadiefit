<?php require_once('../../../private/initialize.php');

if(is_post_request()) {
  $exercise_category = [];
  $exercise_category['exercise_category'] = $_POST['exercise_category'];
  $exercise_category['description'] = $_POST['description'];
  $result = insert_exercise_category($exercise_category);
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('/staff/exercise_categories/view.php?id=' . $new_id));

}

?>
<?php $page_title = 'Create Exercise Category'; ?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/exercise_categories/index.php');?>">&laquo; Back to List</a>
<div class="workout type new">
  <h1>Create Exercise Category</h1>

  <form action="<?= url_for('/staff/exercise_categories/new.php'); ?>" method="post">
    <dl>
      <dt>Name</dt>
      <dd><input type="text" name="exercise_category" value="" /></dd>
    </dl>
    <dl>
      <dt>Description</dt>
      <dd><input type="text" name="description" value="" /></dd>
    </dl>

    <div id="operations">
      <input type="submit" value="Create New Exercise Category" />
    </div>
  </form>

</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
