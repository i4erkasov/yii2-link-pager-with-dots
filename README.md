LinkPager extension to display pagination buttons
=================================================

Расширение LinkPager для отображения кнопок пагинации.

Дополняет стандартную генерацию кнопок, вида "1 << 3 4 5 6 7 8 >> 10", кнопками с тремя точками
для генерации навигации, вида: "<< 1 ... 3 4 5 6 ... 10 >>"

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist i4erkasov/yii2-link-pager-with-dots "*"
```

or add

```
"i4erkasov/yii2-link-pager-with-dots": "*"
```

to the require section of your `composer.json` file.

Usage
-----

Once the extension is installed, simply use it in your code by  :

Набор параметров виджета как у стандартного LinkPager

Добавлен дополнительный параметр dotsClass отвечающий за ```css``` класс для точек ```...```

Пример использования с шаблонизатором yii2-twig:

```php
{{ use('i4erkasov/LinkPagerWithDots/widget/linkPagerWithDots') }}
{{ linkPagerWithDots_widget({
                    'pagination': dataProvider.pagination,
                    'activePageCssClass': 'active',
                    'disableCurrentPageButton': true,
                    'prevPageCssClass': 'arrow--prev',
                    'nextPageCssClass': 'arrow--next',
                    'dotsClass': 'page--dots',
                    'options':{
                        'class': 'paging--list'
                    },
                    'linkContainerOptions':{
                        'class': 'paging--page'
                    },
                    'linkOptions': {
                        'class': 'paging--link'
                    },
                    'linkPrevNext': {
                        'class': 'paging--arrow'
                    }
                }) | raw }}
```