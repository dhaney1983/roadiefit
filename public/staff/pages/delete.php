<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];

$page = find_page_by_id($id);

if(is_post_request()){
  $result = delete_page($id);
  redirect_to(url_for('/staff/pages/index.php'));
} else {
  find_page_by_id($id);
}


$page_title = 'Delete Exercises Category';
include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>
  <div class="delete page">
    <h1>DELETE PAGE: <?= h($page['menu_name']); ?></h1>
    <p><strong>Are you sure you want to delete this page?</strong></p>
    <form action="<?php echo url_for('staff/pages/delete.php?id=' . h(u($id)));?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Page" />
      </div>

  </div>

</div>
