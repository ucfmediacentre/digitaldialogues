#!/bin/sh
if [ -d /Library/WowzaStreamingEngine ]
then
	cd /Library/WowzaStreamingEngine/examples/LiveVideoStreaming
else
	cd /usr/local/WowzaStreamingEngine/examples/LiveVideoStreaming
fi
if [ -f ../../conf/live/Application.xml ] 
then
	echo "Skipping LiveVideoStreaming.  Already configured."
else
	echo "Installing LiveVideoStreaming..."
	cp -R conf/* ../../conf/
fi
if [ ! -d ../../applications/live ]
then
	mkdir ../../applications/live
fi
if [ "$1" != "all" ]
	then
		echo "Restart Wowza Streaming Engine to complete example installation."
fi