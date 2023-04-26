#!/bin/bash
# Copyright SYRADEV - Regis TEDONE - 2023
# Compress MvcUI js files

declare sourceJS="./JS/"
declare destinationJS="../js/"
declare uglify="./node_modules/uglify-js/bin/uglifyjs"

for file in "$sourceJS"*.js; do
  sourceFile=$(basename "$file")
  sourceFilenoExt="${sourceFile%%.*}"
  echo Treating "$sourceFile":
  $uglify "$file" -o $destinationJS"$sourceFilenoExt".min.js -c -m --comments '/syradev/' --source-map "root='https://www.mvc-ui.org/assets/src/',url='$sourceFilenoExt.min.js.map'"
  echo "$sourceFile" treated.
done
echo ----------------------------------
echo JS Compression done!
