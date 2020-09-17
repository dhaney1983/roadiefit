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
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $exercise_category = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $exercise_category; // returns assoc. array
  }

  function insert_exercise_category($exercise_category) {
    global $db;
    $errors = validate_exercise_category($exercise_category);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "INSERT INTO exercise_categories (exercise_category, description) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $exercise_category['exercise_category']) . "', ";
    $sql .= "'" . db_escape($db, $exercise_category['description']) . "'";
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
    $errors = validate_exercise_category($exercise_category);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "UPDATE exercise_categories SET ";
    $sql .= "exercise_category='" . db_escape($db, $exercise_category['exercise_category']) . "', ";
    $sql .= "description='" . db_escape($db, $exercise_category['description']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $exercise_category['id']) . "'";
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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

  function validate_exercise_category($exercise_category){
    $errors = [];

    // menu_name
    if(is_blank($exercise_category['exercise_category'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($exercise_category['exercise_category'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $exercise_category['id'] ?? '0';
    if(!has_unique_exercise_category_name($exercise_category['exercise_category'], $current_id)){
      $errors[] = "Name must be unique.";
    }

    return $errors;
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $exercise = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $exercise; // returns assoc. array
  }

  function insert_exercise($exercise) {
    global $db;
    $errors = validate_exercise($exercise);
    if (!empty($errors)) {
      return $errors;
    }
    $sql = "INSERT INTO exercises ";
    $sql .= "(exercise_name, category_id, vidLink, instruction) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $exercise['exercise_name']) . "',";
    $sql .= "'" . db_escape($db, $exercise['category_id']) . "',";
    $sql .= "'" . db_escape($db, $exercise['vidLink']) . "',";
    $sql .= "'" . db_escape($db, $exercise['instruction']) . "'";
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
    $errors = validate_exercise($exercise);
    if (!empty($errors)) {
      return $errors;
    }
    $sql = "UPDATE exercises SET ";
    $sql .= "exercise_name='" . db_escape($db, $exercise['exercise_name']) . "', ";
    $sql .= "category_id='" . db_escape($db, $exercise['category_id']) . "', ";
    $sql .= "vidLink='" . db_escape($db, $exercise['vidLink']) . "', ";
    $sql .= "instruction='" . db_escape($db, $exercise['instruction']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $exercise['id']) . "' ";
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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

  function validate_exercise($exercise){
    $errors = [];

    // Exercise
    if(is_blank($exercise['exercise_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($exercise['exercise_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $exercise['id'] ?? '0';
    if(!has_unique_exercise_name($exercise['exercise_name'], $current_id)){
      $errors[] = "Name must be unique.";
    }

    // subject_id
    if(is_blank($exercise['category_id'])) {
      $errors[] = "You must select an exercise category.";
    }

    return $errors;
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    $metric = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $metric;
  }

  function insert_metric($metric) {
    global $db;
    $errors = validate_metric($metric);
    if(!empty($errors)) {
      return $errors;
    }
    $sql = "INSERT INTO metrics ";
    $sql .= "(metric, description) VALUES (";
    $sql .= "'" . db_escape($db, $metric['metric']) . "', ";
    $sql .= "'" . db_escape($db, $metric['description']) . "'";
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
    $errors = validate_metric($metric);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "UPDATE metrics SET ";
    $sql .= "metric='" . db_escape($db, $metric['metric']) . "', ";
    $sql .= "description='" . db_escape($db, $metric['description']) . "' ";
    $sql .= "WHERE id='". db_escape($db, $metric['id']) . "' ";
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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

  function validate_metric($metric){
    $errors = [];

    // menu_name
    if(is_blank($metric['metric'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($metric['metric'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $metric['id'] ?? '0';
    if(!has_unique_subject_menu_name($metric['metric'], $current_id)){
    $errors[]= "Name must be unique.";
    }
    $current_id = $metric['id'] ?? '0';
    if(!has_unique_metric_name($metric['metric'], $current_id)){
      $errors[] = "Name must be unique.";
    }

    return $errors;
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    $mod_type = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $mod_type;
  }

  function update_mod_type($mod_type){
    global $db;
    $errors = validate_mod_type($mod_type);
    if (!empty($errors)) {
      return $errors;
    }
    $sql = "UPDATE mod_types SET ";
    $sql .= "mod_type='" . db_escape($db, $mod_type['mod_type']) . "', ";
    $sql .= "description='" . db_escape($db, $mod_type['description']) . "' ";
    $sql .= "WHERE id='". db_escape($db, $mod_type['id']) . "' ";
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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
    $errors = validate_mod_type($mod_type);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "INSERT INTO mod_types ";
    $sql .= "(mod_type, description) VALUES (";
    $sql .= "'" . db_escape($db, $mod_type['mod_type']) . "', ";
    $sql .= "'" . db_escape($db, $mod_type['description']) . "'";
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

  function validate_mod_type($mod_type){
    $errors = [];

    // menu_name
    if(is_blank($mod_type['mod_type'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($mod_type['mod_type'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $mod_type['id'] ?? '0';
    if(!has_unique_subject_menu_name($mod_type['mod_type'], $current_id)){
    $errors[]= "Name must be unique.";
    }

    return $errors;
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
    $sql .= "WHERE id ='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page;
  }

  function insert_page($page) {
    global $db;
    $errors = validate_page($page);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "INSERT INTO pages ";
    $sql .= "(menu_name, subject_id, position, visible, content) Values (";
    $sql .= "'" . db_escape($db, $page['menu_name']) . "', ";
    $sql .= "'" . db_escape($db, $page['subject_id']) . "', ";
    $sql .= "'" . db_escape($db, $page['position']) . "', ";
    $sql .= "'" . db_escape($db, $page['visible']) . "', ";
    $sql .= "'" . db_escape($db, $page['content']) . "'";
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
    $errors = validate_page($page);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "UPDATE pages SET ";
    $sql .= "menu_name='" . db_escape($db, $page['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db, $page['position']) . "', ";
    $sql .= "visible='" . db_escape($db, $page['visible']) . "', ";
    $sql .= "content='" . db_escape($db, $page['content']) . "', ";
    $sql .= "subject_id='" . db_escape($db, $page['subject_id']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $page['id']) . "'";
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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

  function validate_page($page) {

    $errors = [];

    // menu_name
    if(is_blank($page['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id =$page['id'] ?? '0';
    if(!has_unique_page_menu_name($page['menu_name'], $current_id)){
      $errors[] = "Name must be unique.";
    }

    // subject_id
    if(is_blank($page['subject_id'])) {
      $errors[] = "You must select a page subject.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $page['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    return $errors;
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
  }

  function insert_subject($subject) {
    global $db;
    $errors = validate_subject($subject);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "INSERT INTO subjects (menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $subject['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $subject['position']) . "',";
    $sql .= "'" . db_escape($db, $subject['visible']) . "'";
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
    $errors = validate_subject($subject);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . db_escape($db, $subject['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db, $subject['position']) . "', ";
    $sql .= "visible='" . db_escape($db, $subject['visible']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $subject['id']) . "' ";
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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

  function validate_subject($subject) {

    $errors = [];

    // menu_name
    if(is_blank($subject['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
      $current_id = $subject['id'] ?? '0';
      if(!has_unique_subject_menu_name($subject['menu_name'], $current_id)){
      $errors[]= "Name must be unique.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $subject['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    return $errors;
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    $workout_type = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $workout_type;
  }

  function insert_workout_type($workout_type) {
    global $db;
    $errors = validate_workout_type($workout_type);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "INSERT INTO workout_types ";
    $sql .= "(workout_type, description) VALUES (";
    $sql .= "'" . db_escape($db, $workout_type['workout_type']) . "', ";
    $sql .= "'" . db_escape($db, $workout_type['description']) . "'";
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
    $errors = validate_workout_type($workout_type);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "UPDATE workout_types SET ";
    $sql .= "workout_type='" . db_escape($db, $workout_type['workout_type']) . "', ";
    $sql .= "description='" . db_escape($db, $workout_type['description']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $workout_type['id']) . "' ";
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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

  function validate_workout_type($workout_type) {

        // menu_name
        if(is_blank($workout_type['workout_type'])) {
          $errors[] = "Name cannot be blank.";
        } elseif(!has_length($workout_type['workout_type'], ['min' => 2, 'max' => 255])) {
          $errors[] = "Name must be between 2 and 255 characters.";
        }
        $current_id = $workout_type['id'] ?? '0';
        if(!has_unique_subject_menu_name($workout_type['workout_type'], $current_id)){
        $errors[]= "Name must be unique.";
        }

        return $errors;
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
    $errors = validate_workout($workout);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "INSERT INTO workouts (workout_name, author, metric_id, instructions, weight, stimulus, scales, rounds, workout_time, workout_type_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $workout['workout_name']) . "',";
    $sql .= "'" . db_escape($db, $workout['author']) . "',";
    $sql .= "'" . db_escape($db, $workout['metric_id']) . "',";
    $sql .= "'" . db_escape($db, $workout['instructions']) . "',";
    $sql .= "'" . db_escape($db, $workout['weight']) . "',";
    $sql .= "'" . db_escape($db, $workout['stimulus']) . "',";
    $sql .= "'" . db_escape($db, $workout['scales']) . "',";
    $sql .= "'" . db_escape($db, $workout['rounds']) . "',";
    $sql .= "'" . db_escape($db, $workout['workout_time']) . "',";
    $sql .= "'" . db_escape($db, $workout['workout_type_id']) . "'";
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
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
  }

  function update_workout($workout){
    global $db;
    $errors = validate_workout($workout);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "UPDATE workouts SET ";
    $sql .= "workout_name='" . db_escape($db, $workout['workout_name']) . "',";
    $sql .= "author='" . db_escape($db, $workout['author']) . "',";
    $sql .= "metric_id='" . db_escape($db, $workout['metric_id']) . "',";
    $sql .= "instructions='" . db_escape($db, $workout['instructions']) . "',";
    $sql .= "weight='" . db_escape($db, $workout['weight']) . "',";
    $sql .= "stimulus='" . db_escape($db, $workout['stimulus']) . "',";
    $sql .= "scales='" . db_escape($db, $workout['scales']) . "',";
    $sql .= "workout_time='" . db_escape($db, $workout['workout_time']) . "',";
    $sql .= "rounds='" . db_escape($db, $workout['rounds']) . "',";
    $sql .= "workout_type_id='" .db_escape($db, $workout['workout_type_id']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $workout['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result){
      return true;
    }
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }

  function delete_workout($id){
    global $db;
    $sql = "DELETE FROM workouts ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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

  function validate_workout($workout) {

    $errors = [];

    // workout_name
    if(is_blank($workout['workout_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($workout['workout_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $workout['id'] ?? '0';
    if(!has_unique_workout_name(addslashes($workout['workout_name']), $current_id)){
      $errors[] = "Name must be unique.";
    }

    // workout_type_id
    if(is_blank($workout['workout_type_id'])) {
      $errors[] = "You must select a workout type.";
    }

    return $errors;
  }


  // Workout Mod Functions
  function insert_mod($mod){
    global $db;
    $errors = validate_mod($mod);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "INSERT INTO mods ";
    $sql .= "(mod_order, mod_type_id, workout_id, description) VALUES ( ";
    $sql .= "'" . db_escape($db, $mod['mod_order']) . "', ";
    $sql .= "'" . db_escape($db, $mod['mod_type_id']) . "', ";
    $sql .= "'" . db_escape($db, $mod['workout_id']) . "' , ";
    $sql .= "'" . db_escape($db, $mod['description']) . "'";
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
    $sql .= "description='" . db_escape($db, $mod['description']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $mod['id']) . "' ";
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
      $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
      $result = mysqli_query($db, $sql);
      $mod = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $mod;

    }

    function delete_mod($id){
      global $db;
      $sql = "DELETE FROM mods ";
      $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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
      $sql .= "WHERE workout_id='" . db_escape($db, $workout_id) . "' ";
      $sql .= "ORDER BY mod_order ASC";
      $result = mysqli_query($db, $sql);
      return $result;
      mysqli_free_result($result);
    }

    function validate_mod($mod) {
      $errors = [];
      // mods_order
      if(is_blank($mod['mod_order'])) {
        $errors[] = "You must enter mod order.";
      }
      // mod_type
      if(is_blank($mod['mod_type_id'])) {
        $errors[] = "You must select a mod type.";
      }
      return $errors;
    }
  // Workout Step functions
  function find_workout_step_by_id($id) {
    global $db;
    $sql = "SELECT * FROM workout_steps  ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
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
      $sql .= "WHERE workout_id='" . db_escape($db, $workout_id) . "' ";
      $sql .= "ORDER BY step_order ASC";
      $result = mysqli_query($db, $sql);
      return $result;
      mysqli_free_result($result);
    }

  function find_workout_steps_by_mod ($mod_id){
      global $db;
      $sql = "SELECT * FROM workout_steps ";
      $sql .= "WHERE mod_id='" . db_escape($db, $mod_id) . "' ";
      $sql .= "ORDER BY step_order ASC";
      $result = mysqli_query($db, $sql);
      return $result;
      mysqli_free_result($result);
    }

  function insert_workout_steps($workout_step) {
    global $db;
    $errors = validate_workout_step($workout_step);
    if(!empty($errors)){
      return $errors;
    }
    $sql = "INSERT INTO workout_steps ";
    $sql .= "(step_order, exercise_id, mod_id, reps) VALUES (";
    $sql .= "'" . db_escape($db, $workout_step['step_order']) . "', ";
    $sql .= "'" . db_escape($db, $workout_step['exercise_id']) . "', ";
    $sql .= "'" . db_escape($db, $workout_step['mod_id']) . "', ";
    $sql .= "'" . db_escape($db, $workout_step['reps']) . "'";
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

  function delete_workout_step($id){
    global $db;
    $sql = "DELETE FROM workout_steps ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
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

  function validate_workout_step($workout_step) {
    $errors = [];
    // workout_steps_order
    if(is_blank($workout_step['step_order'])) {
      $errors[] = "You must enter workout_step order.";
    }
    // workout_step_type
    if(is_blank($workout_step['exercise_id'])) {
      $errors[] = "You must select an exercise.";
    }
    return $errors;
  }

 ?>
