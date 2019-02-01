<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.01.19
 * Time: 17:04
 */

namespace app\widgets;


use yii\base\Widget;
use yii\helpers\Html;

class HelloWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();
        return Html::encode($content);
    }
}