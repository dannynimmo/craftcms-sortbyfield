<?php
namespace Craft;

class SortByFieldPlugin extends BasePlugin
{

    function getName() {
        return 'SortByField';
    }

    function getVersion() {
        return '0.1';
    }

    function getDeveloper() {
        return 'Danny Nimmo';
    }

    function getDeveloperUrl() {
        return 'http://dannynimmo.co.nz/';
    }

    public function hookAddTwigExtension() {
        Craft::import('plugins.sortbyfield.twigextensions.SortByFieldTwigExtension');
        return new SortByFieldTwigExtension();
    }

}
