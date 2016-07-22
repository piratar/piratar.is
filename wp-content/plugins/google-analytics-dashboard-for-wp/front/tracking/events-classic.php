<?php
/**
 * Author: Alin Marcu
 * Author URI: https://deconf.com
 * Copyright 2013 Alin Marcu
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit();
?>
<script type="text/javascript">
(function($){
    $(window).load(function() {
        if (this._gat) {
            tks = this._gat._getTrackers();
            ga_track = function(p) {
                for (i=0; i < tks.length; i++) {
                    var n = tks[i]._getName() !== "" ? tks[i]._getName()+"." : "";
                    a = [];
                    for (i2=0; i2 < p.length; i2++) {
                        var b = i2===0 ? n+p[i2] : p[i2];
                        a.push(b);
                    }
                    _gaq.push(a);
                }
            };
            $('a').filter(function() {
                return this.href.match(/.*\.(<?php echo esc_js($this->gadwp->config->options['ga_event_downloads']);?>)(\?.*)?$/);
            }).click(function(e) {
                ga_track(['_trackEvent', 'download', 'click', this.href]);
            });
            $('a[href^="mailto"]').click(function(e) {
                ga_track(['_trackSocial', 'email', 'send', this.href]);
             });
            var loc = location.host.split('.');
            while (loc.length > 2) { loc.shift(); }
            loc = loc.join('.');
            var localURLs = [
                              loc,
                              '<?php echo esc_html(get_option('siteurl'));?>'
                            ];
            $('a[href^="http"]').filter(function() {
                for (var i = 0; i < localURLs.length; i++) {
                    if (this.href.indexOf(localURLs[i]) == -1) return this.href;
                }
            }).click(function(e) {
                ga_track(['_trackEvent', 'outbound', 'click', this.href]);
            });
        }
    });
})(jQuery);
</script>
