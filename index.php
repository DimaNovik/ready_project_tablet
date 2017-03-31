
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

<div class="container">

    <div class="row position-login-form">
        <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">

        </div>

        <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6 reg">

            <form id="slick-login" action="View_load_tasks.php" method="post">
                <p><label for="clerkname">Оберіть контролера:</label></p>

                    <?php
                      // выбераем список из json файла всех пользователей в выпадающий список
                      $jsondata = file_get_contents("json/users.json");
                      $json = json_decode($jsondata, true);

                      $output = '<select name="clerkname" class="placeholder">';

                          foreach ($json['clerks_data'] as $clerk) {
                            $output .= "<option value='".$clerk['clerk_id']."'>".$clerk['clerk_name']."</option>";
                          }

                      $output .= "</select>";

                      echo $output;
                    ?>

                    <p><label for="password">Пароль:</label></p>
                        <input type="password" name="password" id="password" placeholder="Введіть Ваш пароль">
                    <p align="center"><input type="submit" id="submit" name="submit" value="УВІЙТИ"></p>
            </form>
           <br/>
           <p align="center"><a href="reg.php" style="text-transform: uppercase;"><b>Новий користувач >></b></a></p>


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
