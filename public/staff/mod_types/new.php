<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {
  $mod_type = [];
  $mod_type['mod_type'] = $_POST['mod_type'];
  $mod_type['description'] = $_POST['description'];
  $result = insert_mod_type($mod_type);
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('/staff/mod_types/view.php?id=' . $new_id));

  } else {

}
?>

<?php $page_title = 'Create Mod Type'; ?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/mod_types/index.php');?>">&laquo; Back to List</a>
<div class="mod type new">
  <h1>Create Mod Type</h1>

  <form action="<?= url_for('/staff/mod_types/new.php'); ?>" method="post">
    <dl>
      <dt>Name</dt>
      <dd><input type="text" name="mod_type" value="" /></dd>
    </dl>
    <dl>
      <dt>Description</dt>
      <dd><input type="text" name="description" value="" /></dd>
    </dl>

    <div id="operations">
      <input type="submit" value="Create New Mod Type" />
    </div>
  </form>

</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
