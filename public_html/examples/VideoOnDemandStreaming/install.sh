#!/bin/sh
if [ -d /Library/WowzaStreamingEngine ]
then
	cd /Library/WowzaStreamingEngine/examples/VideoOnDemandStreaming
else
	cd /usr/local/WowzaStreamingEngine/examples/VideoOnDemandStreaming
fi
if [ -f ../../conf/vod/Application.xml ] 
then
	echo "Skipping VideoOnDemandStreaming.  Already configured."
else
	echo "Installing VideoOnDemandStreaming..."
	cp -R conf/* ../../conf/
fi
if [ ! -d ../../applications/vod ]
then
	mkdir ../../applications/vod
fi
if [ "$1" != "all" ]
	then
		echo "Restart Wowza Streaming Engine to complete example installation."
fi