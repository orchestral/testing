#!/bin/bash

if [[ -n "$1" && -d "$1" ]]; then
    DIR=$1
else
    DIR='vendor/orchestra/platform'
fi

cp -rf $DIR/config/*.php platform/config/
cp -rf $DIR/resources/lang/en/*.php platform/resources/lang/en/

awk '{sub(/production/,"testing")}1' platform/config/app.php > platform/config/temp.stub && mv platform/config/temp.stub platform/config/app.php
awk '{sub(/App\\Providers/,"// App\\Providers")}1' platform/config/app.php > platform/config/temp.stub && mv platform/config/temp.stub platform/config/app.php
