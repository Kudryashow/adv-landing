<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.01.19
 * Time: 13:27
 */

namespace app\controllers;


use yii\web\Controller;

class LandingController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function amqpConnect()
    {

    }
}