#!/bin/sh
if [ -d /Library/WowzaStreamingEngine ]
then
	cd /Library/WowzaStreamingEngine/examples/SHOUTcast
else
	cd /usr/local/WowzaStreamingEngine/examples/SHOUTcast
fi
if [ -f ../../conf/SHOUTcast/Application.xml ] 
then
	echo "Skipping SHOUTcast.  Already configured."
else
	echo "Installing SHOUTcast..."
	cp -R conf/* ../../conf/
fi
if [ ! -d ../../applications/SHOUTcast ]
then
	mkdir ../../applications/SHOUTcast
fi
if [ "$1" != "all" ]
	then
		echo "Restart Wowza Streaming Engine to complete example installation."
fi