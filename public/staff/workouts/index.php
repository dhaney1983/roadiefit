<?php require_once('../../../private/initialize.php'); ?>
<?php $workouts =[
    ['id' => '1', 'workout_name' => "Lunge Jump and burp", 'author' => 'Mike McConatha', 'fkMetcon' => '1', 'instructions' => 'At 3…2…1…Go! You will start on the 20 walking lunges. After that you will perform 15 box jumps and then, 10 burpees. That’s one round.Your score will be the amount of rounds and reps completed when the 15 minutes expires.',
      'stimulus' => 'The intended stimulus for this workout is a pushed tempo. Start slow and find a pace that requires minimal breaks and do work. These are big movements so sprinting or close to it could lead to redlining and we’re not going for that today. ', 'scales' => 'These are pretty much do anywhere movements besides the Box Jumps. BJs can be some with many different things. As long as its not more that 24” high you’re gettin the correct stimulus. ',
      'time' => "00:15:00"],
      ['id' => '2', 'workout_name' => "Lunge Jump and burp", 'author' => 'Mike McConatha', 'fkMetcon' => '1', 'instructions' => 'At 3…2…1…Go! You will start on the 20 walking lunges. After that you will perform 15 box jumps and then, 10 burpees. That’s one round.Your score will be the amount of rounds and reps completed when the 15 minutes expires.',
        'stimulus' => 'The intended stimulus for this workout is a pushed tempo. Start slow and find a pace that requires minimal breaks and do work. These are big movements so sprinting or close to it could lead to redlining and we’re not going for that today. ', 'scales' => 'These are pretty much do anywhere movements besides the Box Jumps. BJs can be some with many different things. As long as its not more that 24” high you’re gettin the correct stimulus. ',
        'time' => "00:15:00"] ];
?>
<?php $page_title = "Workouts" ?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">
  <div class="exercise listing">
    <h1>Workouts</h1>
    <div class="actions">
      <a class="action" href="new.php"> Create New Workout</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Author</th>
        <th>Metcon</th>
        <th>Time</th>
        <th>Instructions</th>
        <th>Stimulus</th>
        <th>Scales</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php foreach ($workouts as $workout): ?>
        <tr>
          <td><?php echo h($workout['id'])?></td>
          <td><?php echo h($workout['workout_name'])?></td>
          <td><?php echo h($workout['author'])?></td>
          <td><?php echo h($workout['fkMetcon'])?></td>
          <td><?php echo h($workout['time'])?></td>
          <td><?php echo h($workout['instructions'])?></td>
          <td><?php echo h($workout['stimulus'])?></td>
          <td><?php echo h($workout['scales'])?></td>
          <td><a class="action" href="<?= url_for('/staff/workouts/view.php?id=' . h(u($workout['id'])));?>"</a>View</td>
          <td>Edit</td>
          <td>Delete</td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
