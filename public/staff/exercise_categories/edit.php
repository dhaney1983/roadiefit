<?php require_once('../../../private/initialize.php');

if(!isset($_GET['id'])){
  redirect_to(url_for('/staff/exercise_categories/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {
  $exercise_category = [];
    $exercise_category['exercise_category'] = $_POST['exercise_category'] ?? '';
    $exercise_category['description'] = $_POST['description'] ?? '';
    $exercise_category['id'] = $id ?? '';
  $result = update_exercise_category($exercise_category);
  redirect_to(url_for('/staff/exercise_categories/view.php?id=' . $id));

} else {

  $exercise_category = find_exercise_category_by_id($id);

}

?>
<?php $page_title = 'Edit Exercise Category'; ?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/exercise_categories/index.php');?>">&laquo; Back to List</a>
<div class="workout type new">
  <h1>Edit Exercise Category</h1>

  <form action="<?= url_for('/staff/exercise_categories/edit.php?id=' . h(u($id))); ?>" method="post">
    <dl>
      <dt>Name</dt>
      <dd><input type="text" name="exercise_category" value="<?= $exercise_category['exercise_category']; ?>" /></dd>
    </dl>
    <dl>
      <dt>Description</dt>
      <dd><input type="text" name="description" value="<?= $exercise_category['description']; ?>" /></dd>
    </dl>

    <div id="operations">
      <input type="submit" value="Edit Exercise Category" />
    </div>
  </form>

</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
