<?php


class DetailTvToren implements DetailInterface
{

    public function getHoogte ()
    {

        return '368 meter';

    }

    public function getBouwjaar()
    {
        return '1965';
    }

    public function getVisitors (){

        return 'Meer dan 1 miljoen';

    }


    public function getWikiLink()
    {
        return 'https://nl.wikipedia.org/wiki/Fernsehturm';
    }
}