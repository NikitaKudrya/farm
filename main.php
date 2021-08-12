<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Ферма</title>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	</head>

	<body>
    <div class="work_area">
    <h1>Ферма</h1>
    <form action="add.php" method="post">
      <input type="text" name="animal_id" id="animal_id" placeholder="Идентификатор животного" class="form-control">
	    <br>
	    <input type="text" name="animal_name" id="animal_name" placeholder="Имя животного" class="form-control">
	    <br>
      <select name="animal_type" id="animal_type" class="form-control">
      <option value="Cow">Корова</option>
      <option value="Chicken">Курица</option>
      </select>
      <br>
      <button type="submit" value="workers" name="sendButton" class="btn btn-success">Добавить</button>
    </form>
    <div class="box">
      <?php
        ini_set('display_errors', 1);

        class Cow
        {
            protected int $cow_id;
            public string $cow_name;

            public function getCowId() {
                return $this->cow_id;
            }

            public function getMilk() {
                return random_int(8, 12);
            }

            public function __construct(int $cow_id, string $cow_name) {
                $this->cow_id = $cow_id;
                $this->cow_name = $cow_name;
            }
        }



        $file = file_get_contents('./коровы.txt', false);
        $string = explode(";", $file);

        $cows = array();

        foreach ($string as $key => $value) {
          $cowParams = explode(" ", $value);
          $id = $cowParams[0];
          $name = $cowParams[1];
          $unique = true;
          foreach ($cows as $k => $v) {
            // echo $v->getCowId()." $id //";
            if($v->getCowId() == $id){
              $unique = false;
              $length = strlen($id) + strlen($name) + 2;
              $substr = substr($file, 0, -$length);
              file_put_contents("коровы.txt", $substr);
              echo '<script>
                     alert("Корова с идентификатором '.$id.' уже существует.");
                      window.location.href="main.php";
                    </script>';
            }
          }
          if($unique){
            $cows[$key] = new Cow($id, $name);
          }
        }

        echo '<table class="animal_table">';
        echo '
          <tr>
          <th>Идентификатор коровы</th>
          <th>Имя коровы</th>
          <th>Количество литров за надой</th>
          </tr>';
        $milk_sum = 0;
        foreach ($cows as $key => $value) {
          $milk = $value->getMilk();
          echo "<tr><td>".$value->getCowId()."</td><td>".$value->cow_name."</td><td>".$milk."</td></tr>";
          $milk_sum += $milk;
        }
        echo "</table><b>Общее количество собранного молока (л.): $milk_sum</b>";
       ?>
     </div>
     <div class="box">
       <?php
         class Chicken
         {
             protected int $chicken_id;
             public string $chicken_name;

             public function getChickenId() {
                 return $this->chicken_id;
             }

             public function getEgg() {
                 return random_int(0, 1);
             }

             public function __construct(int $chicken_id, string $chicken_name) {
                 $this->chicken_id = $chicken_id;
                 $this->chicken_name = $chicken_name;
             }
         }

         $file = file_get_contents('./курицы.txt', false);
         $string = explode(";", $file);

         $chickens = array();

         foreach ($string as $key => $value) {
           $chickenParams = explode(" ", $value);
           $id = $chickenParams[0];
           $name = $chickenParams[1];
           $unique = true;
           foreach ($chickens as $k => $v) {
             if($v->getChickenId() == $id){
               $unique = false;
               $length = strlen($id) + strlen($name) + 2;
               $substr = substr($file, 0, -$length);
               file_put_contents("курицы.txt", $substr);
               echo '<script>
                   		alert("Курица с идентификатором '.$id.' уже существует.");
                       window.location.href="main.php";
                     </script>';
             }
           }
           if($unique){
             $chickens[$key] = new Chicken($id, $name);
           }
         }

         echo '<table class="animal_table">';
         echo '
           <tr>
           <th>Идентификатор курицы</th>
           <th>Имя курицы</th>
           <th>Количество яиц за кладку</th>
           </tr>';
         $egg_sum = 0;
         foreach ($chickens as $key => $value) {
           $egg = $value->getEgg();
           echo "<tr><td>".$value->getChickenId()."</td><td>".$value->chicken_name."</td><td>".$egg."</td></tr>";
           $egg_sum += $egg;
         }
         echo "</table><b>Общее количество собранных яиц (шт.): $egg_sum</b>";
       ?>
     </div>
     </div>
	</body>

</html>
