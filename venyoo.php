<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Uri;
use Grav\Common\Taxonomy;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class VenyooPlugin
 * @package Grav\Plugin
 */
class VenyooPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }
        $id = trim($this->grav['config']->get('plugins.venyoo.widget_id'));
        if ($id) {
            $init = "
              (function(d, w, c) {
                var n = d.getElementsByTagName('script')[0],
                    s = d.createElement('script');
                w[c] = w[c] || function() {
                    (w[c].q = w[c].q || []).push(arguments);
                };
                s.async = true;
                s.src = (d.location.protocol === 'https:' ? 'https:': 'http:')
                    + '//api.venyoo.ru/wnew.js?wc=venyoo/default/science&widget_id='+{$id};
                n.parentNode.insertBefore(s, n);
            })(document, window, 'Venyoo');
        ";
        $this->grav['assets']->addInlineJs($init);
    }
  }
}