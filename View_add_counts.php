   <?php
error_reporting( E_ERROR );

 $fio = $_GET['fio'];
 $adres = $_GET['adres'];
 $num_lich = $_GET['num_lich'];
 $conno = $_GET['conno'];
 $zones = $_GET['zones'];
 $type = $_GET['type'];
 $file = $_GET['file'];
 $abid = $_GET['abid'];
 $clerk_name = $_GET['clerkname'];
 $clerkid = $_GET['clerkid'];

 //$error = [];
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="info_card_add">
                    <p>
                        <img src="img/user.png" />
                    </p>

                    <p align="right"><b><? echo $fio ?></b></p>
                    <p align="right"><b><? echo $adres ?></b></p>
                    <p align="right"><b>Ос. рахунок:</b> <? echo $conno ?></p>
                    <p align="right"><b>№ лічильн., розр., пл.:</b> <? echo $num_lich ?></p>
                    <p align="right"><b>Тип лічильника:</b> <? echo $type ?> <b>Зона:</b> <? echo $zones ?></p>
                </div>

            </div>
        </div>
    </div>
<!-- ./container for info_card -->


<div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="list_tasks">Додати показники:<hr/></h2>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

          <form id="add_count" action="#" method="post">
              <p align='left'><label for="visibility1">Не виконано:</label>
              <input type="checkbox" name="visibility" id="visibility1" /></p>


                  <select name="list_warning" id="list_warning" class="placeholder">
                    <option value="0">Оберіть зі списку...</option>
                      <option value="1">Абонент не відчинив</option>
                      <option value="2">Абонент відсутній</option>
                      <option value="3">Лічильник відсутній</option>
                      <option value="21">Абонент раніше відключений</option>
                      <option value="22">Виконано відключення</option>
                      <option value="23">Виконано підключення</option>
                      <option value="24">Самовільне підкл. після відкл.</option>
                      <option value="25">Підозра на крадіжку</option>
                  </select>

              <br/>


              <?
              //открываем json файл и определяем количество цифр на счетчике по полю в массиве.
               $jsonString = file_get_contents("json/".$clerkid."/$file.json");
             
              // $decod = iconv("WINDOWS-1251", "UTF-8", $jsonString);
              $data_json = json_decode($jsonString, true);


              foreach ($data_json as $key_dig => $entry_dig) {

                foreach ($entry_dig as $key2_dig => $value2_dig) {

                  foreach ($value2_dig as $key3_dig => $value3_dig) {

                    //проверяем, есть ли в массиве abonentid
                    if ($value3_dig['abid'] == $abid) {

                    $digitsAll = $value3_dig['digits'];
                    // присваиваем показания, если такие уже были занесены
                    $val = $value3_dig['value_1'];
                    $val2 = $value3_dig['value_2'];
                    $val3 = $value3_dig['value_3'];
                    $dateValue = $value3_dig['datevalue'];

                
                    if($dateValue) {
                      echo "<p><label for='date_count' id='label_date'>Дата зняття показників:</label></br>";
                      echo "<input type='date' name='date_count' id='date_count' value=".date('Y-m-d', strtotime($dateValue))." disabled></p>";
                    } else {
                      echo "<p><label for='date_count' id='label_date'>Дата зняття показників:</label></br>";
                      echo "<input type='date' name='date_count' id='date_count' value=".date('Y-m-d')." disabled></p>";
                    }

                    //проверяем, сколько нужно подставить максимальное количесво цифр в input
                    switch ($digitsAll) {
                      case '4':
                          $digits = '9999';
                          break;
                      case '5':
                          $digits = '99999';
                          break;
                      case '6':
                          $digits = '999999';
                          break;
                      case '7':
                          $digits = '9999999';
                          break;
                      case '8':
                          $digits = '99999999';
                          break;
                      case '9':
                          $digits = '999999999';
                          break;
                      case '10':
                          $digits = '9999999999';
                          break;
                      case '11':
                          $digits = '999999999999';
                          break;
                      case '12':
                          $digits = '999999999999';
                          break;
                      }

                    }
                    else {
                      $error = 'Абонент не найден. Количество digits не задано';

                    }
                  }
                }
              }

               // $EndFindDigits = json_encode($data_json);

                //проверяем, сколько необходимо выводить полей для шкал
                if($zones == 1) {
              
          
                  echo "<p><label for='count_zone_1' id='label_zone_1'>Шкала 1:</label></br>
                  <input type='number' name='count_zone_1' id='count_zone_1' value=$val max=$digits  placeholder='Максимальна кількість символів: $digitsAll'>
                  </p>";
                }

                if($zones == 2) {
                  echo "
                  <p><label for='count_zone_2' id='label_zone_2'>Шкала 1: (ніч)</label></br>
                  <input type='number' name='count_zone_2' id='count_zone_2' value=$val2 max=$digits  placeholder='Максимальна кількість символів: $digitsAll'></p>
                  <p><label for='count_zone_1' id='label_zone_1'>Шкала 2: (напівпік)</label></br>
                  <input type='number' name='count_zone_1' id='count_zone_1' value=$val max=$digits  placeholder='Максимальна кількість символів: $digitsAll'></p>
                  ";
                }

                if($zones == 3) {
                  echo "
                  <p><label for='count_zone_3' id='label_zone_3'>Шкала 1: (ніч)</label></br>
                  <input type='number' name='count_zone_3' id='count_zone_3' value=$val3 max=$digits  placeholder='Максимальна кількість символів: $digitsAll'></p>
                    <p><label for='count_zone_2' id='label_zone_2'>Шкала 2: (напівпік)</label></br>
                  <input type='number' name='count_zone_2' id='count_zone_2' value=$val2 max=$digits  placeholder='Максимальна кількість символів: $digitsAll'></p>
                  <p><label for='count_zone_1' id='label_zone_1'>Шкала 3: (пік)</label></br>
                  <input type='number' name='count_zone_1' id='count_zone_1' value=$val max=$digits  placeholder='Максимальна кількість символів: $digitsAll'></p>
                
                  ";
                }
              ?>

              <br/>
              <p><label for="visibility2" id="label_visibility2">Попереджений:</label>
              <input type="checkbox" name="warned" id="visibility2" value="1"/></p>


              <p align="center"><input type="submit" id="submit" name='submit' value="ЗАНЕСТИ ПОКАЗНИКИ"></p>

          </form>

          <?
            if(isset($_POST['submit'])) {



              //присваиваем значения принятые из формы
              $count1 = $_POST['count_zone_1'];

                if($count1 == '') {$count1 = ""; $resultCode = 2;}

              $count2 = $_POST['count_zone_2'];

                if($count2 == '') {$count2 = ""; $resultCode = 2;}

              $count3 = $_POST['count_zone_3'];

                if($count3 == '') {$count3 = ""; $resultCode = 2;}



              $resultCode = $_POST['list_warning'];
              $clerkid = $_GET['clerkid'];
              $warned = $_POST['warned'];
              $datevalue = $_POST['date_count'];
              $datevalue =  date("d.m.Y", strtotime($datevalue));

              // если случайно внесені показания и выбрана галочка "не выполнено", то показания очищаются
              if($resultCode <> 0) {
                $count1 = '';
                $count2 = '';
                $count3 = '';
              }

                if($_POST['date_count'] == '') {
                  date_default_timezone_set('Europe/Kiev');
                  $datevalue = date("d.m.Y");

                }

              $jsonString = file_get_contents("json/".$clerkid."/$file.json");
             // $decod = iconv("WINDOWS-1251", "UTF-8", $jsonString);
              $data = json_decode( $jsonString, true);

              foreach ($data as $key => $entry) {

                foreach ($entry as $key2 => $value2) {

                  foreach ($value2 as $key3 => $value3) {

                    //проверяем, есть ли в массиве abonentid
                    if ($value3['abid'] == $abid) {

                      if ($warned == '') {
                        $warned = '0';
                      }

                      $data[$key][$key2][$key3]['value_1']=$count1;
                      $data[$key][$key2][$key3]['value_2']=$count2;
                      $data[$key][$key2][$key3]['value_3']=$count3;
                      $data[$key][$key2][$key3]['flag']='1';
                      $data[$key][$key2][$key3]['resultcode']=$resultCode;
                      $data[$key][$key2][$key3]['warned']=$warned;
                      $data[$key][$key2][$key3]['datevalue']=$datevalue;

                    }
                    else {
                        $error .= 'Абонент не знайден. Спробуйте ще раз';
                    }
                  }
                }
              }

            //кодируем заново json файл
            $newJsonString = json_encode($data);

             fclose("load_tasks/".$clerkid."/".$file.".json");
            

            $fileWrite = fopen("json/".$clerkid."/".$file.".json", "w");
            
            ftruncate($fileWrite, 0); 

            $test = fwrite($fileWrite, $newJsonString); 

            if ($test) echo 'Данные в файл успешно занесены.';
            else echo 'Ошибка при записи в файл.';

            //fwrite($fileWrite, $newJsonString);

            fclose($fileWrite);
      
            //добавляю данные в json массив
           
            //file_put_contents("json/".$clerkid."/$file.json", $newJsonString);
            //перенаправляем страницу назад к списку
            echo "<script> location.replace('View_abonents_tasks.php?name_tasks=$file&clerkid=$clerkid&clerkname=$clerk_name'); </script>";

            if ($error != '') {
               // echo $error;
            }


            }
          ?>

        </div>
    </div>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bs.js"></script>

<!-- ShowHide WarningList -->
<script src="js/showWarningList.js"></script>





</body>

</html>
