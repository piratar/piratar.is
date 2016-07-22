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

$domaindata = GADWP_Tools::get_root_domain( esc_html( get_option( 'siteurl' ) ) );
?>
<script type="text/javascript">
(function($){
    $(window).load(function() {
        <?php if ($this->gadwp->config->options['ga_event_tracking']){ ?>

            //Track Downloads
            $('a').filter(function() {
                return this.href.match(/.*\.(<?php echo esc_js($this->gadwp->config->options['ga_event_downloads']);?>)(\?.*)?$/);
            }).click(function(e) {
                ga('send','event', 'download', 'click', this.href<?php if(isset($this->gadwp->config->options['ga_event_bouncerate']) && $this->gadwp->config->options['ga_event_bouncerate']){echo ", {'nonInteraction': 1}";}?>);
            });

            //Track Mailto
            $('a[href^="mailto"]').click(function(e) {
                ga('send','event', 'email', 'send', this.href<?php if(isset($this->gadwp->config->options['ga_event_bouncerate']) && $this->gadwp->config->options['ga_event_bouncerate']){echo ", {'nonInteraction': 1}";}?>);
             });
            <?php if (isset ( $domaindata ['domain'] ) && $domaindata ['domain']) { ?>

            //Track Outbound Links
            $('a[href^="http"]').filter(function() {
                if (!this.href.match(/.*\.(<?php echo esc_js($this->gadwp->config->options['ga_event_downloads']);?>)(\?.*)?$/)){
                    if (this.href.indexOf('<?php echo $domaindata['domain']; ?>') == -1) return this.href;
                }
            }).click(function(e) {
                ga('send','event', 'outbound', 'click', this.href<?php if(isset($this->gadwp->config->options['ga_event_bouncerate']) && $this->gadwp->config->options['ga_event_bouncerate']){echo ", {'nonInteraction': 1}";}?>);
            });
		    <?php } ?>
		<?php } ?>
        <?php if ($this->gadwp->config->options['ga_event_affiliates'] && $this->gadwp->config->options['ga_aff_tracking']){ ?>

            //Track Affiliates
            $('a').filter(function() {
            	if ('<?php echo esc_js($this->gadwp->config->options['ga_event_affiliates']);?>'!=''){
        	       	return this.href.match(/(<?php echo str_replace('/','\/',(esc_js($this->gadwp->config->options['ga_event_affiliates'])));?>)/);
            	}
            }).click(function(event) {
               		ga('send','event', 'affiliates', 'click', this.href<?php if(isset($this->gadwp->config->options['ga_event_bouncerate']) && $this->gadwp->config->options['ga_event_bouncerate']){echo ", {'nonInteraction': 1}";}?>);
            });
        <?php } ?>
        <?php if (isset ( $domaindata ['domain'] ) && $domaindata ['domain'] && $this->gadwp->config->options ['ga_hash_tracking']) { ?>

            //Track Hashmarks
            $('a').filter(function() {
                if (this.href.indexOf('<?php echo $domaindata['domain']; ?>') != -1 || this.href.indexOf('://') == -1) return this.hash;
            }).click(function(e) {
                ga('send','event', 'hashmark', 'click', this.href<?php if(isset($this->gadwp->config->options['ga_event_bouncerate']) && $this->gadwp->config->options['ga_event_bouncerate']){echo ", {'nonInteraction': 1}";}?>);
            });

        <?php } ?>
});
})(jQuery);
</script>
