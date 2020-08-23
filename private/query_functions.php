<?php
// exercises functions
  function find_all_exercises(){
    global $db;
    $sql = "SELECT * FROM exercises ";
    $sql .= "ORDER BY category, exercise_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_exercise_by_id($id){
    global $db;
    $sql = "SELECT * FROM exercises ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $exercise = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $exercise; // returns assoc. array
  }
// Metcon Functions
  function find_all_metcons(){
    global $db;
    $sql = "SELECT * FROM metcon ";
    $sql .= "ORDER BY metcon ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_metcon_by_id($id){
    global $db;
    $sql = "SELECT * FROM metcon ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    $metcon = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $metcon;
  }

// Page functions
  function find_all_pages(){
    global $db;
    $sql = "SELECT * FROM pages ";
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_page_by_id($id){
    global $db;
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id ='" . $id . "'";
    $result = mysqli_query($db, $sql);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page;
  }

// Subject Functions
  function find_all_subjects(){
    global $db;
    $sql = "SELECT * FROM subjects ";
    $sql .= "ORDER BY POSITION ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_subject_by_id($id){
    global $db;
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
  }

//Workout functions
  function find_all_workouts(){
    global $db;
    $sql = "SELECT * FROM workouts ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_workout_by_id($id){
    global $db;
    $sql = "SELECT * FROM workouts ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
  }

  function find_all_workoutSteps($foreignKey){
    global $db;
    $sql = "SELECT * FROM workoutSteps ";
    $sql .= "WHERE _fkWorkout='" . $foreignKey . "' ";
    $sql .= "ORDER BY stepOrder ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;


  }

 ?>
