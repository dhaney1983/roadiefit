<?php require_once('../../../private/initialize.php') ?>
  <?php $metcons = [
    ['id' => '1', 'metcon' => 'AMRAP', 'description' => 'As Many Rounds As Possible'],
    ['id' => '1', 'metcon' => 'For Time', 'description' => 'For Time']
  ];
?>

<?php $page_title = 'Exercises'; ?>
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
      <?php foreach ($metcons as $metcon): ?>
        <tr>
          <td><?= $metcon['id']?></td>
          <td><?= $metcon['metcon']?></td>
          <td><?= $metcon['description']?></td>
          <td><a class="action" href="<?= url_for('/staff/metcon/view.php?id=' . h(u($metcon['id'])));?>">View</a></td>
          <td><a class="action" href="<?= url_for('/staff/metcon/edit.php?id=' . h(u($metcon['id'])));?>">Edit</a></td>
          <td>Delete</td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
  </body>
</html>
