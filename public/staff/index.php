<?php require_once('../../private/initialize.php') ?>

<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="content">

      <div id="main-menu">
        <h2>Main Menu</h2>
        <h3>Website</h3>
        <ul>
          <li><a href="<?= url_for('staff/pages/index.php'); ?>">Pages</a></li>
          <li><a href="<?= url_for('staff/subjects/index.php'); ?>">Subjects</a></li>
        </ul>
        <h3>Workouts and Exercises</h3>
        <ul>
          <li><a href="<?= url_for('staff/workouts/index.php'); ?>">Workouts</a></li>
          <li><a href="<?= url_for('staff/exercises/index.php'); ?>">Exercises</a></li>
        </ul>
        <h3>Other</h3>
          <ul>
            <li><a href="<?= url_for('staff/exercise_categories/index.php'); ?>">Exercise Categories</a></li>
            <li><a href="<?= url_for('staff/metrics/index.php'); ?>">Workout Metrics</a></li>
            <li><a href="<?= url_for('staff/mod_types/index.php'); ?>">Workout Mod Types</a></li>
            <li><a href="<?= url_for('staff/workout_types/index.php'); ?>">Workout Types</a></li>
          </ul>
      </div>

    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
