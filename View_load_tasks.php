<?php
if(isset($_POST['submit'])) {
        $clerkid = $_POST['clerkname'];
        $password = $_POST['password'];
        $secret_word = "admin".$clerkid;


          //валидация полей
          if ($password == $secret_word) {

            $jsondata = file_get_contents("json/users.json");
            $json = json_decode($jsondata);

            // выборка определенного пользователя по парамметрам
              foreach($json->clerks_data as $item)
              {
                  if($item->clerk_id == $clerkid)
                  {
                      $clerk_name =  $item->clerk_name;
                      $rem = $item->rem;
                  }
              }
          } else {
           header('Location: index.php');
          }
        } else {
          $clerkid = $_GET['clerk'];
          $clerk_name = $_GET['clerkname'];
        }
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Контрольные обходы</title>

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

<!-- container for info_card -->
    <div class="container">
        <div class="row">
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">

            </div>

            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">

                <div class="info_card">
                    <p>
                        <img src="img/user.png" />
                    </p>

                    <p align="right"><b>Доброго дня, <? echo $clerk_name;?></b></p>
                    <p align="right"><b>Сьогодні:</b> <? date_default_timezone_set('Europe/Kiev'); echo date('d.m.Y'); ?></p>
                </div>

            </div>
        </div>
    </div>
<!-- ./container for info_card -->


<div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="list_tasks">Список завдань:<hr/></h2>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">

        </div>

        <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6">

            <form id="load_tasks" action="View_abonents_tasks.php" method="post">
              <p><label for="name_tasks" id="label_date">Оберіть завдання:</label></br>

                <?php
                //Сканируем папку с json файлами для загрузки в select
                      $lengthId = strlen($clerkid);


                      $files = scandir('json/'.$clerkid);

                      $output = "<select name='name_tasks' class='placeholder'>";

                        foreach ($files as $file) {

                          $subfile = substr($file, 0, strrpos($file, '.' ));
                          $clerk_file =  substr(  $subfile,-$lengthId);


                          if ($file != '.' && $file != '..' && $clerk_file == $clerkid) {
                            $output .= "<option value='".$subfile."'>".$subfile."</option>";
                          } else {
                            
                          }

                        }

                      $output .= "</select> <br/>";

                      //проверяю, есть ли файл для выбранного контролера

                      echo $output;

                ?>

                <input type='hidden' value='<? echo $rem?>' name='rem' id='rem'>
                <input type='hidden' value='<? echo $clerk_name?>' name='nameClerk' id='nameClerk'>
                <input type='hidden' value='<? echo $clerkid?>' name='clerkid' id='clerkid'>
                <p align="center"><input type="submit" id="submit_load" name='submit_load' value="Перейти до виконання"></p>
            </form>

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
