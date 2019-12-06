#!/bin/bash

echo "Upload Script"
printf "Please enter the bundle you would like to upload (fe, be, dmz or all): "
read bundle
printf "Please enter the destination you would like to upgrade (QA_DMZ, Prod_FE, etc.):  "
read destination

function backup {
    ssh deployment@"$destination" "mkdir /var/www/html/backup; cp -pr /var/www/html/$bun /var/www/html/backup/;"
}

function makedir {
    ssh deployment@"$destination" "mkdir /var/www/html/$bun"
}

case "$bundle" in
    fe )
        bun="fe"
        backup
        makedir
        ;;
    be )
        bun="be"
        backup
        makedir
        ;;
    dmz )
        bun="dmz"
        backup
        makedir
        ;;
    all )
        backup
        scp /var/www/html/* deployment@"$destination":/var/www/html
        ;;
    * )
        echo "Please enter a valid bundle!"
        exit 1
esac

scp -r /var/www/html/"$bun"/* deployment@"$destination":/var/www/html/"$bun"/

echo "Upload finished."
