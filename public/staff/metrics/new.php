<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {

}
?>

<?php $page_title = 'Create Metric'; ?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/metrics/index.php');?>">&laquo; Back to List</a>
<div class="metric new">
  <h1>Create Metric</h1>

  <form action="<?= url_for('/staff/metrics/create.php'); ?>" method="post">
    <dl>
      <dt>Name</dt>
      <dd><input type="text" name="metric" value="" /></dd>
    </dl>
    <dl>
      <dt>Description</dt>
      <dd><input type="text" name="description" value="" /></dd>
    </dl>

    <div id="operations">
      <input type="submit" value="Create New Metric" />
    </div>
  </form>

</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
