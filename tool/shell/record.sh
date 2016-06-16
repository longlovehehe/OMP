
#!/bin/sh

source /etc/profile
phpexec=`which php`

if [ -e $phpexec ]
then
    if [ -f /usr/local/omp/www/api.php ]
    then
        $phpexec /usr/local/omp/www/api.php records
    fi
fi
