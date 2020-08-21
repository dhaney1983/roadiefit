<?php require_once('../../../private/initialize.php');

$metcon = '';
$description = '';

if(is_post_request()) {

  // Handle form values sent by new.php

  $metcon = $_POST['metcon'] ?? '';
  $description = $_POST['description'] ?? '';

  echo "Form parameters<br />";
  echo "Metcon: " . $metcon . "<br />";
  echo "Description: " . $description . "<br />";
}

?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
<a class="back-link" href="<?= url_for('/staff/metcon/index.php');?>">&laquo; Back to List</a>
<div class="metcon new">
  <h1>Create Metcon</h1>

  <form action="<?= url_for('/staff/metcon/new.php'); ?>" method="post">
    <dl>
      <dt>Name</dt>
      <dd><input type="text" name="metcon" value="" /></dd>
    </dl>
    <dl>
      <dt>Description</dt>
      <dd><input type="text" name="description" value="" /></dd>
    </dl>

    <div id="operations">
      <input type="submit" value="Create New Metcon" />
    </div>
  </form>

</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>
