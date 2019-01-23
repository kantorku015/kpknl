<?php
use yii\helpers\Html;
use yii\helpers\Url;
$src = Url::to(['img/015.png']);
$title = 'KPKNL Bekasi';
$title_mini = '<i class="fa fa-sun-o"></i>';
// $src = Url::to(['index.php']);
// $src = Url::to(['index']);
// $src = '#';
?>
<header class="main-header">
        <!-- Logo -->
        <a href="<?=$src?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="<?=$src?>" style="width:5%;"> <?=$title_mini?></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?=$title?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- Notifications: style can be found in dropdown.less -->
              <!-- Tasks: style can be found in dropdown.less -->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-user"></span>
                  <?php
                  if (Yii::$app->user->getIsGuest()) {
                    ?>
                      <span class="hidden-xs"><?=ucwords('Tamu')?></span>
                    <?php
                  }
                  else{
                    ?>
                      <span class="hidden-xs"><?=ucwords(Yii::$app->user->identity->username)?></span>
                    <?php
                  }
                  ?>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?php /*echo Html::img('@web/img/user2-160x160.jpg', ['class' => 'img-circle', 'alt'=>'User Image'])*/ ?>
                    <img src="<?=Url::to(['img/015a.png']);?>">
                    <!-- <span class="glyphicon glyphicon-user"></span> -->
                    <p>
                      <?php
                        if (Yii::$app->user->getIsGuest()) {
                            echo ucwords('Tamu');
                        }
                        else{
                            echo ucwords(Yii::$app->user->identity->username);
                        }
                        ?>

                      <!-- <small>Member since Nov. 2012</small> -->
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li> -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                    </div>
                    <div class="pull-right">
                      <!-- <a href="#" class="btn btn-default btn-flat"> -->
                      <?php
                      echo Html::beginForm(['/site/logout'], 'post');
                      
                        if (Yii::$app->user->getIsGuest()) {
                            echo ucwords('Tamu');
                        }
                        else{
                          echo Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']);
                        }

                      echo Html::endForm();

                      ?>

                      <?php
                      // echo Html::a('Ubah Password', ['user/change-password'], ['class' => 'btn btn-primary']) 
                      ?>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
              </li>
            </ul>
          </div>
        </nav>
      </header>
