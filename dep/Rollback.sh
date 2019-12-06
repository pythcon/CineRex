#!/bin/bash

echo "Rollback Script"
printf "Please enter the bundle you would like to rollback (fe, be, dmz or all): "
read bundle
printf "Please enter the destination you would like to rollback (QA_DMZ, Prod_FE, etc.):  "
read destination

ssh deployment@"$destination" "cp -prf /var/www/html/backup/$bundle/ /var/www/html/; rm -rf /var/www/html/backup/$bundle"

echo "Rollback finished."