<?php require_once('../../../private/initialize.php') ?>
<?php
  $metcon_set = find_all_metcons();
?>

<?php $page_title = 'Metcon'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="exercise listing">
    <h1>Metcon Descriptions</h1>
    <div class="actions">
      <a class="action" href="<?= url_for('/staff/metcon/new.php');?>"> Create New Exercise</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Desctiption</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php while ($metcon = mysqli_fetch_assoc($metcon_set)) : ?>
        <tr>
          <td><?= $metcon['id']?></td>
          <td><?= $metcon['metcon']?></td>
          <td><?= $metcon['description']?></td>
          <td><a class="action" href="<?= url_for('/staff/metcon/view.php?id=' . h(u($metcon['id'])));?>">View</a></td>
          <td><a class="action" href="<?= url_for('/staff/metcon/edit.php?id=' . h(u($metcon['id'])));?>">Edit</a></td>
          <td>Delete</td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
  </body>
</html>
