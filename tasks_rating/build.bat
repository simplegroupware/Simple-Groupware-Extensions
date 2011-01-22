@echo off

set FILE=SimpleGroupware_Tasks_Rating_0.1.tar
tar --exclude=build.bat -cf ../%FILE% ./
gzip -9 ../%FILE%

pause