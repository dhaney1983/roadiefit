<?php
require_once('../../../private/initialize.php');
$id = $_GET['id'] ?? '1'; // PHP > 7.0
$page = find_page_by_id($id);


?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>
  <div class="view pages">
    <h1>Page: <?= $page['menu_name']; ?></h1>
    <div class="attributes">
      <?php $subject = find_subject_by_id($page['subject_id']);?>
      <dl>
        <dt>Subject</dt>
        <dd><?= $subject['menu_name'];?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?= $page['position'];?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?= $page['visible'];?></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd><?= $page['content'];?></dd>
      </dl>
    </div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
