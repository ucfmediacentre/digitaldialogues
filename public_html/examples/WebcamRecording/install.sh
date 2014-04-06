#!/bin/sh
if [ -d /Library/WowzaStreamingEngine ]
then
	cd /Library/WowzaStreamingEngine/examples/WebcamRecording
else
	cd /usr/local/WowzaStreamingEngine/examples/WebcamRecording
fi
if [ -f ../../conf/webcamrecording/Application.xml ] 
then
	echo "Skipping WebcamRecording.  Already configured."
else
	echo "Installing WebcamRecording..."
	cp -R conf/* ../../conf/
fi
if [ ! -d ../../applications/webcamrecording ]
then
	mkdir ../../applications/webcamrecording
fi
