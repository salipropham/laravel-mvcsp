# Laravel-MVCSP
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Latest Version on Packagist][ico-download]][link-packagist]


Implement MVC + Service + Presenter layer to Laravel 5

## Installation

Via Composer

``` bash
$ composer require salipropham/laravel-mvcsp
```

## Usage

#### Service Layer

Create new service via artisan command. The service stored in `app/Services` folder.
```
$ php artisan make:service ServiceName
```

In controller, you can use `service` helper function to use it like a singleton.
```php
public function index(Request $request)
{
    $srvDummy = service(DummyService::class);    
    if($request->get('key')){
        $srvDummy->loveU();
    } else {
        $srvDummy->willLoveU;
    }
    
    // something or nothing...

}

```


#### Presenter Layer

The Presenter stored in `app/Presenters` folder.
```
$ php artisan make:presenter PresenterName
```

Presenter will transform your data into view data, prevent writing logic on view. 
```php
public function index(Request $request)
{

    // something or nothing...
    
    $prsFoo = presenter(FooPresenter::class);

    return view('example', $prsFoo);
}
```
 
 
FooPresenter.php
```php
class LovePresenter extends Presenter
{

    /**
     * Keep or not original data that has passed on init
     * @var bool
     */
    protected $keepOrigData = true;
 
    public function transform()
    {
        // logic here and only here
        
        $this->mydata = 'transformed data';
    }
}
```

In addition, we can pass data to Presenter via `presenter` helper or `setOriginalData` function.
```php
presenter($name, $original_data)
//or
$prsFoo->setOriginalData($original_data)
``` 
To get transformed data, simple like drinking a coffee cup :)
```php
$data = $prsFoo->parse();
// or a static method
$data = FooPresenter::parse();
```



## License

Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/salipropham/laravel-mvcsp.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/salipropham/laravel-mvcsp

[ico-download]: https://img.shields.io/github/downloads/salipropham/laravel-mvcsp/latest/total.svg?style=flat-square


