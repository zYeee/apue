<?php
class Bim
{
    public function doSomething(){
        echo __METHOD__,'|';
    }
}
class Bar
{
    private $bim;
    public function __construct(Bim $bim){
        $this->bim = $bim;
    }
    public function doSomething(){
        $this->bim->doSomething();
        echo __METHOD__.'|';
    }
}
class Foo
{
    private $bar;
    public function __construct(Bar $bar){
        $this->bar = $bar;
    }
    public function doSomething(){
        $this->bar->doSomething();
        echo __METHOD__.'|';
    }
}

class Ioc
{
    public static $regisitry = [];
    public static function bind($name, Callable $resolver){
        static::$regisitry[$name] = $resolver;
    }
    public static function make($name){
        if(isset(static::$regisitry[$name])){
            $resolver = static::$regisitry[$name];
            return $resolver();
        }
    }
}

Ioc::bind('bim', function(){
    return new Bim();
});
Ioc::bind('bar', function(){
    return new Bar(Ioc::make('bim'));
});
Ioc::bind('foo', function(){
    return new Foo(Ioc::make('bar'));
});

//1)a simple achieve of DI
$f = new Foo(new Bar(new Bim()));
$f->doSomething();

//2)a IOC container
$foo = Ioc::make('foo');
$foo->doSomething();
