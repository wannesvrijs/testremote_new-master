<?php


class DetailBigBen implements DetailInterface
{

    public function getHoogte()
    {
        return '96 meter';
    }

    public function getBouwjaar()
    {
        return '1843';
    }

    public function getInkom(){
        return '15£';
    }

    public function getWikiLink()
    {
        return 'https://nl.wikipedia.org/wiki/Big_Ben';
    }

}