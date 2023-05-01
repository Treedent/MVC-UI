#!/bin/bash
# Copyright SYRADEV - Regis TEDONE - 2023
# Compress MvcUI scss files

declare sourceSCSS="./public/assets/src/SCSS/"
declare destinationCSS="./public/assets/css/"

for file in "$sourceSCSS"*.scss; do
  sourceFile=$(basename "$file")
  sourceFilenoExt="${sourceFile%%.*}"
  sourcefileFirstChar="${sourceFile:0:1}"
  if [[ $sourcefileFirstChar != "_" ]]; then
    echo Treating "$sourceFile":
    sass "$file" $destinationCSS"$sourceFilenoExt".min.css --style compressed
    echo "$sourceFile" treated.
  fi
done
echo -------------------------------------
echo SCSS Compilation done!
