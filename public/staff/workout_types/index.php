<?php

require_once('../../../private/initialize.php');

$workout_type_set = find_all_workout_types();

?>

<?php $page_title = 'Workout Types'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="workout type listing">
    <h1>Workout Types</h1>

    <div class="actions">
      <a class="action" href="<?= url_for('/staff/workout_types/new.php'); ?>">Create New Workout Type</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Workout Type</th>
        <th>Description</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while ($workout_type = mysqli_fetch_assoc($workout_type_set)) : ?>
        <tr>
          <td><?= h($workout_type['id']); ?></td>
          <td><?= h($workout_type['workout_type']); ?></td>
    	    <td><?= h($workout_type['description']); ?></td>
          <td><a class="action" href="<?= url_for('/staff/workout_types/view.php?id=' . h(u($workout_type['id']))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('/staff/workout_types/edit.php?id=' . h(u($workout_type['id']))); ?>">Edit</a></td>
          <td><a class="action" href="">Delete</a></td>
    	  </tr>
      <?php endwhile; ?>
  	</table>

    <?php mysqli_free_result($workout_type_set); ?>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
