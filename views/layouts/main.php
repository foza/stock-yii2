<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
//user module
use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\models\rbacDB\Role;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini " >
<?php $this->beginBody() ?>
    <div class="wrapper">
      <header class="main-header">
        <?=Html::a('<span class="logo-mini"><b></b></span><span class="logo-lg"><img src="../ico/favicon.png" width="20%">   <b>Склад</b></span>',['/'],['class'=>'logo']);?>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="shakeATA sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <!--span class="label label-danger">9</span-->
                </a>
                <ul class="dropdown-menu">
                  <li class="header"><?=Yii::t('app',"language");?></li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <?= \lajax\languagepicker\widgets\LanguagePicker::widget([
                      'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_DROPDOWN,
                      'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_LARGE
                    ]); ?>
                  </li>

                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="/img/avatar5.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?=Yii::$app->user->username;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="/img/avatar5.png" class="img-circle" alt="User Image">
                    <p>
                      <?=Yii::$app->user->username;?>
                      <!--small>Member since Nov. 2012</small-->
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <?=Html::a(Yii::t('app','Profile'),['/user-management/user/profile'],['class'=>'btn btn-default btn-flat']);?>
                    </div>
                    <div class="pull-right">
                      <?=Html::a(Yii::t('app','Sign out'),['/user-management/auth/logout'],['class'=>'btn btn-default btn-flat']);?>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!--li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li-->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="/img/avatar5.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?=Yii::$app->user->username;?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> <?=Yii::t('app',"Online");?></a>
            </div>
          </div>
          <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header"><?=Yii::t('app',"menu");?></li>
            <li>
              <?=Html::a('<i class="fa  fa-shopping-cart"></i> <span> '.Yii::t('app',"Категории подошв").'</span>',['/category/index']);?>
            </li>
              <li>
                  <?=Html::a('<i class="fa  fa-shopping-cart"></i> <span> '.Yii::t('app',"Склад").'</span>',['/product/index']);?>
              </li>
              <li>
                  <?=Html::a('<i class="fa fa-truck"></i> <span> '.Yii::t('app',"Продажа товара").'</span>',['/customer/']);?>
              </li>
              <li>
                  <?=Html::a('<i class="fa  fa-group "></i>'.Yii::t('app',"Clients").'</span>',['/client/index']);?>
              </li>

              <li>
                  <?=Html::a('<i class="fa fa-truck"></i> <span> '.Yii::t('app',"Прочие расходы").'</span>',['/expense/']);?>
              </li>
              <li>
                  <?=Html::a('<i class="fa  fa-credit-card"></i>'.Yii::t('app',"Долги клиентов").'</span>',['/payment/index']);?>
              </li>
              <li>
                  <?=Html::a('<i class="fa fa-bar-chart"></i> <span> '.Yii::t('app',"Отчёт").'</span>',['/site/form']);?>
              </li>
              <li class="treeview">
                  <a href="#">
                      <i class="fa fa-gears"></i> <span><?= Yii::t('app',"Настройки") ?></span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu" style="display: none;">
                      <li class="active">
                          <?=Html::a('<i class="fa fa-flask"></i> <span> '.Yii::t('app',"Categories").'</span>',['/material/index']);?>
                      </li>
                      <li class="active">
                          <?=Html::a('<i class="fa fa-venus-mars"></i> <span> '.Yii::t('app',"Genders").'</span>',['/gender/index']);?>
                      </li>

                  </ul>
              </li>





          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php Yii::t('app','Lizing');//lizingni topolmadim?>
            <!--small>#007612</small-->
          </h1>
          <!--ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Invoice</li>
          </ol-->
        </section>

        <?= $content ?>

        <div class="clearfix"></div>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer no-print">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong><a href="http://enzo.uz"><?=Yii::t('app',"Enzo");?></a> &copy; </strong> <?=Yii::t('app',"All rights reserved");?>.
      </footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

<?php $this->endBody() ?>
<style>
.shakeATA:hover {
  animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
  transform: translate3d(0, 0, 0);
  backface-visibility: hidden;
  perspective: 1000px;
}

@keyframes shake {
  10%, 90% {
    transform: translate3d(-1px, 0, 0);
  }

  20%, 80% {
    transform: translate3d(2px, 0, 0);
  }

  30%, 50%, 70% {
    transform: translate3d(-4px, 0, 0);
  }

  40%, 60% {
    transform: translate3d(4px, 0, 0);
  }
}
</style>
</body>
</html>
<?php $this->endPage() ?>
