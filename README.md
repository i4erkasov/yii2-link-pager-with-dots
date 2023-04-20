Yii2 Link Pager with Dots
=================================================

[![Latest Stable Version](https://poser.pugx.org/i4erkasov/yii2-link-pager-with-dots/v/stable)](https://packagist.org/packages/i4erkasov/yii2-link-pager-with-dots)
[![Total Downloads](https://poser.pugx.org/i4erkasov/yii2-link-pager-with-dots/downloads)](https://packagist.org/packages/i4erkasov/yii2-link-pager-with-dots)
[![License](https://poser.pugx.org/i4erkasov/yii2-link-pager-with-dots/license)](https://packagist.org/packages/i4erkasov/yii2-link-pager-with-dots)

This is an extension of the default Yii2 LinkPager widget, which adds dots between page links.


Complements the standard button generation, e.g. "1 << 3 4 5 6 7 8 >> 10", with three-dot buttons  
to create navigation, e.g.: "<< 1 ... 3 4 5 6 ... 10 >> "

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Run the following command:

```
php composer.phar require --prefer-dist i4erkasov/yii2-link-pager-with-dots "*"
```

or add the following to the require section of your composer.json file:

```
"i4erkasov/yii2-link-pager-with-dots": "*"
```

Usage
-----

Once the extension is installed, simply use it in your code by  :

The set of parameters is the same as for standard [LinkPager](https://www.yiiframework.com/doc/api/2.0/yii-widgets-linkpager)

Added an additional parameter dotsClass responsible for ```css``` класс для точек ```...```

yii2-twig example:

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
## License
This package is released under the MIT License. See LICENSE.md for details.

## Contributing
You can contribute by submitting pull requests or creating new issues.
