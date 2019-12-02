#!/bin/bash

echo "Rollback Script"
printf "Please enter the destination you would like to rollback (QA_DMZ, Prod_FE, etc.):  "
read destination

ssh deployment@"$destination" "mv /var/www/html/backup/* /var/www/html/; rmdir /var/www/html/backup;"

echo "Rollback finished."