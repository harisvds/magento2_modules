<?php

namespace Perficient\Blog\Plugin;

class TopmenuPlugin
{

    public function afterGetHtml(\Magento\Theme\Block\Html\Topmenu $topmenu, $html)
    {
        $html .= "<li class=\"level0 nav-4 level-top parent ui-menu-item\">";
        $html .= "<a href=\"" . "/blogs" . "\" class=\"level-top ui-corner-all\" aria-haspopup=\"true\" tabindex=\"-1\" role=\"menuitem\"><span class=\"ui-menu-icon ui-icon ui-icon-carat-1-e\"></span><span>" . __("Blogs") . "</span></a>";
        $html .= "</li>";
        return $html;
    }


}