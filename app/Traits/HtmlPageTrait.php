<?php

namespace App\Traits;

trait HtmlPageTrait {
    private $pageTitle;
    private $siteTitle;

    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    public function getSiteTitle()
    {
        return $this->siteTitle;
    }

    public function setSiteTitle($siteTitle)
    {
        $this->siteTitle = $siteTitle;
    }


}