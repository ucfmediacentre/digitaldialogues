#!/bin/sh
if [ -d /Library/WowzaStreamingEngine ]
then
	cd /Library/WowzaStreamingEngine/examples/VideoChat
else
	cd /usr/local/WowzaStreamingEngine/examples/VideoChat
fi
if [ -f ../../conf/videochat/Application.xml ] 
then
	echo "Skipping VideoChat.  Already configured."
else
	echo "Installing VideoChat..."
	cp -R conf/* ../../conf/
fi
if [ ! -d ../../applications/videochat ]
then
	mkdir ../../applications/videochat
fi
if [ "$1" != "all" ]
	then
		echo "Restart Wowza Streaming Engine to complete example installation."
fi