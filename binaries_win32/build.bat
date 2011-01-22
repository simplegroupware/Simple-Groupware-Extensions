@echo off

set FILE=SimpleGroupware_Binaries_win32_0.1.tar
tar -cf ../%FILE% ./
gzip -9 ../%FILE%

pause