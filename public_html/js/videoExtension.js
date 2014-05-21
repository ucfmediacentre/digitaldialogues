var videoExtension = null;

//sets up variable: videoExtension to see what video should be played on users browser

if (supports_h264_baseline_video()){
    videoExtension = ".mp4";
  } else if (supports_ogg_theora_video()) {
    videoExtension = ".ogv";
  } else if (supports_webm_video()) {
    videoExtension = ".webm";
}

function supports_h264_baseline_video() {
  if (!supports_video()) { return false; }
  var v = document.createElement("video");
  return v.canPlayType('video/mp4; codecs="avc1.42E01E, mp4a.40.2"');
}

function supports_ogg_theora_video() {
  if (!supports_video()) { return false; }
  var v = document.createElement("video");
  return v.canPlayType('video/ogg; codecs="theora, vorbis"');
}

function supports_webm_video() {
  if (!supports_video()) { return false; }
  var v = document.createElement("video");
  return v.canPlayType('video/webm; codecs="vp8, vorbis"');
}

function supports_video() {
  return !!document.createElement('video').canPlayType;
}
