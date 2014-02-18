#!/bin/sh
if [ -d /Library/WowzaStreamingEngine ]
then
	cd /Library/WowzaStreamingEngine/examples/LiveDVRStreaming
else
	cd /usr/local/WowzaStreamingEngine/examples/LiveDVRStreaming
fi
if [ -f ../../conf/dvr/Application.xml ] 
then
	echo "Skipping LiveDVRStreaming.  Already configured."
else
	echo "Installing LiveDVRStreaming..."
	cp -R conf/* ../../conf/
fi
if [ ! -d ../../applications/dvr ]
then
	mkdir ../../applications/dvr
fi
if [ "$1" != "all" ]
	then
		echo "Restart Wowza Streaming Engine to complete example installation."
fi
		

