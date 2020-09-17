<?php

require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$subject = find_subject_by_id($id);
$page_title = 'Show Subject';

include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>
  <div class="view subject">
    <h1>Subject: <?= $subject['menu_name']; ?></h1>
    <div class="attributes">
      <dl>
        <dt>ID</dt>
        <dd><?= $subject['id'];?></dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><?= $subject['menu_name'];?> </dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?= $subject['position'];?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
    </div>

  </div>

</div>
