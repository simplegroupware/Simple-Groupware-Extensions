@echo off

set FILE=SimpleGroupware_Compose_Html_0.3.tar
tar --exclude=build.bat -cf ../%FILE% ./
gzip -9 ../%FILE%

pause