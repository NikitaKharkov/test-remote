#!/bin/bash
php uninstall.php
cd sphider/admin
php install.php
php spider.php -all
cd ../..
php filter.php | /usr/local/mysql/bin/mysql -u root -pjKp9c8
php keywordWeights.php
