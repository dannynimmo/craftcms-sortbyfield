<?php
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class SortByFieldTwigExtension extends Twig_Extension
{

    public function getName() {
        return 'sortbyfield';
    }

    public function getFilters() {
        return array(
            'sortByField' => new Twig_Filter_Method($this, 'sortByFieldFilter'),
        );
    }

    /**
     * The "sortByField" filter sorts an array of entries by the specified field's value
     *
     * Usage: {% for entry in craft.entries|sortByField('ordering', 'desc') %}
     */
    public function sortByFieldFilter($content, $sort_by = null, $direction = 'asc') {
        if(!is_array($content)) {
            throw new Exception(Craft::t('Variable passed to the sortByField filter is not an array'));
        } elseif(!(isset($content[0]) && is_object($content[0]) && get_class($content[0]) === 'Craft\EntryModel')) {
            throw new Exception(Craft::t('Variables passed to the sortByField filter are not entries'));
        } elseif($sort_by === null) {
            throw new Exception(Craft::t('No sort by parameter passed to the sortByField filter'));
        } elseif(!$content[0]->__isset($sort_by)) {
            throw new Exception(Craft::t('Entries passed to the sortByField filter do not have the field "' . $sort_by . '"'));
        } else {
            // Unfortunately have to suppress warnings here due to __get function
            // causing usort to think that the array has been modified:
            // usort(): Array was modified by the user comparison function
            @usort($content, function ($a, $b) use($sort_by, $direction) {
                $flip = ($direction === 'desc') ? -1 : 1;
                $a_sort_value = $a->__get($sort_by);
                $b_sort_value = $b->__get($sort_by);
                if($a_sort_value == $b_sort_value) {
                    return 0;
                } else if($a_sort_value > $b_sort_value) {
                    return (1 * $flip);
                } else {
                    return (-1 * $flip);
                }
            });
        }
        return $content;
    }
}
