<?php
// exercise category Functions
function find_all_exercise_categories() {
  global $db;
  $sql = "SELECT * FROM exercise_categories ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_exercise_category_by_id($id) {
  global $db;
  $sql = "SELECT * FROM exercise_categories ";
  $sql .= "WHERE id='" . $id . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $exercise_category = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $exercise_category; // returns assoc. array
}

function insert_exercise_category($exercise_category) {
  global $db;
  $sql = "INSERT INTO exercise_categories (exercise_category, description) ";
  $sql .= "VALUES (";
  $sql .= "'" . $exercise_category['exercise_category'] . "', ";
  $sql .= "'" . $exercise_category['description'] . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  }
  echo mysqli_error($db);
  db_disconnect($db);
  exit;
}


// exercises functions
  function find_all_exercises() {
    global $db;
    $sql = "SELECT * FROM exercises ";
    $sql .= "ORDER BY category, exercise_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_exercise_by_id($id) {
    global $db;
    $sql = "SELECT * FROM exercises ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $exercise = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $exercise; // returns assoc. array
  }

  function insert_exercise($exercise) {
    global $db;
    $sql = "INSERT INTO exercises ";
    $sql .= "(exercise_name, category_id, vidLink, instruction) ";
    $sql .= "VALUES (";
    $sql .= "'" . $exercise['exercise_name'] . "',";
    $sql .= "'" . $exercise['category_id'] . "',";
    $sql .= "'" . $exercise['vidLink'] . "',";
    $sql .= "'" . $exercise['instruction'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
// Metric Functions
  function find_all_metrics() {
    global $db;
    $sql = "SELECT * FROM metrics ";
    $sql .= "ORDER BY metric ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_metric_by_id($id) {
    global $db;
    $sql = "SELECT * FROM metrics ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    $metric = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $metric;
  }

  function insert_metric($metric) {
    global $db;
    $sql = "INSERT INTO metrics ";
    $sql .= "(metric, description) VALUES (";
    $sql .= "'" . $metric['metric'] . "', ";
    $sql .= "'" . $metric['description'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    }
    echo mysqli_error($db);
    db_disconnect();
    exit;
  }

// Page functions
  function find_all_pages() {
    global $db;
    $sql = "SELECT * FROM pages ";
    $sql .= "ORDER BY subject_id, position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_page_by_id($id) {
    global $db;
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id ='" . $id . "'";
    $result = mysqli_query($db, $sql);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page;
  }

  function insert_page($page) {
    global $db;
    $sql = "INSERT INTO pages ";
    $sql .= "(menu_name, subject_id, position, visible, content) Values (";
    $sql .= "'" . $page['menu_name'] . "', ";
    $sql .= "'" . $page['subject_id'] . "', ";
    $sql .= "'" . $page['position'] . "', ";
    $sql .= "'" . $page['visible'] . "', ";
    $sql .= "'" . $page['content'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {

      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
// Subject Functions
  function find_all_subjects() {
    global $db;
    $sql = "SELECT * FROM subjects ";
    $sql .= "ORDER BY POSITION ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_subject_by_id($id) {
    global $db;
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
  }

  function insert_subject($subject) {
    global $db;
    $sql = "INSERT INTO subjects (menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . $subject['menu_name'] . "',";
    $sql .= "'" . $subject['position'] . "',";
    $sql .= "'" . $subject['visible'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {

      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_subject($subject) {
    global $db;
    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . $subject['menu_name'] . "', ";
    $sql .= "position='" . $subject['position']. "', ";
    $sql .= "visible='" . $subject['visible'] . "' ";
    $sql .= "WHERE id='" . $subject['id'] . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result){
      return true;
    } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
//Workout functions
  function find_all_workouts() {
    global $db;
    $sql = "SELECT * FROM workouts ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function insert_workout($workout){
    global $db;
    $sql = "INSERT INTO workouts (workout_name, author, metric_id, instructions, stimulus, scales, workout_time, workout_type_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . $workout['workout_name'] . "',";
    $sql .= "'" . $workout['author'] . "',";
    $sql .= "'" . $workout['metric_id'] . "',";
    $sql .= "'" . $workout['instructions'] . "',";
    $sql .= "'" . $workout['stimulus'] . "',";
    $sql .= "'" . $workout['scales'] . "',";
    $sql .= "'" . $workout['workout_time'] . "',";
    $sql .= "'" . $workout['workout_type_id'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result){
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
    }
  }

  function find_workout_by_id($id) {
    global $db;
    $sql = "SELECT * FROM workouts ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
  }

  // Workout Step functions
  function find_all_workout_steps() {
    global $db;
    $sql = "SELECT * FROM workout_steps ";
    $sql .= "ORDER BY step_order ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_workout_steps_by_workout ($workout_id){
      global $db;
      $sql = "SELECT * FROM workout_steps ";
      $sql .= "WHERE workout_id='" . $workout_id . "' ";
      $sql .= "ORDER BY step_order ASC";
      $result = mysqli_query($db, $sql);
      return $result;
      mysqli_free_result($result);
    }

  function insert_workout_steps($workout_step) {
    global $db;
    $sql = "INSERT INTO workout_steps ";
    $sql .= "(step_order, exercise_id, workout_id, reps) VALUES (";
    $sql .= "'" . $workout_step['step_order'] . "', ";
    $sql .= "'" . $workout_step['exercise_id'] . "', ";
    $sql .= "'" . $workout_step['workout_id'] . "', ";
    $sql .= "'" . $workout_step['reps'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    }
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }


  // Workout Type Functions
  function find_all_workout_types() {
    global $db;
    $sql = "SELECT * FROM workout_types ";
    $sql .= "ORDER BY workout_type ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_workout_type_by_id($id) {
    global $db;
    $sql = "SELECT * FROM workout_types ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    $workout_type = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $workout_type;
  }
 ?>
