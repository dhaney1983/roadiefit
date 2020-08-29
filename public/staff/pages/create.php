<?php
require_once('../../../private/initialize.php');

if(is_post_request()){
    $subjectID = $_POST['subject_id'];
    $position = $_POST['position'];
    $visible = $_POST['visible'];
    $menu_name = $_POST['menu_name'];
    $content = $_POST['content'];
    $result = insert_page($menu_name, $subjectID, $position, $visible, $content);
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/staff/pages/view.php?id=' . $new_id));
} else {
  redirect_to(url_for('/staff/pages/new.php'));
}
 ?>
