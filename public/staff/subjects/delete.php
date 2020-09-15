<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/subjects/index.php'));
}

$id = $_GET['id'];

$subject = find_subject_by_id($id);

if(is_post_request()){
  $result = delete_subject($id);
  redirect_to(url_for('/staff/subjects/index.php'));
} else {
  find_subject_by_id($id);
}


$page_title = 'Delete Subject';
include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>
  <div class="view subject">
    <h1>DELETE SUBJECT: <?= h($subject['menu_name']); ?></h1>
    <p><strong>Are you sure you want to delete this subject?</strong></p>
    <form action="<?php echo url_for('staff/subjects/delete.php?id=' . h(u($id)));?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Subject" />
      </div>

  </div>

</div>
