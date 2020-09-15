<?php
// exercise category Functions
  function find_all_exercise_categories() {
    global $db;
    $sql = "SELECT * FROM exercise_categories ";
    $sql .= "ORDER BY exercise_category ASC";
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
    $sql .= "'" . addslashes($exercise_category['exercise_category']) . "', ";
    $sql .= "'" . addslashes($exercise_category['description']) . "'";
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

  function update_exercise_category($exercise_category){
    global $db;
    $sql = "UPDATE exercise_categories SET ";
    $sql .= "exercise_category='" . addslashes($exercise_category['exercise_category']) . "', ";
    $sql .= "description='" . addslashes($exercise_category['description']) . "' ";
    $sql .= "WHERE id='" . $exercise_category['id'] . "'";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_exercise_categories($id){
    global $db;
    $sql = "DELETE FROM exercise_categories ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}
// exercises functions
  function find_all_exercises() {
    global $db;
    $sql = "SELECT * FROM exercises ";
    $sql .= "ORDER BY category_id, exercise_name ASC";
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
    $sql .= "'" . addslashes($exercise['exercise_name']) . "',";
    $sql .= "'" . $exercise['category_id'] . "',";
    $sql .= "'" . $exercise['vidLink'] . "',";
    $sql .= "'" . addslashes($exercise['instruction']) . "'";
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

  function update_exercise($exercise) {
    global $db;
    $sql = "UPDATE exercises SET ";
    $sql .= "exercise_name='" . addslashes($exercise['exercise_name']) . "', ";
    $sql .= "category_id='" . $exercise['category_id'] . "', ";
    $sql .= "vidLink='" . $exercise['vidLink'] . "', ";
    $sql .= "instruction='" . addslashes($exercise['instruction']) . "' ";
    $sql .= "WHERE id='" . $exercise['id'] . "' ";
    $sql .= "LIMIT 1";
    // echo $sql;
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_exercise($id) {
    global $db;
    $sql = "DELETE FROM exercises ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if ($result) {
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
    $sql .= "'" . addslashes($metric['metric']) . "', ";
    $sql .= "'" . addslashes($metric['description']) . "'";
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

  function update_metric($metric){
    global $db;
    $sql = "UPDATE metrics SET ";
    $sql .= "metric='" . addslashes($metric['metric']) . "', ";
    $sql .= "description='" . addslashes($metric['description']) . "' ";
    $sql .= "WHERE id='". $metric['id'] . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    }
    echo mysqli_error($db);
    db_disconnect($db);
    // echo $sql;
    exit;
  }

  function delete_metric($id){
    global $db;
    $sql = "DELETE FROM metrics ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

// Mod Type Functions

function find_all_mod_types(){
  global $db;
  $sql = "SELECT * FROM mod_types ";
  $sql .= "ORDER BY mod_type ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_mod_type_by_id($id) {
  global $db;
  $sql = "SELECT * FROM mod_types ";
  $sql .= "WHERE id='" . $id . "'";
  $result = mysqli_query($db, $sql);
  $mod_type = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $mod_type;
}

function update_mod_type($mod_type){
  global $db;
  $sql = "UPDATE mod_types SET ";
  $sql .= "mod_type='" . addslashes($mod_type['mod_type']) . "', ";
  $sql .= "description='" . addslashes($mod_type['description']) . "' ";
  $sql .= "WHERE id='". $mod_type['id'] . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  if($result) {
    return true;
  } else {
  echo mysqli_error($db);
  db_disconnect($db);
  // echo $sql;
  exit;
  }
}

function delete_mod_type($id){
  global $db;
  $sql = "DELETE FROM mod_types ";
  $sql .= "WHERE id='" . $id . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function insert_mod_type($mod_type) {
  global $db;
  $sql = "INSERT INTO mod_types ";
  $sql .= "(mod_type, description) VALUES (";
  $sql .= "'" . addslashes($mod_type['mod_type']) . "', ";
  $sql .= "'" . addslashes($mod_type['description']) . "'";
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
    $sql .= "'" . addslashes($page['menu_name']) . "', ";
    $sql .= "'" . $page['subject_id'] . "', ";
    $sql .= "'" . $page['position'] . "', ";
    $sql .= "'" . $page['visible'] . "', ";
    $sql .= "'" . addslashes($page['content']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result){
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_page($page) {
    global $db;
    $sql = "UPDATE pages SET ";
    $sql .= "menu_name='" . addslashes($page['menu_name']) . "', ";
    $sql .= "position='" . $page['position'] . "', ";
    $sql .= "visible='" . $page['visible'] . "', ";
    $sql .= "content='" . addslashes($page['content']) . "', ";
    $sql .= "subject_id='" . $page['subject_id'] . "' ";
    $sql .= "WHERE id='" . $page['id'] . "'";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_page($id){
    global $db;
    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result){
      return true;
    } else {
      echo mysqli_error($db, $sql);
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
    $sql .= "'" . addslashes($subject['menu_name']) . "',";
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
    $sql .= "menu_name='" . addslashes($subject['menu_name']) . "', ";
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

  function delete_subject($id){
    global $db;
    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if ($result) {
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
    $sql = "INSERT INTO workouts (workout_name, author, metric_id, instructions, weight, stimulus, scales, rounds, workout_time, workout_type_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . addslashes($workout['workout_name']) . "',";
    $sql .= "'" . addslashes($workout['author']) . "',";
    $sql .= "'" .$workout['metric_id'] . "',";
    $sql .= "'" . addslashes($workout['instructions']) . "',";
    $sql .= "'" . addslashes($workout['weight']) . "',";
    $sql .= "'" . addslashes($workout['stimulus']) . "',";
    $sql .= "'" . addslashes($workout['scales']) . "',";
    $sql .= "'" . addslashes($workout['rounds']) . "',";
    $sql .= "'" . $workout['workout_time'] . "',";
    $sql .= "'" . $workout['workout_type_id'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result){
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
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

  function update_workout($workout){
    global $db;
    $sql = "UPDATE workouts SET ";
    $sql .= "workout_name='" . addslashes($workout['workout_name']) . "',";
    $sql .= "author='" . addslashes($workout['author']) . "',";
    $sql .= "metric_id='" . $workout['metric_id'] . "',";
    $sql .= "instructions='" . addslashes($workout['instructions']) . "',";
    $sql .= "weight='" . addslashes($workout['weight']) . "',";
    $sql .= "stimulus='" . addslashes($workout['stimulus']) . "',";
    $sql .= "scales='" . addslashes($workout['scales']) . "',";
    $sql .= "workout_time='" . $workout['workout_time'] . "',";
    $sql .= "rounds='" . $workout['rounds'] . "',";
    $sql .= "workout_type_id='" . $workout['workout_type_id'] . "' ";
    $sql .= "WHERE id='" . $workout['id'] . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result){
      return true;
    }
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }

  function delete_workout_and_steps($id){
    global $db;
    $sql = "DELETE FROM workouts ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
    }
  }

  // Workout Mod Functions

  function insert_mod($mod){
    global $db;
    $sql = "INSERT INTO mods ";
    $sql .= "(mod_order, mod_type_id, workout_id, description) VALUES ( ";
    $sql .= "'" . $mod['mod_order'] . "', ";
    $sql .= "'" . $mod['mod_type_id'] . "', ";
    $sql .= "'" . $mod['workout_id'] . "' , ";
    $sql .= "'" . addslashes($mod['description']) . "'";
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

  function update_mod($mod){
    global $db;
    $sql = "UPDATE mods SET ";
    $sql .= "description='" . addslashes($mod['description']) . "' ";
    $sql .= "WHERE id='" . $mod['id'] . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result){
      return true;
    }
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }

  function find_mod_by_id ($id){
      global $db;
      $sql = "SELECT * FROM mods ";
      $sql .= "WHERE id='" . $id . "' ";
      $result = mysqli_query($db, $sql);
      $mod = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $mod;

    }

    function delete_mod($id){
      global $db;
      $sql = "DELETE FROM mods ";
      $sql .= "WHERE id='" . $id . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      if ($result) {
        return true;
      } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
      }
    }

  function find_workout_mod_by_workout ($workout_id){
      global $db;
      $sql = "SELECT * FROM mods ";
      $sql .= "WHERE workout_id='" . $workout_id . "' ";
      $sql .= "ORDER BY mod_order ASC";
      $result = mysqli_query($db, $sql);
      return $result;
      mysqli_free_result($result);
    }

  // Workout Step functions
  function find_workout_step_by_id($id) {
    global $db;
    $sql = "SELECT * FROM workout_steps  ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    $workout_step = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $workout_step;
  }


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

  function find_workout_steps_by_mod ($mod_id){
      global $db;
      $sql = "SELECT * FROM workout_steps ";
      $sql .= "WHERE mod_id='" . $mod_id . "' ";
      $sql .= "ORDER BY step_order ASC";
      $result = mysqli_query($db, $sql);
      return $result;
      mysqli_free_result($result);
    }

  function insert_workout_steps($workout_step) {
    global $db;
    $sql = "INSERT INTO workout_steps ";
    $sql .= "(step_order, exercise_id, mod_id, reps) VALUES (";
    $sql .= "'" . $workout_step['step_order'] . "', ";
    $sql .= "'" . $workout_step['exercise_id'] . "', ";
    $sql .= "'" . $workout_step['mod_id'] . "', ";
    $sql .= "'" . $workout_step['reps'] . "'";
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

  function delete_related_workout_steps($foreignKey){
    global $db;
    $sql = "DELETE FROM workout_steps ";
    $sql .= "WHERE workout_id='" . $foreignKey . "'";
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_workout_step($id){
    global $db;
    $sql = "DELETE FROM workout_steps ";
    $sql .= "WHERE id='" . $id . "'";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
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

  function insert_workout_type($workout_type) {
    global $db;
    $sql = "INSERT INTO workout_types ";
    $sql .= "(workout_type, description) VALUES (";
    $sql .= "'" . addslashes($workout_type['workout_type']) . "', ";
    $sql .= "'" . addslashes($workout_type['description']) . "'";
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

  function update_workout_type($workout_type){
    global $db;
    $sql = "UPDATE workout_types SET ";
    $sql .= "workout_type='" . addslashes($workout_type['workout_type']) . "', ";
    $sql .= "description='" . addslashes($workout_type['description']) . "' ";
    $sql .= "WHERE id='" . $workout_type['id'] . "' ";
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

  function delete_workout_type($id){
    global $db;
    $sql = "DELETE FROM workout_types ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if ($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

 ?>
