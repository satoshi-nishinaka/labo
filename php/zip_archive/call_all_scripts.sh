#!/bin/bash

echo 'clean output files.'
pwd
rm -f output/*

files="./*.php"
for filepath in $files; do
  echo $filepath
  php $filepath
  echo '--------'
done