<?php require_once('../../../private/initialize.php') ?>
<?php
  $mod_type_set = find_all_mod_types();
?>

<?php $page_title = 'Mod Type'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="mod type listing">
    <h1>Mod Types</h1>
    <div class="actions">
      <a class="action" href="<?= url_for('/staff/mod_types/new.php');?>"> Create New Mod Type</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php while ($mod_type = mysqli_fetch_assoc($mod_type_set)) : ?>
        <tr>
          <td><?= $mod_type['id']?></td>
          <td><?= $mod_type['mod_type']?></td>
          <td><?= $mod_type['description']?></td>
          <td><a class="action" href="<?= url_for('/staff/mod_types/view.php?id=' . h(u($mod_type['id'])));?>">View</a></td>
          <td><a class="action" href="<?= url_for('/staff/mod_types/edit.php?id=' . h(u($mod_type['id'])));?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('/staff/mod_types/delete.php?id=' . h(u($mod_type['id'])));?>">Delete</a></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
