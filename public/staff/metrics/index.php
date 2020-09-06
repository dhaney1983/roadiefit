<?php require_once('../../../private/initialize.php') ?>
<?php
  $metric_set = find_all_metrics();
?>

<?php $page_title = 'Metric'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="exercise listing">
    <h1>Metric Descriptions</h1>
    <div class="actions">
      <a class="action" href="<?= url_for('/staff/metrics/new.php');?>"> Create New Metric</a>
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
      <?php while ($metric = mysqli_fetch_assoc($metric_set)) : ?>
        <tr>
          <td><?= $metric['id']?></td>
          <td><?= $metric['metric']?></td>
          <td><?= $metric['description']?></td>
          <td><a class="action" href="<?= url_for('/staff/metrics/view.php?id=' . h(u($metric['id'])));?>">View</a></td>
          <td><a class="action" href="<?= url_for('/staff/metrics/edit.php?id=' . h(u($metric['id'])));?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('/staff/metrics/delete.php?id=' . h(u($metric['id'])));?>">Delete</a></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
  </body>
</html>
