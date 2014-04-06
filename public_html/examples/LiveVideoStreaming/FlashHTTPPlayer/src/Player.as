// LIVE
// LIVE
// LIVE
// LIVE
package
{
	
	import com.wowza.WMSMediaFactory;
	
	import flash.display.*;
	import flash.events.FullScreenEvent;
	import flash.events.IOErrorEvent;
	import flash.events.MouseEvent;
	import flash.events.NetStatusEvent;
	import flash.events.TimerEvent;
	import flash.external.ExternalInterface;
	import flash.geom.Point;
	import flash.geom.Rectangle;
	import flash.media.Video;
	import flash.net.NetConnection;
	import flash.net.Responder;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.system.Capabilities;
	import flash.system.Security;
	import flash.system.SecurityPanel;
	import flash.utils.Timer;
	import flash.utils.setTimeout;
	
	import mx.containers.Canvas;
	import mx.containers.Form;
	import mx.controls.Button;
	import mx.controls.HRule;
	import mx.controls.Text;
	import mx.controls.TextArea;
	import mx.controls.TextInput;
	import mx.controls.sliderClasses.Slider;
	import mx.events.FlexEvent;
	import mx.events.SliderEvent;
	import mx.states.State;
	import mx.styles.CSSStyleDeclaration;
	import mx.utils.LoaderUtil;
	
	import org.osmf.containers.MediaContainer;
	import org.osmf.elements.VideoElement;
	import org.osmf.events.MediaElementEvent;
	import org.osmf.events.MediaErrorEvent;
	import org.osmf.events.MediaPlayerCapabilityChangeEvent;
	import org.osmf.events.TimeEvent;
	import org.osmf.media.DefaultMediaFactory;
	import org.osmf.media.MediaElement;
	import org.osmf.media.MediaFactory;
	import org.osmf.media.MediaPlayer;
	import org.osmf.media.URLResource;
	import org.osmf.net.DynamicStreamingItem;
	import org.osmf.net.DynamicStreamingResource;
	import org.osmf.samples.MediaContainerUIComponent;
	import org.osmf.traits.MediaTraitBase;
	import org.osmf.traits.MediaTraitType;
	import org.osmf.utils.*;
	import org.osmf.utils.Version;
	
	import spark.components.Application;
	import spark.components.BorderContainer;
	import spark.components.Image;
	import spark.components.Label;
	import spark.components.TextArea;
	
	public class Player extends Application
	{
		Security.LOCAL_TRUSTED;
		
		[Embed (source="assets/fullscreen.png")]
		public static const FULLSCREEN:Class;
		[Embed (source="assets/normalscreen.png")]
		public static const NORMALSCREEN:Class;
		[Embed (source="assets/pause.png")]
		public static const PAUSE:Class;
		[Embed (source="assets/play.png")]
		public static const PLAY:Class;
		[Embed (source="assets/volume_off.png")]
		public static const VOLUME_OFF:Class;
		[Embed (source="assets/volume_on.png")]
		public static const VOLUME_ON:Class;
		[Embed (source="assets/rewind.png")]
		public static const REWIND:Class;
		
		[Bindable]
		public var isConnected:Boolean = false;
		
		private var mediaElement:MediaElement;
		private var factory:WMSMediaFactory = new WMSMediaFactory();
		private var player:MediaPlayer = new MediaPlayer();
		private var isScrubbing:Boolean = false;
		private var fullscreenCapable:Boolean = false;
		private var hardwareScaleCapable:Boolean = false;
		private var saveVideoObjX:Number;
		private var saveVideoObjY:Number;
		private var saveVideoObjW:Number;
		private var saveVideoObjH:Number;
		private var saveStageW:Number;
		private var saveStageH:Number;
		private var adjVideoObjW:Number;
		private var adjVideoObjH:Number;
		private var streamName:String;
		private var netconnection:NetConnection;		
		private var PlayVersionMin:Boolean;
		private var streamNames:XML;
		private var streamsVector:Vector.<DynamicStreamingItem> = new Vector.<DynamicStreamingItem>();			
		private var dynResource:DynamicStreamingResource = null;
		public var prompt:Text;
		public var warn:Text;
		public var connectStr:TextInput;
		public var videoBackground:Label;
		public var videoFrame:spark.components.TextArea;
		public var playerVersion:Text;
		public var videoContainer:MediaContainerUIComponent;
		public var connectButton:Button;
		public var doPlay:Image;
		public var doMute:Image;
		public var seekBar:Slider;
		public var doRewind:Image;
		public var doFullscreen:Image;
		public var streamForm:Form
		private var muted:Boolean=false;
		private var fullscreen:Boolean=false;
		public var volumeContainer:BorderContainer;
		public var sliderTrack:HRule;
		public var sliderBug:Image;
		private var knobWidth:Number;
		private var trackWidth:Number;
		private var trackX:Number;
		private var boundsWidth:Number;
		private var boundsRect:Rectangle;
		private var draggingBug:Boolean=false;
		private var sliderBugY:Number;
		public var backdrop:Canvas;
		public var currentBitrate:Label;

		public var app:Application;
		
		public function Player()
		{
			super();
			this.addEventListener(FlexEvent.APPLICATION_COMPLETE,init);
		}
		
		private function init(event:FlexEvent):void
		{	
			stage.align="TL";
			stage.color=0;
			stage.scaleMode="showAll";
			
			connectButton.addEventListener(MouseEvent.CLICK,connect);
			
			try {
				connectStr.text = ExternalInterface.call("getLiveHTTPStream");
			}
			catch(e:Error) {
			}
			if(connectStr.text == null || connectStr.text=="")
			{
				connectStr.text = "http://localhost:1935/live/myStream/manifest.f4m";
			}
			
			// *********************** stream examples ******************//
			// http://localhost:1935/live/myStream/manifest.f4m
			// http://localhost:1935/live/smil:liveStreamNames.smil/manifest.f4m (server-side smil)
			// rtmp://localhost:1935/live/myStream
			// rtmp://localhost:1935/live/streamNames.xml (Dynamic Streams)
				
			OSMFSettings.enableStageVideo = true;
			
			videoContainer.container = new MediaContainer();

			checkVersion();
		
			var osmfVersion:String = org.osmf.utils.Version.version;
				
			playerVersion.text = Capabilities.version + " (Flash-OSMF " + osmfVersion + ")";
			
			
			saveStageW = backdrop.width;
			saveStageH = backdrop.height;
			
			saveVideoObjX = backdrop.x;
			saveVideoObjY = backdrop.y;
			saveVideoObjW = backdrop.width;
			saveVideoObjH = backdrop.height;

			doFullscreen.addEventListener(MouseEvent.CLICK,enterFullscreen);
			doMute.addEventListener(MouseEvent.CLICK, muteSound);
			stage.addEventListener(FullScreenEvent.FULL_SCREEN, enterLeaveFullscreen);
			connectButton.addEventListener(MouseEvent.CLICK,connect);
			doPlay.addEventListener(MouseEvent.CLICK,togglePlayPause);
			doRewind.addEventListener(MouseEvent.CLICK,rewind);
			knobWidth=sliderBug.width;
			trackWidth=sliderTrack.width;
			trackX=sliderTrack.x;
			boundsWidth=trackWidth-knobWidth;
			sliderBugY=sliderBug.y;
			boundsRect=new Rectangle(trackX,sliderBugY,boundsWidth,0);
			sliderBug.addEventListener(MouseEvent.MOUSE_DOWN, sliderBugMouseDown);
			//sliderBug.addEventListener(MouseEvent.MOUSE_UP, sliderBugMouseUp);
			addEventListener(MouseEvent.MOUSE_UP, sliderBugMouseUp);
			volumeContainer.addEventListener(MouseEvent.CLICK, sliderBugClick);
			sliderTrack.addEventListener(MouseEvent.CLICK, sliderBugClick);
			
			addEventListener(MouseEvent.MOUSE_MOVE, sliderBugOver);
			
			try {
				ExternalInterface.addCallback("playerStop", stopAll);
				ExternalInterface.addCallback("setStream", setStream);
				ExternalInterface.addCallback("setDVR", setDVR);
			}
			catch(e:Error) {
				prompt.text=""+e;
			}
			var updateTimer:Timer = new Timer(500,0);
			updateTimer.addEventListener(TimerEvent.TIMER, updateBitrate);
			updateTimer.start();
		}
		
		private function togglePlayPause(event:MouseEvent):void
		{
			if(!isConnected) {
				connect(event);
				prompt.text="Playing"
				doPlay.source=PAUSE;
				return;
			}
			if (player.playing)
			{
				prompt.text="Paused"
				player.pause();
				doPlay.source=PLAY;
			}
			else
			{
				prompt.text="Playing"
				player.play();
				doPlay.source=PAUSE;
			}
		}
		
		private function updateBitrate(event:TimerEvent):void
		{
			if(player !=null && factory.httpStreamingNetLoader != null && factory.httpStreamingNetLoader.getNetStream() != null) {
				currentBitrate.text="Current bitrate: "+ Math.round((factory.httpStreamingNetLoader.getNetStream().info.playbackBytesPerSecond*8)/1000)+"kbps";
			} else {
				currentBitrate.text="";
			}
		}
		public function setStream(stream:String):void
		{
			connectStr.text = stream;
		}
		public function setDVR(dvr:Boolean):void
		{
			doRewind.visible=dvr;
		}
		
		private function sliderBugMouseDown(event:MouseEvent):void
		{
			if(!isConnected) {
				return
			}
			sliderBug.y=sliderBugY;
			sliderBug.startDrag(false, boundsRect);
			draggingBug=true;
			player.volume = sliderBug.x/sliderTrack.width;
			muted = false;
			doMute.source=VOLUME_ON;
		}
		private function sliderBugOver(event:MouseEvent):void
		{
			sliderBug.y=sliderBugY;
			if(!isConnected || draggingBug==false ) {
				return
			}
			player.volume = sliderBug.x/sliderTrack.width;
			muted = false;
			doMute.source=VOLUME_ON;
		}
		private function sliderBugMouseUp(event:MouseEvent):void
		{
			if(!isConnected) {
				return
			}
			sliderBug.stopDrag();
			draggingBug=false;
		}
		
		private function sliderBugClick(event:MouseEvent):void
		{
			if(!isConnected) {
				return
			}
			sliderBug.x = volumeContainer.globalToLocal(new Point(mouseX, mouseY)).x-event.localX;
			player.volume=sliderBug.x/sliderTrack.width;
		}
		
		private function muteSound(event:MouseEvent):void
		{
			if(!isConnected) {
				return;
			}
			if(muted) {
				muted = false;
				doMute.source=VOLUME_ON;
				player.volume=sliderBug.x/sliderTrack.width;
			} else {
				muted = true;
				doMute.source=VOLUME_OFF;
				player.volume=0;
			}
		}
				
		private function xmlIOErrorHandler(event:IOErrorEvent):void
		{
			trace("XML IO Error: " + event.target);
			prompt.text = "XML IO Error: " + event.text;	
		}
		
		private function stopAll():void
		{		
			if (player.playing)
				player.stop();
			
			isConnected = false;
			
			if (mediaElement != null)
				videoContainer.container.removeMediaElement(mediaElement);
			
			mediaElement = null;
			netconnection = null;
			connectButton.label = "Start";
			doPlay.source = PLAY;
			dynResource = null;
			prompt.text = "";
		}
		
		private function clear():void
		{
			prompt.text = "";
			dynResource = null;
		}
		
		private function connect(event:MouseEvent):void // Play button (connectButton)
		{
			if (connectButton.label == "Stop")
			{
				stopAll();
				return;
			}
			var ok:Boolean = checkVersion();
			if (!ok)
			{
				stopAll();
				return;
			}
			clear();
			if (connectStr.text.toLowerCase().indexOf("rtmp://")>-1 && connectStr.text.toLowerCase().indexOf(".xml")>-1)
				streamName = connectStr.text.substring(connectStr.text.lastIndexOf("/")+1, connectStr.text.length);
			
			if (streamName == null)
			{
				loadStream();
			}
			else if (streamName.toLowerCase().indexOf(".xml") > 0)
			{	
				loadVector(streamName); // load Dynamic stream items first if stream name is a xml file
			}
		}
		
		private function loadVector(streamName:String):void
		{
			var url:String = connectStr.text;
						
			var loader:URLLoader=new URLLoader();
			loader.addEventListener(Event.COMPLETE,xmlHandler);
			loader.addEventListener(IOErrorEvent.IO_ERROR,xmlIOErrorHandler)			
			
			var request:URLRequest=new URLRequest();
			var requestURL:String = streamName;
			request.url = requestURL;
			
			loader.load(request)
		}
		
		private function xmlHandler(event:Event):void
		{
			var loader:URLLoader=URLLoader(event.target);
			streamNames = new XML(loader.data);
			
			var videos:XMLList = streamNames..video;
			
			for (var i:int=0; i<videos.length(); i++)
			{
				var video:XML = videos[i];
				var bitrate:String = video.attribute("system-bitrate");
				var item:DynamicStreamingItem = new DynamicStreamingItem(video.@src,Number(bitrate), video.@width, video.@height);
				streamsVector.push(item);
			}
			if (videos.length()>0)
			{
				dynResource = new DynamicStreamingResource(connectStr.text);				
				dynResource.streamItems = streamsVector;
			}
			loadStream();
		}
		
		private function loadStream():void
		{	
			mediaElement = factory.createMediaElement(new URLResource(connectStr.text));
			
			if (dynResource != null)
				mediaElement.resource=dynResource;
			
			player.media = mediaElement;	
			videoContainer.container.addMediaElement(mediaElement);	
			
			mediaElement.addEventListener(MediaErrorEvent.MEDIA_ERROR,function(event:MediaErrorEvent):void
			{
				trace("event.error.message: " + event.error.message);
				stopAll();
				
				if(event.error != null && event.error.detail != null && event.error.detail.indexOf("Error #2032") >= 0) {
					prompt.text = "Source stream or file could not be found or access was denied.";
				} else {
					prompt.text = event.error.message + " " + event.error.detail;
				}
				return;
			});
			
			player.addEventListener(MediaPlayerCapabilityChangeEvent.CAN_PLAY_CHANGE, function(event:MediaPlayerCapabilityChangeEvent):void
			{
				isConnected = event.enabled;
				
				if (isConnected)
				{
					stage.addEventListener(FullScreenEvent.FULL_SCREEN, enterLeaveFullscreen);
				}else
				{
					stage.removeEventListener(FullScreenEvent.FULL_SCREEN, enterLeaveFullscreen);
				}
			});
			
			player.autoPlay = true;
			doPlay.source = PAUSE;
			connectButton.label  = "Stop";
//			videoBackground.visible=false;			

		}

		private function enterLeaveFullscreen(event:FullScreenEvent):void
		{
			trace("enterLeaveFullscreen: "+ event.fullScreen);
			if (!event.fullScreen)
			{		
				// reset back to original state
				streamForm.visible = true;
				stage.displayState = StageDisplayState.NORMAL; 
				stage.scaleMode = "showAll";
				backdrop.width = saveVideoObjW;
				backdrop.height = saveVideoObjH;
				backdrop.x = saveVideoObjX;
				backdrop.y = saveVideoObjY;
				//backdrop.visible=true;
				//prompt.text="hardware cap=" + hardwareScaleCapable + "  wmodeGPU=" + stage.wmodeGPU + "  support=" + OSMFSettings.supportsStageVideo;
				doFullscreen.source=FULLSCREEN;
			}
		}
		
		private function enterFullscreen(event:MouseEvent):void
		{
			if(doFullscreen.source==NORMALSCREEN) {
				var fse:FullScreenEvent = new FullScreenEvent("normal",true,true,false);
				enterLeaveFullscreen(fse);
				return;
			}
			trace("enterFullscreen: "+hardwareScaleCapable);
			streamForm.visible=false;

			if (hardwareScaleCapable)
			{				
				// grab the portion of the stage that is just the video frame
				//backdrop.visible=false;
				
				stage.fullScreenSourceRect = new Rectangle(
					backdrop.x, backdrop.y, 
					backdrop.width, backdrop.height);
			}
			else
			{
				stage.scaleMode = "showAll";
				
				var videoAspectRatio:Number = videoContainer.width/videoContainer.height;
				var stageAspectRatio:Number = saveStageW/saveStageH;
				var screenAspectRatio:Number = Capabilities.screenResolutionX/Capabilities.screenResolutionY;
				
				// calculate the width and height of the scaled stage
				var stageObjW:Number = saveStageW;
				var stageObjH:Number = saveStageH;
				if (stageAspectRatio > screenAspectRatio)
					stageObjW = saveStageH*screenAspectRatio;
				else
					stageObjH = saveStageW/screenAspectRatio;
				
				// calculate the width and height of the video frame scaled against the new stage size
				var fsvideoContainerW:Number = stageObjW;
				var fsvideoContainerH:Number = stageObjH;
				
				if (videoAspectRatio > screenAspectRatio)
					fsvideoContainerH = stageObjW/videoAspectRatio;			
				else
					fsvideoContainerW = stageObjH*videoAspectRatio;
				// scale the video object
				videoContainer.width = fsvideoContainerW;
				videoContainer.height = fsvideoContainerH;
				videoContainer.x = (stageObjW-fsvideoContainerW)/2.0;
				videoContainer.y = (stageObjH-fsvideoContainerH)/2.0;

			}
			stage.displayState = StageDisplayState.FULL_SCREEN;
			doFullscreen.source=NORMALSCREEN;
		}
		private function rewind(event:MouseEvent):void
		{
			if(player != null) {
				
				player.seek(player.currentTime-20);
				seekBar.value = 0;
			}
		}
		
		private function checkVersion():Boolean
		{
			PlayVersionMin = testVersion(10, 1, 0, 0);
			hardwareScaleCapable = testVersion(9, 0, 60, 0);
			hardwareScaleCapable = true;
			if (!PlayVersionMin && connectStr.text.indexOf(".f4m") > 0)
			{
				prompt.text = "Sanjose Streaming not support in this Flash version.";
				return false;
			}
			else
			{
				//prompt.text="hardware cap=" + hardwareScaleCapable + "  wmodeGPU=" + stage.wmodeGPU + "  support=" + OSMFSettings.supportsStageVideo;
				return true;
			}
		}
		
		private function testVersion(v0:Number, v1:Number, v2:Number, v3:Number):Boolean
		{
			var version:String = Capabilities.version;
			var index:Number = version.indexOf(" ");
			version = version.substr(index+1);
			var verParts:Array = version.split(",");
			
			var i:Number;
			
			var ret:Boolean = true;
			while(true)
			{
				if (Number(verParts[0]) < v0)
				{
					ret = false;
					break;
				}
				else if (Number(verParts[0]) > v0)
					break;
				
				if (Number(verParts[1]) < v1)
				{
					ret = false;
					break;
				}
				else if (Number(verParts[1]) > v1)
					break;
				
				if (Number(verParts[2]) < v2)
				{
					ret = false;
					break;
				}
				else if (Number(verParts[2]) > v2)
					break;
				
				if (Number(verParts[3]) < v3)
				{
					ret = false;
					break;
				}
				break;
			}
			trace("testVersion: "+Capabilities.version+">="+v0+","+v1+","+v2+","+v3+": "+ret);	
			return ret;
		}
	}
}