<?php

require_once('../../../private/initialize.php');

$metric = '';
$description = '';

if(is_post_request()) {

  // Handle form values sent by new.php

  $metric = $_POST['metric'] ?? '';
  $description = $_POST['description'] ?? '';

  echo "Form parameters<br />";
  echo "Metric: " . $metric . "<br />";
  echo "Description: " . $description . "<br />";
}

?>

<?php $page_title = 'Edit Metric'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/metrics/index.php'); ?>">&laquo; Back to List</a>

  <div class="page edit">
    <h1>Edit Metric</h1>

    <form action="<?= url_for('/staff/metric/edit.php'); ?>" method="post">
      <dl>
        <dt>Name</dt>
        <dd><input type="text" name="metric" value="<?=h($metric)?>" /></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><input type="text" name="description" value="<?= h($description) ?>" /></dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Update Metric" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
