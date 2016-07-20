INSTALLATION
=============

- Unzip to sites/all/modules
- Install the My Settings Module
- Go to admin/mysettings

NOTE
====

- In case you want to use the variable settings to other page use the code below:

  $my_settings = variable_get('mysettings');
  $your_variable = $my_settings['ticker_text'];

