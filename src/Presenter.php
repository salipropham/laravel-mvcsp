<?php
/**
 * Created for mvcs project.
 * Author: salipro <sangph@suga.vn>
 * Date: 1/21/19
 */

namespace SaliproPham\LaravelMVCSP;


use Illuminate\Contracts\Support\Arrayable;


/**
 * Class Presenter
 *
 * @method static void parse(array $original_data = [])
 * @package SaliproPham\LaravelMVCSP
 */
abstract class Presenter implements Arrayable
{

    /**
     * The array of original data
     * @var array
     */
    private $origData;


    /**
     * The array of view data
     * @var array
     */
    private $viewData;

    /**
     * Flag that block setting a data outside transform()
     * @var bool
     */
    private $allowSet = false;

    /**
     * Keep or not original data that has passed on init
     * @var bool
     */
    protected $keepOrigData = false;



    public function __construct(array $arguments = [])
    {

        $this->origData = array_merge((array)$this->origData,$arguments);
    }

    /**
     * The default handle method
     *
     * @return mixed
     */
    abstract public function transform();


    /**
     * Arrayable method
     *
     * @return array
     */
    public function toArray()
    {
        return $this->parseData();
    }

    /**
     * Set a variable to view data
     *
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if($this->allowSet){
            array_set($this->viewData,$name,$value);
        }
    }


    /**
     * Parse presenter data
     *
     * @return array
     */
    private function parseData(){

        # only allow set data from transform method
        $this->allowSet = true;
        $this->transform();
        $this->allowSet = false;

        # check whether keep or not original data
        if($this->keepOrigData){
            $this->viewData = array_merge((array)$this->origData, (array)$this->viewData);
        }

        return $this->viewData?:[];
    }


    /**
     * Get original data
     *
     * @return array
     */
    public function getOriginalData(): array
    {
        return $this->origData;
    }

    /**
     * Set original data
     *
     * @param array $origData
     */
    public function setOriginalData(array $origData): void
    {
        $this->origData = $origData;
    }


    //////////////////// MAGIC METHOD


    public function __call($name, $arguments)
    {
        if($name === 'parse'){
            return $this->parseData();
        }
        throw new \BadMethodCallException('Call to undefined method ' . get_class($this) . '::' . $name . '()');
    }

    public function __callStatic($name, $arguments)
    {
        $ins = new static();
        if($name === 'parse'){
            $ins->setOriginalData(isset($arguments[0])?$arguments[0]:[]);
            return $ins->parseData();
        }
        $ins->$name($arguments);
    }


}