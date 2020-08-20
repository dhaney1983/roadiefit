<?php require_once('../../../private/initialize.php');

$test = $_GET['test'] ?? '';
if($test == '404') {
  error404();
} elseif($test == '500'){
  error500();
}elseif($test == 'redirect') {
  redirect_to(url_for('/staff/exercises/index.php'));
}

?>
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
        <dd><input type="text" name="category" value""></dd>
      </dl>

      <dl>
        <dt>Video Link</dt>
        <dd><input type="text" name="vidLink" value""></dd>
      </dl>

      <dl>
        <dt>Instructions</dt>
        <dd><textarea name="instructions" id="comments" cols="30" rows="20"></textarea></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Submit New Exercise" />
      </div>
  </form>
  </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
