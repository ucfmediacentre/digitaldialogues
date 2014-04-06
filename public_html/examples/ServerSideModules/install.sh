#!/bin/sh
echo "Installing ServerSideModules..."
if [ -d /Library/WowzaStreamingEngine ]
then
	cd /Library/WowzaStreamingEngine/examples/ServerSideModules
else
	cd /usr/local/WowzaStreamingEngine/examples/ServerSideModules
fi

if [ ! -d ../../applications/mymodules ]
then
	mkdir ../../applications/mymodules
fi
if [ "$1" != "all" ]
	then
		echo "Restart Wowza Streaming Engine to complete example installation."
fi