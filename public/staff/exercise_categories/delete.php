<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/exercise_categories/index.php'));
}

$id = $_GET['id'];

$exercise_categories = find_exercise_category_by_id($id);

if(is_post_request()){
  $result = delete_exercise_categories($id);
  redirect_to(url_for('/staff/exercise_categories/index.php'));
} else {
  find_exercise_category_by_id($id);
}


$page_title = 'Delete Exercise Category';
include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/exercise_categories/index.php'); ?>">&laquo; Back to List</a>
  <div class="delete exercise categories">
    <h1>DELETE SUBJECT: <?= h($exercise_categories['exercise_category']); ?></h1>
    <p><strong>Are you sure you want to delete this exercise category?</strong></p>
    <form action="<?php echo url_for('staff/exercise_categories/delete.php?id=' . h(u($id)));?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Exercise Category" />
      </div>

  </div>

</div>
