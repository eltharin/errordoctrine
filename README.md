here is a repo for show an error in doctrine,

to reproduce : 

- git clone https://github.com/eltharin/errordoctrine.git
- cd errordoctrine
- composer install
- symfony console d:m:m
- symfony console doctrine:fixtures:load

  When you go to the homepage you can see for each series the last item has the good number 1.12 and 2.12 but the libelle is 1.2 and 2.2
