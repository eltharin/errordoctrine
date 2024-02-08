here is a repo for show an error in doctrine,

to reproduce : 

git clone https://github.com/eltharin/errordoctrine.git
cd errordoctrine
composer install
symfony console d:m:m
symfony console doctrine:fixtures:load
