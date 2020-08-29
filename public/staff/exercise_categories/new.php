<?php require_once('../../../private/initialize.php');

if(is_post_request()) {

}

?>
<?php $page_title = 'Create Exercise Category'; ?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/exercise_categories/index.php');?>">&laquo; Back to List</a>
<div class="workout type new">
  <h1>Create Exercise Category</h1>

  <form action="<?= url_for('/staff/exercise_categories/create.php'); ?>" method="post">
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
