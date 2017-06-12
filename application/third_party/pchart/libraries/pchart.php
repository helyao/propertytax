<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 5/18/2017
 * Time: 2:50 PM
 */

class Pchart
{
    public function __construct() // or any other method
    {
        require_once APPPATH.'third_party/pchart/class/pData.class.php';
        require_once APPPATH.'third_party/pchart/class/pDraw.class.php';
        require_once APPPATH.'third_party/pchart/class/pImage.class.php';
    }
    function pData(){
        return new pData();
    }
    function pImage($n,$i,$data=NULL,$trans=FALSE){
        return new pImage($n,$i,$data,$trans);
    }
}