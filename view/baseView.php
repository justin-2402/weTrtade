<?php
require_once 'get-set/baseViewGetSet.php';

class baseView extends baseViewGetSet
{

    public function getTopBaseView()
    {
        return '<!DOCTYPE html>
        <html>
            <head>
                <title>'.$this->getSeitenName().'</title>
                '.$this->getCssLinksHtmlForm().'
            </head>
            <body>
            <div>
                <span>weTrade</span>
                <span>
                    <a href="home" target="_blank">home</a>
                    <a href="markt" target="_blank">markt</a>              
                    <a href="profil" target="_blank">profil</a>
                    <a href="registrieren" target="_blank">registrieren</a>
                </span>
                
            </div>
            <hr>
            <noscript><h1>BITTE JAVASCRIPT AKTIVIEREN</h1>
            </noscript>';
    }

    public function getBottomBaseView()
    {
        return '
        </body>
        </html>
        '.$this->getJsLinksHtmlForm();
    }
}