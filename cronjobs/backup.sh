#!/bin/bash
TIME ='date +%b-%d%-%y %H:%M'
FILENAME=Inet.iwpusa.com-$TIME.tar.gz
SRCDIR='/var/www/html/'
DESDIR = '/media/iwp2/New Volume/backup' 
tar -cpzf $DESDIR/$FILENAME $SRCDIR
