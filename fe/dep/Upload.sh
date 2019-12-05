#!/bin/bash

echo "Upload Script"
printf "Please enter the bundle you would like to upload (fe, be, dmz or all): "
read bundle
printf "Please enter the destination you would like to upgrade (QA_DMZ, Prod_FE, etc.):  "
read destination

case "$bundle" in
    fe)
        backup
        bun="fe"
        ;;
    be)
        backup
        bun="be"
        ;;
    dmz)
        backup
        bun="dmz"
        ;;
    all)
        backup
        scp /var/www/html/* deployment@"$destination":/var/www/html
        ;;
    *)
        echo "Please enter a valid bundle!"
        exit 1
esac

scp /var/www/html/"$bun" deployment@"$destination":/var/www/html/"$bun"


function backup {
    ssh deployment@"$destination" "mkdir /var/www/html/backup; cp /var/www/html/* /var/www/html/backup/;"
}

echo "Upload finished."