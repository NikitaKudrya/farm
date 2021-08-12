<?php
  $animal_type = $_POST['animal_type'];
  $animal_id = $_POST['animal_id'];
  $animal_name = $_POST['animal_name'];
  if($animal_id != null & $animal_name != null){
    switch ($animal_type) {
      case "Cow":
        $file = 'коровы.txt';
        $current = file_get_contents($file);
        $current .= ";$animal_id $animal_name";
        file_put_contents($file, $current);
        break;
      case "Chicken":
        $file = 'курицы.txt';
        $current = file_get_contents($file);
        $current .= ";$animal_id $animal_name";
        file_put_contents($file, $current);
        break;
    }
  }
  header('Location: main.php');
 ?>
