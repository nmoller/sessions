#!/usr/bin/env bash

root='/home/nmoller/dev/convert_sessions/'
now=`date --rfc-3339='seconds'`

cd $root && php convert.php

cd $root && git add logged_sessions.js

cd $root && git commit -m "${now}"

cd $root && git push origin
