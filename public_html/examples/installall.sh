#!/bin/sh
if [ -d /Library/WowzaStreamingEngine ]
then
	BASEDIR=/Library/WowzaStreamingEngine/examples
	"$BASEDIR/LiveDVRStreaming/install.command" all
	"$BASEDIR/LiveVideoStreaming/install.command" all
	"$BASEDIR/ServerSideModules/install.command" all
	"$BASEDIR/SHOUTcast/install.command" all
	"$BASEDIR/VideoChat/install.command" all
	"$BASEDIR/VideoOnDemandStreaming/install.command" all
	"$BASEDIR/WebcamRecording/install.command" all
else
	BASEDIR=/usr/local/WowzaStreamingEngine/examples
	$BASEDIR/LiveVideoStreaming/install.sh all
	$BASEDIR/LiveDVRStreaming/install.sh all
	$BASEDIR/ServerSideModules/install.sh all
	$BASEDIR/SHOUTcast/install.sh all
	$BASEDIR/VideoChat/install.sh all
	$BASEDIR/VideoOnDemandStreaming/install.sh all
	$BASEDIR/WebcamRecording/install.sh all
fi
echo "If Wowza Streaming Engine is running, you must restart it to see the installed examples."
