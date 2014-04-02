#!/bin/bash

#export TERM=xterm
#sudo -s
rm -f /etc/apache2/sites-enabled/academyhq.localhost
ln -sf /srv/essaymodule.tercet/system/scormessay.tercet.io /etc/apache2/sites-enabled/scormessay.tercet.io
service apache2 restart

#/usr/local/bin/composer self-update
#/usr/local/bin/composer --working-dir=/srv/academyhq.localhost/webapp/ update
#sh /srv/academyhq.localhost/scripts/seed.sh

# sudo apt-get update

# sudo apt-get -y install php-pear
# sudo pear channel-update pear.php.net
# sudo pear upgrade-all
# sudo pear config-set auto_discover 1
# sudo pear install pear.phpunit.de/PHPUnit
# sudo apt-get -y install make
# sudo apt-get -y install php5-xdebug


# #SETUP ALL VARIABLES
# echo "Setting up variables"
# serverUrl='http://192.168.33.10:4444'
# serverVersion='2.40.0'
# serverFile=selenium-server-standalone-$serverVersion.jar
# firefoxUrl=http://ftp.mozilla.org/pub/mozilla.org/firefox/releases/23.0/linux-x86_64/en-US/firefox-23.0.tar.bz2
# firefoxFile=firefox.tar.bz2
# fixturePort=8080
# phpVersion=`php -v`
# echo "Finished Setting up variables"
# #FINISHED SETTING UP ALL VARIABLES


# #INSTALL JAVA
# sudo apt-get -y install openjdk-7-jre unzip
# echo "Finished Installing Jre"
# #FINISHED INSTALLING JAVA


# #INSTALL SELENIUM SERVER STANDALONE
# echo "Installing Selenium Server Standalone"
# if [ ! -f $serverFile ]; then
#     wget http://selenium-release.storage.googleapis.com/2.40/selenium-server-standalone-$serverVersion.jar -O $serverFile
#     sudo mv selenium-server-standalone-$serverVersion.jar /usr/local/bin
# fi
# echo "Finished Installing Selenium Server Standalone"
# #FINISHED INSTALLING SELENIUM SERVER STANDALONE


# #INSTALL FIREFOX
# sudo apt-get -y install python-software-properties
# sudo add-apt-repository ppa:ubuntu-mozilla-security/ppa
# sudo apt-get update
# sudo apt-get -y install firefox libstdc++5
# wget $firefoxUrl -O $firefoxFile
# tar xvjf $firefoxFile
# sudo mv firefox-23.0.tar.bz2 /usr/local/bin
# echo "Finished Installing Firefox"
# #FINISHED INSTALLING FIREFOX


# #INSTALL GOOGLE CHROME
# wget https://dl.google.com/linux/direct/google-chrome-stable_current_i386.deb
# sudo dpkg -i google-chrome-stable_current_i386.deb
# sudo apt-get -f install
# echo "Finished Installing Google Chrome"
# #FINISHED INSTALLING GOOGLE CHROME


# #INSTALL CHROME DRIVER
# sudo wget "https://chromedriver.googlecode.com/files/chromedriver_linux64_2.2.zip"
# sudo unzip chromedriver_linux64_2.2.zip
# sudo mv chromedriver /usr/local/bin
# echo "Finished Installing Chrome Driver"
# #FINISHED INSTALLING CHROME DRIVER


# #INSTALL ALL FONTS
# sudo mkfontdir
# sudo apt-get -y install x11-xkb-utils
# sudo apt-get -y install xfonts-100dpi xfonts-75dpi xfonts-scalable xfonts-cyrillic
# sudo apt-get -y install xserver-xorg-core
# sudo apt-get -y install x-ttcidfont-conf cabextract ttf-mscorefonts-installer
# echo "Finished Installing Fonts"
# #FINISHED INSTALLING FONTS


# #INSTALL X VIRTUAL FRAME BUFFER
# sudo apt-get update
# sudo apt-get -y install xvfb
# echo "Finished Installing Virtual Frame Buffer"
# #FINISHED INSTALLING VIRTUAL FRAME BUFFER


# #STARTING SELENIUM
# echo "Starting Selenium"
# cd /usr/local/bin
# xvfb-run java -Dwebdriver.firefox.bin=firefox/firefox-bin  -jar $serverFile > /tmp/selenium.log 2>&1 &
# wget --retry-connrefused --tries=60 --waitretry=1 --output-file=/dev/null $serverUrl/wd/hub/status -O /dev/null
# if [ ! $? -eq 0 ]; then
#     echo "Selenium Server not started"
# else
#     echo "Selenium Server started"
# fi
# #FINISHED STARTING SELENIUM SERVER


# #SATRTING GOOGLE CHROME
# echo "Starting Google Chrome ..."
# google-chrome --remote-debugging-port=9222 &
# echo "Google Chrome Started"
# #FINISHED STARTING GOOGLE CHROME

# # # # sudo apt-get -y install python-software-properties
# # # # sudo apt-add-repository ppa:chris-lea/node.js
# # # # sudo apt-get update
# # # # sudo apt-get -y install node.js
# # # # sudo apt-get -y install npm
# # # # npm install selenium-webdriver