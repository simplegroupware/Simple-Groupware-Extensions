@echo off

set FILE=SimpleGroupware_Compose_Html_0.2.tar
tar -cf ../%FILE% ./
gzip -9 ../%FILE%

pause