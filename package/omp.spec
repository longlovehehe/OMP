Summary: Operation Management Platform
Name: omp
Version: 3.3.0
Release: 0
Vendor: zed-3, Inc 2003-2014
License: zed-3, Inc 2003-2014
Group: Applications/ASG
BuildRoot: /tmp/BUILD/OMP
%description
This package contains the web files for Operation Management Platform

%pre 
if [ "$1" = "2" ]; then 
    if [ -e /usr/local/omp/private/config/language.ini ]; then 
        /bin/cp /usr/local/omp/private/config/language.ini /tmp/language.ini
    fi 

    if [ -e /usr/local/omp/private/config/config.ini ]; then 
        /bin/cp /usr/local/omp/private/config/config.ini /tmp/config.ini
    fi 
fi 


%post
if ! [ -d /usr/local/asg/www/html ];
then
    /bin/mkdir -p /usr/local/asg/www/html
fi

if ! [ -L /usr/local/asg/www/html/omp ];
then
    /bin/ln -s /usr/local/omp/www /usr/local/asg/www/html/omp
fi

if ! [ -L /usr/local/omp/runtime ];
then
    /bin/ln -s /var/omp/runtime /usr/local/omp/runtime
fi

if [ -d /usr/local/omp/www/files ];
then
    rm -rf /usr/local/omp/www/files
fi

if ! [ -L /usr/local/omp/www/files ];
then
    /bin/ln -s /var/omp/upload /usr/local/omp/www/files
fi

if [ "$1" = "2" ]; then 
    if [ -e /tmp/language.ini ]; then 
        /bin/mv /tmp/language.ini /usr/local/omp/private/config/
    fi 

    if [ -e /tmp/config.ini ]; then 
        /bin/mv /tmp/config.ini /usr/local/omp/private/config/
    fi 
fi 

chown apache.apache -R /usr/local/omp
rm -f /var/omp/runtime/cache/*

if [ -x /etc/init.d/httpd ];
then
    /etc/init.d/httpd restart >/dev/null 2>&1
fi

pgpassfile=/root/.pgpass
if [ -f /usr/local/omp/.pgpass ];
then
    /bin/cp /usr/local/omp/.pgpass /root
    /bin/chmod 0600 /root/.pgpass
fi

if [ -e "/usr/bin/psql" ]; then 
    PSQL="/usr/bin/psql"
elif [ -e "/usr/local/pgsql/bin/psql" ]; then 
    PSQL="/usr/local/pgsql/bin/psql"
fi 


curTime=`/bin/date "+%Y-%m-%d %H:%M:%S"`
specificTime=`echo $curTime | cut -c1-19`
oem=`/bin/grep "ident=" /usr/local/omp/private/config/language.ini | awk -F= '{print $2}'`
if [ -x "$PSQL" ];
then
    recordIsExist=`$PSQL -U ompuser -d OMPDB -c "SELECT count('g_key') from \"T_Gloabals\" where g_key='g_omp_product_access'"`
    if [ -n "$recordIsExist" ];then
        value=`/bin/echo $recordIsExist | /bin/awk '{print $3}'`
        if [ "$value" = "0" ]; then
            if [[ $oem =~ "VT" ]]; then 
                $PSQL -U ompuser -d OMPDB -c "INSERT INTO \"T_Gloabals\" VALUES ('g_omp_product_access', 1, TIMESTAMP '$specificTime')" >/dev/null 2>&1
            else 
                $PSQL -U ompuser -d OMPDB -c "INSERT INTO \"T_Gloabals\" VALUES ('g_omp_product_access', 0, TIMESTAMP '$specificTime')" >/dev/null 2>&1
            fi 
        else
            if [[ $oem =~ "VT" ]]; then 
                $PSQL -U ompuser -d OMPDB -c "UPDATE \"T_Gloabals\" SET g_value='1' WHERE g_key='g_omp_product_access'" >/dev/null 2>&1
            else 
                $PSQL -U ompuser -d OMPDB -c "UPDATE \"T_Gloabals\" SET g_value='0' WHERE g_key='g_omp_product_access'" >/dev/null 2>&1
            fi  
        fi
    fi
fi

if [ -f $pgpassfile ]; then
    /bin/rm -f $pgpassfile
fi

if [ -f /usr/local/omp/tool/shell/ompCron.sh ]
then
    /bin/sh /usr/local/omp/tool/shell/ompCron.sh
fi

%postun

if [ "$1" = "0" ]; then
    if [ -L /usr/local/asg/www/html/omp ];
    then
        rm -f /usr/local/asg/www/html/omp
    fi

    if [ -d /usr/local/omp ];
    then
        rm -rf /usr/local/omp
    fi

    if [ -d /var/omp ];
    then
        rm -rf /var/omp
    fi
fi

%files
%defattr (-,root,root)
/usr/local/omp
/var/omp
