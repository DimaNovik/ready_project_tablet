<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Реєстрація контролера. Контрольные обходы</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap-grid-3.3.1.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/main.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <![endif]-->

</head>

<body>

<div class="container">

    <div class="row position-login-form">
        <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">

        </div>

        <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6 reg">

            <form id="slick-login" class="slick-login" action="" method="post">

                <p>
                  <label for="pib">ПІБ нового конролера:</label>
                </p>
                <input type="text" name="pib" id="pib" placeholder="Введіть Ваш ПІБ (Іванов І.І)">
                <p>
                  <label for="password">Код контролера:</label>
                </p>
                <input type="number" name="num" id="num" placeholder="Введіть Ваш код">
                <p align="center"><input type="submit" id="submit" name="submit" value="Зареєструвати"></p>
            </form>
            <?
                $jsonString = file_get_contents("json/users.json");
                $decod = iconv("WINDOWS-1251", "UTF-8", $jsonString);
                $data = json_decode($decod, true);

              if(isset($_POST['submit'])) {
                $name = $_POST['pib'];
                $num = $_POST['num'];
                $message[] = "";

                
                // проверяем количество єлементов в массиве
                $count = count($data['clerks_data']);

                foreach ($data as $key => $value) {
                
                  foreach ($value as $key2 => $value2) {

                  if($value2['clerk_name'] !== $name) {         
                    $data[$key][$count]['clerk_id']=$num;
                    $data[$key][$count]['clerk_name']=$name;
                    $data[$key][$count]['tabno']=$num;

                    $message = "<p style='font-size:18px; color:green;' align='center'>Користувач зареєстрован!</p>";
                  }  else {
                    $message .= "Користувач вже існує в системі!";
                    exit();
                  }
                  } 

                }

                if ($message != '') {
                  echo $message;
                }                 
              }

            //кодируем заново json файл
            $newJsonString = json_encode($data);
            //добавляю данные в json массив
            file_put_contents("json/users.json", $newJsonString);

            mkdir("json/".$num);
         
            ?>
            <br/>
            <p align="center"><a href="index.php" style="text-transform: uppercase;"><b>На головну</b></a></p>
        </div>

    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
    </div>
  </div>
</div>
<!-- /.container -->
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bs.js"></script>
</body>
</html>
