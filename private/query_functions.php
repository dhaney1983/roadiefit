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

// Metcon Functions
  function find_all_metcons(){
    global $db;
    $sql = "SELECT * FROM metcon ";
    $sql .= "ORDER BY metcon ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
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
// Subject Functions
  function find_all_subjects(){
    global $db;
    $sql = "SELECT * FROM subjects ";
    $sql .= "ORDER BY POSITION ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
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

 ?>
