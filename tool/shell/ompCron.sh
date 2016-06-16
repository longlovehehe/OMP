#!/bin/sh

cronCommand=`which crontab`
recordScript="record.sh"
attrScript="attr.sh"

if [ -e $cronCommand ];then
    $cronCommand -l > /tmp/ompCronTask.cron

    if /bin/grep -q "$recordScript" /tmp/ompCronTask.cron
    then
        sed -i '/'"$recordScript"'/d' /tmp/ompCronTask.cron
    fi

    if /bin/grep -q "$attrScript" /tmp/ompCronTask.cron
    then
        sed -i '/'"$attrScript"'/d' /tmp/ompCronTask.cron
    fi

    echo "0 1 1 * * source /usr/local/omp/tool/shell/record.sh" >> /tmp/ompCronTask.cron
    echo "0 2 * * * source /usr/local/omp/tool/shell/attr.sh" >> /tmp/ompCronTask.cron

    $cronCommand /tmp/ompCronTask.cron
fi

