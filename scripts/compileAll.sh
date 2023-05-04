#!/bin/bash
# Copyright SYRADEV - Regis TEDONE - 2023
# Compress BS-CSS-JS and Update Documentation

./compileBS.sh
echo ----------------------------------------------------- ";-)"
./compileCSS.sh
echo ----------------------------------------------------- ";-)"
./compileJS.sh
echo ----------------------------------------------------- ";-)"
./genPHPDoc.sh
echo ----------------------------------------------------- ";-)"
