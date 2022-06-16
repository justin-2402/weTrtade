<?php
class baseViewGetSet
{
    private $seitenName = NULL;
    private string $jsLinksHtmlForm = '';
    private string $cssLinksHtmlForm = '';

    /**
     * @param null $seitenName
     */
    public function setSeitenName($seitenName): void
    {
        $this->seitenName = $seitenName;
    }

    /**
     * @param array $cssLinks
     * @return string
     */
    private function formatCssLinks(array $cssLinks)
    {
        $cssLinksHtmlFormat = '';
        foreach ($cssLinks as $cssLink)
        {
            $cssLinksHtmlFormat .= "<link rel='stylesheet' href='$cssLink'>";
        }
        return $cssLinksHtmlFormat;
    }

    /**
     * @param array $cssLinksHtmlForm
     */
    public function setCssLinksHtmlFormat(array $cssLinksHtmlForm): void
    {
        $this->cssLinksHtmlForm = $this->formatCssLinks($cssLinksHtmlForm);
    }

    /**
     * @param array $jsLinks
     * @return string|null
     */
    private function formatJsLinks(array $jsLinks)
    {
        $jsLinksHtmlFormat = '';
        foreach ($jsLinks as $jsLink)
        {
            $jsLinksHtmlFormat .= "<script src=$jsLink></script>";
        }
        return $jsLinksHtmlFormat;
    }

    /**
     * @param array $jsLinksHtmlForm
     */

    public function setJsLinksHtmlFormat(array $jsLinksHtmlForm): void
    {
        $this->jsLinksHtmlForm = $this->formatJsLinks($jsLinksHtmlForm);
    }

    /**
     * @return null
     */
    protected function getCssLinksHtmlForm()
    {
        return $this->cssLinksHtmlForm;
    }

    /**
     * @return null
     */
    protected function getJsLinksHtmlForm()
    {
        return $this->jsLinksHtmlForm;
    }

    /**
     * @return null
     */
    protected function getSeitenName()
    {
        return $this->seitenName;
    }
}