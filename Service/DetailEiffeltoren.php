<?php


class DetailEiffeltoren implements DetailInterface
{

    public function getHoogte()
    {
        return '300 meter';
    }

    public function getBouwjaar()
    {
        return '1887';
    }

    public function getDesigner()
    {
        return 'Gustave Eiffel';
    }

    public function getWikiLink()
    {
        return 'https://nl.wikipedia.org/wiki/Eiffeltoren';
    }

}