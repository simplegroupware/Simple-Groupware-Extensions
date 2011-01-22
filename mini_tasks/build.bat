@echo off

set FILE=SimpleGroupware_Mini_Tasks_0.2.tar
tar --exclude=build.bat -cf ../%FILE% ./
gzip -9 ../%FILE%

pause