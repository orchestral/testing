#!/bin/bash

if [[ -n "$1" && -d "$1" ]]; then
    DIR=$1
else
    DIR='vendor/orchestra/platform'
fi

cp -rf $DIR/config/*.php platform/config/
cp -rf $DIR/resources/lang/en/*.php platform/resources/lang/en/
