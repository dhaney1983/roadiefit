<?php

require_once('../../../private/initialize.php');
// Checks to see if ID is passed, if not user is redirected to subjects index
if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}
// gets id from GET submission
$id = $_GET['id'];

// gets id from GET submission
if(is_post_request()) {

  // Handle form values sent by edit.php
  $page = [];
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['id'] = $id ?? '';
  $result = update_page($page);
  redirect_to(url_for('/staff/pages/view.php?id=' .h(u($id))));

} else {
  $page = find_page_by_id($id);
}

$page_set = find_all_pages();
$page_count = mysqli_num_rows($page_set);
mysqli_free_result($page_set);

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?= url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page edit">
    <h1>Edit Page</h1>

    <form action="<?= url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?= h($page['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Subject</dt>
        <dd>
          <select name="subject_id">
            <?php
            $subject_set = find_all_subjects();
            while ($subject = mysqli_fetch_assoc($subject_set)) {
              echo "<option value=\"" . h($subject['id']) . "\"";
              if ($page['subject_id'] == $subject['id']) {
                echo " selected";
              }
              echo">" . h($subject['menu_name']) . "</option>";
            }
            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              for ($i=1; $i <= $page_count ; $i++) {
                echo "<option value=\"{$i}\"";
                if ($page['position'] == $i ) {
                  echo " selected";
                }
                echo ">{$i}</option>";
              }
            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1"<?php if($page['visible'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content" cols="60" rows="10"><?= h($page['content']) ?></textarea>
        </dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
