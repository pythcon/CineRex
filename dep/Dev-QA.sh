#!/bin/bash

echo "DEV to QA"
printf "Please enter the bundle you would like to upload (fe, be, dmz or all): "
read bundle

case "$bundle" in
    fe)
        upload
        ;;
    be)
        upload
        ;;
    dmz)
        upload
        ;;
    all)
        upload
        ;;
    *)
        echo "Please enter a valid bundle"
        exit 1
esac

function uploadFE {
    
}
