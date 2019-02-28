<?php
/**
 * Created for mvcs project.
 * Author: salipro <sangph@suga.vn>
 * Date: 1/21/19
 */

if (! function_exists('presenter')) {

    /**
     * @param $presenterClass
     * @param array $data
     * @return \SaliproPham\LaravelMVCSP\Presenter
     */
    function presenter($presenterClass,array $data = [])
    {
        return new $presenterClass($data);
    }
}

if (! function_exists('service')) {

    /**
     * @param $serviceClass
     * @return \SaliproPham\LaravelMVCSP\Service
     * @throws Exception
     */
    function service($serviceClass, $model = null)
    {

        if(class_exists($serviceClass)){
            return call_user_func(array($serviceClass, 'getInstance'),$model);
        }
        throw new \Exception(sprintf('Class %s is not exist.',$serviceClass));

    }
}