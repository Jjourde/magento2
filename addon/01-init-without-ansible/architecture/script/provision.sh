#!/usr/bin/env bash

SERVER="magento2.lxc"
SSH_SERVER="root@${SERVER}"

ssh -A $SSH_SERVER apt-get update
ssh -A $SSH_SERVER apt-get -y install aptitude
ssh -A $SSH_SERVER "export DEBIAN_FRONTEND=noninteractive && aptitude -y safe-upgrade && export DEBIAN_FRONTEND=dialog"
ssh -A $SSH_SERVER aptitude -y install sudo
ssh -A $SSH_SERVER aptitude -y install aptitude
ssh -A $SSH_SERVER aptitude -y install curl
ssh -A $SSH_SERVER aptitude -y install php5-mcrypt
ssh -A $SSH_SERVER aptitude -y install php5-curl
ssh -A $SSH_SERVER aptitude -y install php5-intl
ssh -A $SSH_SERVER aptitude -y install php5-xsl
ssh -A $SSH_SERVER aptitude -y install php5-xsl

ssh -A $SSH_SERVER rm -f /etc/apache2/sites-enabled/000-default.conf
ssh -A $SSH_SERVER rm -f /etc/apache2/sites-enabled/magento2.lxc.conf
ssh -A $SSH_SERVER ln -s /var/www/magento2/architecture/conf/apache/magento2.lxc.conf /etc/apache2/sites-enabled/magento2.lxc.conf

ssh -A $SSH_SERVER rm -f /etc/php5/apache2/conf.d/99-magento2.ini
ssh -A $SSH_SERVER ln -s /var/www/magento2/architecture/conf/php/magento2.ini /etc/php5/apache2/conf.d/99-magento2.ini

ssh -A $SSH_SERVER rm -f /etc/php5/cli/conf.d/99-magento2.ini
ssh -A $SSH_SERVER ln -s /var/www/magento2/architecture/conf/php/magento2.ini /etc/php5/cli/conf.d/99-magento2.ini

ssh -A $SSH_SERVER service apache2 restart

ssh -A $SSH_SERVER /var/www/magento2/architecture/script/permissions.sh

ssh -A $SSH_SERVER /var/www/magento2/architecture/script/createDb.sh

