<?php

  // is_blank('abcd')
  // * validate data presence
  // * uses trim() so empty spaces don't count
  // * uses === to avoid false positives
  // * better than empty() which considers "0" to be empty
  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

  // has_presence('abcd')
  // * validate data presence
  // * reverse of is_blank()
  // * I prefer validation names with "has_"
  function has_presence($value) {
    return !is_blank($value);
  }

  // has_length_greater_than('abcd', 3)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  // has_length_less_than('abcd', 5)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  // has_length_exactly('abcd', 4)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  // * validate string length
  // * combines functions_greater_than, _less_than, _exactly
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'])) {
      return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'])) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_inclusion_of( 5, [1,3,5,7,9] )
  // * validate inclusion in a set
  function has_inclusion_of($value, $set) {
  	return in_array($value, $set);
  }

  // has_exclusion_of( 5, [1,3,5,7,9] )
  // * validate exclusion from a set
  function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
  }

  // has_string('nobody@nowhere.com', '.com')
  // * validate inclusion of character(s)
  // * strpos returns string start position or false
  // * uses !== to prevent position 0 from being considered false
  // * strpos is faster than preg_match()
  function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
  }

  // has_valid_email_format('nobody@nowhere.com')
  // * validate correct format for email addresses
  // * format: [chars]@[chars].[2+ letters]
  // * preg_match is helpful, uses a regular expression
  //    returns 1 for a match, 0 for no match
  //    http://php.net/manual/en/function.preg-match.php
  function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
  }

  // has_unique_page_menu_name('History')
  // * Validates uniqueness of pages.menu_name
  // * For new records, provide only the menu_name.
  // * For existing records, provide current ID as second arugment
  //   has_unique_page_menu_name('History', 4)
  function has_unique_page_menu_name($menu_name, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE menu_name='" . $menu_name . "' ";
    $sql .= "AND id != '" . $current_id . "'";

    $page_set = mysqli_query($db, $sql);
    $page_count = mysqli_num_rows($page_set);
    mysqli_free_result($page_set);

    return $page_count === 0;
  }

  // has_unique_subject_menu_name('History')
  // * Validates uniqueness of subjects.menu_name
  // * For new records, provide only the menu_name.
  // * For existing records, provide current ID as second arugment
  //   has_unique_subject_menu_name('History', 4)
  function has_unique_subject_menu_name($menu_name, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE menu_name='" . $menu_name . "' ";
    $sql .= "AND id != '" . $current_id . "'";

    $subject_set = mysqli_query($db, $sql);
    $subject_count = mysqli_num_rows($subject_set);
    mysqli_free_result($subject_set);

    return $subject_count === 0;
  }

  // has_unique_exercise_category_name('History')
  // * Validates uniqueness of exercise_category_categories.menu_name
  // * For new records, provide only the exercise_category (name)
  // * For existing records, provide current ID as second arugment
  //   has_unique_subject_menu_name('History', 4)
  function has_unique_exercise_category_name($exercise_category, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM exercise_categories ";
    $sql .= "WHERE exercise_category='" . $exercise_category . "' ";
    $sql .= "AND id != '" . $current_id . "'";

    $exercise_category_set = mysqli_query($db, $sql);
    $exercise_category_count = mysqli_num_rows($exercise_category_set);
    mysqli_free_result($exercise_category_set);

    return $exercise_category_count === 0;
  }

  // has_unique_exercise_name('History')
  // * Validates uniqueness of exercises.menu_name
  // * For new records, provide only the exercise (name)
  // * For existing records, provide current ID as second arugment
  //   has_unique_subject_menu_name('History', 4)
  function has_unique_exercise_name($exercise, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM exercises ";
    $sql .= "WHERE exercise_name='" . $exercise . "' ";
    $sql .= "AND id != '" . $current_id . "'";

    $exercise_set = mysqli_query($db, $sql);
    $exercise_count = mysqli_num_rows($exercise_set);
    mysqli_free_result($exercise_set);

    return $exercise_count === 0;
  }

  // has_unique_metric('History')
  // * Validates uniqueness of metrics.menu_name
  // * For new records, provide only the metric (name)
  // * For existing records, provide current ID as second arugment
  //   has_unique_subject_menu_name('History', 4)
  function has_unique_metric_name($metric, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM metrics ";
    $sql .= "WHERE metric='" . $metric . "' ";
    $sql .= "AND id != '" . $current_id . "'";

    $metric_set = mysqli_query($db, $sql);
    $metric_count = mysqli_num_rows($metric_set);
    mysqli_free_result($metric_set);

    return $metric_count === 0;
  }

  // has_unique_mod_type('History')
  // * Validates uniqueness of mod_types.menu_name
  // * For new records, provide only the mod_type (name)
  // * For existing records, provide current ID as second arugment
  //   has_unique_subject_menu_name('History', 4)
  function has_unique_mod_type_name($mod_type, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM mod_types ";
    $sql .= "WHERE mod_type='" . $mod_type . "' ";
    $sql .= "AND id != '" . $current_id . "'";

    $mod_type_set = mysqli_query($db, $sql);
    $mod_type_count = mysqli_num_rows($mod_type_set);
    mysqli_free_result($mod_type_set);

    return $mod_type_count === 0;
  }


// has_unique_workout_type('History')
// * Validates uniqueness of workout_types.menu_name
// * For new records, provide only the workout_type (name)
// * For existing records, provide current ID as second arugment
//   has_unique_subject_menu_name('History', 4)
function has_unique_workout_type_name($workout_type, $current_id="0") {
  global $db;

  $sql = "SELECT * FROM workout_types ";
  $sql .= "WHERE workout_type='" . $workout_type . "' ";
  $sql .= "AND id != '" . $current_id . "'";

  $workout_type_set = mysqli_query($db, $sql);
  $workout_type_count = mysqli_num_rows($workout_type_set);
  mysqli_free_result($workout_type_set);

  return $workout_type_count === 0;
}

// has_unique_workout('History')
// * Validates uniqueness of workouts.menu_name
// * For new records, provide only the workout (name)
// * For existing records, provide current ID as second arugment
//   has_unique_subject_menu_name('History', 4)
function has_unique_workout_name($workout, $current_id="0") {
  global $db;

  $sql = "SELECT * FROM workouts ";
  $sql .= "WHERE workout_name='" . $workout . "' ";
  $sql .= "AND id != '" . $current_id . "'";

  $workout_set = mysqli_query($db, $sql);
  $workout_count = mysqli_num_rows($workout_set);
  mysqli_free_result($workout_set);

  return $workout_count === 0;
}
?>
