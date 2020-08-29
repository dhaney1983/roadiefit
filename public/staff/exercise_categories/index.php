<?php

require_once('../../../private/initialize.php');

$exercise_categories_set = find_all_exercise_categories();

?>

<?php $page_title = 'Exercise Categories'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="exercise category listing">
    <h1>Exercise Categories</h1>

    <div class="actions">
      <a class="action" href="<?= url_for('/staff/exercise_categories/new.php'); ?>">Create Exercise Category</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Exercise Category</th>
        <th>Description</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while ($exercise_category = mysqli_fetch_assoc($exercise_categories_set)) : ?>
        <tr>
          <td><?= h($exercise_category['id']); ?></td>
          <td><?= h($exercise_category['exercise_category']); ?></td>
    	    <td><?= h($exercise_category['description']); ?></td>
          <td><a class="action" href="<?= url_for('/staff/exercise_categories/view.php?id=' . h(u($exercise_category['id']))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('/staff/exercise_categories/edit.php?id=' . h(u($exercise_category['id']))); ?>">Edit</a></td>
          <td><a class="action" href="">Delete</a></td>
    	  </tr>
      <?php endwhile; ?>
  	</table>

    <?php mysqli_free_result($exercise_categories_set); ?>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
