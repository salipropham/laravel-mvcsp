<?php
/**
 * Created for mvcs project.
 * Author: salipro <sangph@suga.vn>
 * Date: 1/23/19
 */

namespace SaliproPham\LaravelMVCSP;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Service
{

    public $request;

    private static $instances = [];


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public static function getInstance()
    {
        $class = get_called_class();
        if(!isset(self::$instances[$class]) || !self::$instances[$class] instanceof $class){
            self::$instances[$class] = \App::make(get_called_class());
        }

        return self::$instances[$class];
    }

}