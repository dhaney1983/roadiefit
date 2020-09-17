<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/mod_types/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php

  $mod_type = [];
  $mod_type['id'] = $id;
  $mod_type['mod_type'] = $_POST['mod_type'] ?? '';
  $mod_type['description'] = $_POST['description'] ?? '';
  $result = update_mod_type($mod_type);
  if ($result === true) {
    redirect_to(url_for('/staff/mod_types/view.php?id=' . h(u($id))));
  } else {
    $errors = $result;
  }

} else {
  $mod_type = find_mod_type_by_id($id);
}

?>

<?php $page_title = 'Edit Mod Type'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/mod_types/index.php'); ?>">&laquo; Back to List</a>

  <div class="page edit">
    <h1>Edit Mod Type</h1>
    <?= display_errors($errors); ?>
    <form action="<?= url_for('/staff/mod_types/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Name</dt>
        <dd><input type="text" name="mod_type" value="<?= h($mod_type['mod_type']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><input type="text" name="description" value="<?= h($mod_type['description']); ?>" /></dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Edit Mod Type Type" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
