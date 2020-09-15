<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/mod_types/index.php'));
}

$id = $_GET['id'];

$mod_type = find_mod_type_by_id($id);

if(is_post_request()){
  $result = delete_mod_type($id);
  redirect_to(url_for('/staff/mod_types/index.php'));
} else {
  find_mod_type_by_id($id);
}


$page_title = 'Delete Exercises Category';
include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/mod_types/index.php'); ?>">&laquo; Back to List</a>
  <div class="delete mod_type">
    <h1>DELETE MOD TYPE: <?= h($mod_type['mod_type']); ?></h1>
    <p><strong>Are you sure you want to delete this Mod Type?</strong></p>
    <form action="<?php echo url_for('staff/mod_types/delete.php?id=' . h(u($id)));?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Mod Type" />
      </div>

  </div>

</div>
