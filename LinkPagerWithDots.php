<?php

namespace i4erkasov\LinkPagerWithDots\widgets;

use yii\helpers\Html;
use yii\widgets\LinkPager;

/**
 * Расширение LinkPager для отображения кнопок пагинации.
 * Дополняет стандартную генерацию кнопок, вида "1 << 3 4 5 6 7 8 >> 10", кнопками с тремя точками
 * для генерации навигации, вида: "<< 1 ... 3 4 5 6 7 8 ... 10 >>"
 *
 * Class LinkPagerWithDots
 * @package frontend\components\widgets
 */
class LinkPagerWithDots extends LinkPager
{
    public $useDots = true;
    public $dotsTemplate = '...';
    public $dotsClass = '';
    public $firstPageLabel = true;
    public $lastPageLabel  = true;
    public $linkPrevNext;
    public $maxButtonCount = 3;

    /**
     * @inheritdoc
     */
    protected function renderPageButtons()
    {
        if (!$this->useDots) {
            return parent::renderPageButtons();
        }

        $pageCount = $this->pagination->getPageCount();

        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        list($beginPage, $endPage) = $this->getPageRange();

        $buttons     = [];
        $currentPage = $this->pagination->getPage();

        if ($beginPage - 2 <= 0) { //Если мы лишь на 2 страницы от начала вперёд, не рисуем левый Dots-разделитель
            $beginPage = 0;
        }

        if ($endPage + 2 >= $pageCount - 1) { //Если мы лишь на 2 страницы от конца вперёд, не рисуем правый Dost-разделитель
            $endPage = $pageCount - 1;
        }

        $firstPageLabel = $this->firstPageLabel === true ? '1' : $this->firstPageLabel;
        $lastPageLabel  = $this->lastPageLabel === true ? $pageCount : $this->lastPageLabel;

        if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }

            $html[] = $this->renderButtonPrevNext($this->prevPageLabel, $page, $this->prevPageCssClass, $currentPage <= 0);
        }

        if ($beginPage != 0) { //Если начальная страница отрисовки - не парвая, требуется нарисовать кнопку первой страницы и Dots-разделитель
            $buttons[] = $this->renderPageButton($firstPageLabel, 0, $this->firstPageCssClass, $currentPage <= 0, false);
            $buttons[] = $this->renderDotsDelimiter();
        }

        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->renderPageButton($i + 1, $i, null, $this->disableCurrentPageButton && $i == $currentPage, $i == $currentPage);
        }

        if ($endPage != $pageCount - 1) { //Если последняя страница отрисовки - не последняя, требуется нарисовать кнопку Dots-разделитель и последней страницы.
            $buttons[] = $this->renderDotsDelimiter();
            $buttons[] = $this->renderPageButton($lastPageLabel, $pageCount - 1, $this->lastPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        $html[] = Html::tag('ul', implode(PHP_EOL, $buttons), $this->options);

        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }

            $html[] = $this->renderButtonPrevNext($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1);
        }

        return implode(PHP_EOL, $html);
    }

    /**
     * @return string
     */
    protected function renderDotsDelimiter(): string
    {
        $options = ['class' => empty($class) ? $this->pageCssClass : $class];
        Html::addCssClass($options, $this->dotsClass);

        return Html::tag('li', $this->dotsTemplate, $options);
    }

    /**
     * @param string $label
     * @param int    $page
     * @param string $class
     * @param bool   $disabled
     *
     * @return string
     */
    protected function renderButtonPrevNext(string $label, int $page, string $class, bool $disabled): string
    {
        $options = $this->linkPrevNext;

        if ($class) {
            Html::addCssClass($options, $class);
        }

        if ($disabled) {
            return Html::tag('span', $label, $options);
        }

        return Html::a($label, $this->pagination->createUrl($page), $options);
    }
}
