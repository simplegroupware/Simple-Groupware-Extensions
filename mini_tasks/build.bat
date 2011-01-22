@echo off

set FILE=SimpleGroupware_Mini_Tasks_0.2.tar
tar -cf ../%FILE% ./
gzip -9 ../%FILE%

pause