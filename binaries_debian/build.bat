@echo off

set FILE=SimpleGroupware_Binaries_deb_0.1.tar
tar --exclude=build.bat -cf ../%FILE% ./
gzip -9 ../%FILE%

pause