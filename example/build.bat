@echo off

set FILE=SimpleGroupware_Example_0.5.tar
tar --exclude=build.bat -cf ../%FILE% ./
gzip -9 ../%FILE%

pause