Yii2 OpCache module
===================
 Show statistic, config, reset all, invalidate files, search in cached files

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist insolita/yii2-opcache "~1.0"
```

or add

```
"insolita/yii2-opcache": "~1.0"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :
```php
'bootstrap'=>[
       ...
        \insolita\opcache\Bootstrap::class
        ...
],
...
'modules'=>[
    ...
    'opcache'=>[
            'class'=>'insolita\opcache\OpcacheModule',
            'as access'=>[
               'class' => \yii\filters\AccessControl::class,
                           'rules' => [
                               [
                                   'allow' => true,
                                   //Protect access
                                   'roles' => ['developer'],
                               ],
                           ],
            ]
        ],
    ...    
]

```
Go to route ```['/opcache/default/index']```

Screens
-------
![Status](http://dl4.joxi.net/drive/2017/04/05/0008/3019/551883/83/a70744c562.jpg)
![Files](http://dl4.joxi.net/drive/2017/04/05/0008/3019/551883/83/070fedc0b3.jpg)
![Config](http://dl4.joxi.net/drive/2017/04/05/0008/3019/551883/83/c3769678c7.jpg)

#### Understanding OpCache 

@see https://habrahabr.ru/company/mailru/blog/310054/ (Ru) 

@see http://jpauli.github.io/2015/03/05/opcache.html (En)


#####  P.S.
Russian settings translation based on 
https://sabini.ch/cms/perevod-nastroek-zend-opcache.html