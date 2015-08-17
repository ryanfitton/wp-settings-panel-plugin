# WordPress Site Settings Plugin
This repository contains documentation for the [WordPress site settings plugin](https://ryanfitton.co.uk/blog/wordpress-site-settings-plugin/).

##Information
You can read more about this plugin on this dedicated page: [https://ryanfitton.co.uk/blog/wordpress-site-settings-plugin/](https://ryanfitton.co.uk/blog/wordpress-site-settings-plugin/).

##Plugin
This plugin provides an easy way to adjust important website/company information. This plugin was originally created by [Ryan Fitton](https://ryanfitton.co.uk).

###How to use
You will need to install this plugin folder in your WordPress `/wp-content/plugins/` directory.

Once activated in your WordPress dashboard, you will see a `Website Settings` link, this page will allow you to adjust the options for this plugin.

To show the plugin options in your WordPress theme, use these PHP commands:

* Show Contact Address: `<?php echo get_option('ws_contact_address'); ?>`
* Show Contact Telephone Number: `<?php echo get_option('ws_contact_telephone'); ?>`
* Show Contact Email Address: `<?php echo get_option('ws_contact_email'); ?>`
* Show Website Footer Information `<?php echo get_option('ws_footer_information'); ?>`
* Show Website META Keywords `<?php echo get_option('ws_meta_keywords'); ?>`

##License
The license for this plugin is [Creative Commons: Attribution 4.0 International](https://creativecommons.org/licenses/by/4.0/).

This means you can Share and Redistribute in any medium or form. You can Adapt the code to suit your needs, and build in new code. The plugin can be used personally or commercially.

You must give attribution to the original author ([Ryan Fitton](https://ryanfitton.co.uk)). You can give attribution by including my name and linking to my website: [https://ryanfitton.co.uk](https://ryanfitton.co.uk) within the plugin description.

![https://licensebuttons.net/l/by/4.0/88x31.png](https://licensebuttons.net/l/by/4.0/88x31.png "Creative Commons Attribution 4.0 International License")

Creative Commons Licence: WordPress Site Settings Plugin by Ryan Fitton is licensed under a Creative Commons Attribution 4.0 International License.