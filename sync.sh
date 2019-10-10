#!/bin/bash

if [ -z "$1" ]; then
    DIR='vendor/orchestra/platform'
else
    DIR=$1
fi

cp -rf $DIR/config/*.php platform/config/
cp -rf $DIR/resources/lang/en/*.php platform/resources/lang/en/
