<?php
/**
 * Site Footer
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

echo '</div>'; // .site-inner
tha_footer_before();
echo '<footer class="site-footer">';
tha_footer_top();
tha_footer_bottom();
echo '</footer>';
tha_footer_after();

echo '</div>';
tha_body_bottom();
wp_footer();

?>
<!-- Start of HubSpot Embed Code -->

<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5056694.js"></script>

<!-- End of HubSpot Embed Code -->
<?php

echo '</body></html>';
