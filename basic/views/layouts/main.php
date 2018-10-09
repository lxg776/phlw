<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
    <script src="/hlw/basic/web/cdn/bootstrap/js/jquery-3.2.1.min.js"></script>
    <link href="/hlw/basic/web/cdn/aui/css/aui.css" rel="stylesheet">

</head>
<body>


<div class="wrap">


    <div class="container">

        <?= $content ?>
    </div>
</div>



</body>
</html>

