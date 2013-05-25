sortByField for [Craft CMS](http://buildwithcraft.com/)
=======================================================

Adds a "sortByField" Twig filter which sorts an array of entries by the specified field's value.

Installation
------------

1. Move the `sortbyfield` directory into your `craft/plugins` directory.
2. Go to Settings > Plugins from your Craft control panel and enable the sortByField plugin.

Usage
-----

    {% for entry in craft.entries|sortByField('height') %}

The filter also accepts an optional `direction` parameter:

    {% for entry in craft.entries|sortByField('weight', 'desc') %}
