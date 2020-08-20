<?php require_once('../../../private/initialize.php');

if(!isset($_GET['id'])){
  redirect_to(url_for('/staff/exercises/index.php'));
}

$id = $_GET['id'];
$exercise_name = '';
$category = '';
$instruction = '';
$vidLink = '';

if (is_post_request()) {
  $exercise_name = $_POST['exercise_name'] ?? '';
  $category = $_POST['category'] ?? '';
  $instruction = $_POST['instructions'] ?? '';
  $vidLink = $_POST['vidLink'] ?? '';

  echo 'Form Parameters<br />';
  echo 'Exercise Name: ' . $exercise_name . '<br />';
  echo 'Category: ' . $category . '<br />';
  echo 'vidLink: ' . $vidLink . '<br />';
  echo 'Instruction: ' . $instruction . '<br />';
}

?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/exercises/edit.php?id=' . h(u($id)));?>">&laquo; Back to List</a>
  <div class="exercise edit">
    <h1>Edit Exercise</h1>
    <form action="<?= url_for('/staff/exercises/edit.php?id=' . h(u($id)));?>" method="post">
      <dl>
        <dt>Exercise Name</dt>
        <dd><input type="text" name="exercise_name" value="<?= $exercise_name; ?>"></dd>
      </dl>

      <dl>
        <dt>Category</dt>
        <dd><input type="text" name="category" value="<?= $category; ?>"></dd>
      </dl>

      <dl>
        <dt>Video Link</dt>
        <dd><input type="text" name="vidLink" value="<?= $vidLink; ?>"></dd>
      </dl>

      <dl>
        <dt>Instructions</dt>
        <dd><textarea name="instructions" id="comments" cols="30" rows="20"><?= $instruction; ?></textarea></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Exercise" />
      </div>
  </form>
  </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
