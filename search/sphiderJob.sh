#spider the site
cd sphider/admin
php spider.php -all
cd ../..
php filter.php | /usr/local/mysql/bin/mysql -u root -pb3ck3tt21
php keywordWeights.php
