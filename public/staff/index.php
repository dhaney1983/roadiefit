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
          <li><a href="<?= url_for('staff/metcon/index.php'); ?>">Metcon</a></li>
        </ul>
      </div>

    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
