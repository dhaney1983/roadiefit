<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php

  $metric = [];
  $metric['id'] = $id;
  $metric['metric'] = $_POST['metric'] ?? '';
  $metric['description'] = $_POST['description'] ?? '';
  $result = update_metric($metric);
  if($result === true){
    redirect_to(url_for('staff/metrics/view.php?id=' . h(u($id))));
  } else {
    $errors = $result;
  }

} else {
  $metric = find_metric_by_id($id);
}

?>

<?php $page_title = 'Edit Metric'; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/metrics/index.php'); ?>">&laquo; Back to List</a>

  <div class="page edit">
    <h1>Edit Metric</h1>
    <?= display_errors($errors); ?>
    <form action="<?= url_for('/staff/metrics/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Name</dt>
        <dd><input type="text" name="metric" value="<?= h($metric['metric']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><input type="text" name="description" value="<?= h($metric['description']); ?>" /></dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Edit Metric" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
