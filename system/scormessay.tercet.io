<VirtualHost *:80>
     SetEnv APP_ENV local
     ServerName api.scormessay.tercet.local
     ServerAlias *.scormessay.tercet.local
     ServerAdmin "support@academyhq.tercet.local"
     DocumentRoot /srv/essaymodule.tercet/webapp/public
     <IfModule mod_ssl.c>
          SSLEngine off
     </IfModule>
     <Directory /srv/essaymodule.tercet/webapp/public/>
          Options -Indexes MultiViews FollowSymLinks
          AllowOverride All
          Order allow,deny
          Allow from all
     </Directory>
</VirtualHost>