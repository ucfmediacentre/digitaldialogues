#!/bin/bash

# Use of this batch file should only be necessary when the MPEG DASH Player page (player.html) is accessed directly through the file system instead of through a web server.

kill $(ps ax | grep -i 'Chrome' | awk '{print $1}') >& /dev/null
google-chrome --allow-file-access-from-files /usr/local/WowzaStreamingEngine/examples/VideoOnDemandStreaming/MPEGDASHPlayer/player.html >& /dev/null &
