<?php



$name_file = $_GET['name_tasks'];
$clerk_name = $_GET['clerkname'];
$clerkid = $_GET['clerk'];

//переменная для рефреша после добавления значений и возвращению к списку

//преобразуем дату в нужній формат, для образения к json файлу

// обращаемся к нужному json файлу

  //$nameFile = iconv("WINDOWS-1251", "UTF-8", $name_file);
  $jsondata = file_get_contents("json/".$clerkid."/$name_file.json");



//$f = iconv("WINDOWS-1251", "UTF-8", $jsondata);
$json = json_decode($jsondata , true);

$count_abon = 0;

if($json == '') { $count_abon = 0; } else {

  foreach($json as $item)
  {

    $number = $item['number'];
    $date_task = $item['date'];

  if($item['number'] == $item['number'])
  {


    foreach($item['abonents'] as $abonent) {

      if($abonent['flag'] == 1) {$count_abon++;}

    }
  }
}

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

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="info_card_abonents">
                    <p>
                        <? echo "<a href='/View_load_tasks.php?clerk=$clerkid&clerkname=$clerk_name'><img src='img/user.png' class='list_tasks_img' /></a>"; ?>
                        <?  ?>
                        <? if($name_file) {
                          echo "<a href='/View_abonents_tasks.php?name_tasks=$name_file&clerkid=$clerkid&clerkname=$clerk_name'><img src='img/list.png' class='list_tasks_img' /></a>";
                          echo "<a href='/View_added_tasks.php?name_tasks=$name_file&clerkid=$clerkid&clerkname=$clerk_name'><img src='img/regadded.png' class='list_tasks_img' /></a>";}
                          else {
                            echo "<a href='/View_abonents_tasks.php?name_tasks=$name_file_get&clerk=$clerkid&clerkname=$clerk_name'><img src='img/list.png' class='list_tasks_img' /></a>";
                            echo "<a href='/View_added_tasks.php?name_tasks=$name_file_get&clerk=$clerkid&clerkname=$clerk_name'><img src='img/regadded.png' class='list_tasks_img' /></a>";
                          }
                         ?>
                    </p>

                    <p align="right"><b>Доброго дня, <? echo $clerk_name?></b></p>
                    <p align="right"><b>№ завдання:</b> <? echo $number;?></p>
                    <p align="right"><b>Дата формування:</b> <? echo  $date_task;?></p>
                    <p align="right"><b>Кількість абонентів:</b> <span class="count_tasks"><? echo $count_abon; ?></span>

                    </p>


                </div>

            </div>
        </div>
    </div>
<!-- ./container for info_card -->


<div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <h2 class="list_tasks">Редагування показників. Перелік абонентів:<hr/></h2>
              <input type="text" placeholder="Пошук абонента: адреса, особистий рахунок, ПІБ" style="width:50%;margin:0px 0 30px 0;padding: 15px 15px; border-radius: 5px; border:none;" class="search"><button style="border:none;background-color: Transparent;"><img src='img/search.png'/></button>
            <hr/>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <p class="notFind"></p>
                    <?php

                    if($count_abon == 0) {
                      echo "<h3>Завдання закінчено! Абонентів для обходу немає. </h3>";
                    } else {
                      $output = "<div class='all_tasks_added'>";
                      $output .= "<ul>";


                      foreach($json as $item)
                      {
                          if($item['number'] == $item['number'])
                          {

                            foreach($item['abonents'] as $abonent) {

                              if($abonent['flag'] == 1) {

                              // подготавливаем переменные для передачи к странице добавления показаний
                            $conno=$abonent['conno'];
                            $fio=$abonent['fio'];
                            $adres=$abonent['adres'];
                            $zones=$abonent['zones'];
                            $num_lich=$abonent['num_lich'];
                            $type=$abonent['type'];
                            $abonid=$abonent['abid'];

                            if ($name_file_get == '') {
                              $output .= "<a href='/View_add_counts.php?conno=$conno&fio=$fio&adres=$adres&zones=$zones&num_lich=$num_lich&type=$type&file=$name_file&abid=$abonid&clerkid=$clerkid&clerkname=$clerk_name'><div class='link_tasks_abonents'>";
                            } else {
                              $output .= "<a href='/View_add_counts.php?conno=$conno&fio=$fio&adres=$adres&zones=$zones&num_lich=$num_lich&type=$type&file=$name_file_get&abid=$abonid&clerkid=$clerkid&clerkname=$clerk_name'><div class='link_tasks_abonents'>";
                            }

                            $output .= "<li><b>Ос. рахунок:</b> ".$abonent['conno']." </li>";
                            $output .= "<li><b>ПІБ споживача:</b> ".$abonent['fio']."</li>";
                            $output .= "<li><b>Адреса споживача:</b> ".$abonent['adres']."</li>";
                            $output .= "<li><b>Зона:</b> ".$abonent['zones']."</li>";
                            $output .= "<li class='cyrcle_count_added_abonents'><span>v</span></li>";

                            $output .= "</div></a>";

                          }
                            }
                          }
                      }


                      $output .= "</ul>";
                      $output .= "</div>";

                      echo $output;
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

<!-- Bootstrap Core JavaScript -->
<script src="js/search.js"></script>

</body>

</html>
