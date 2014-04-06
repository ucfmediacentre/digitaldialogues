/*****************************************************
 *  
 *  Copyright 2009 Adobe Systems Incorporated.  All Rights Reserved.
 *  
 *****************************************************
 *  The contents of this file are subject to the Mozilla Public License
 *  Version 1.1 (the "License"); you may not use this file except in
 *  compliance with the License. You may obtain a copy of the License at
 *  http://www.mozilla.org/MPL/
 *   
 *  Software distributed under the License is distributed on an "AS IS"
 *  basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
 *  License for the specific language governing rights and limitations
 *  under the License.
 *   
 *  
 *  The Initial Developer of the Original Code is Adobe Systems Incorporated.
 *  Portions created by Adobe Systems Incorporated are Copyright (C) 2009 Adobe Systems 
 *  Incorporated. All Rights Reserved. 
 *  
 *****************************************************/
package com.wowza
{
	import org.osmf.elements.AudioElement;
	import org.osmf.elements.F4MElement;
	import org.osmf.elements.F4MLoader;
	import org.osmf.elements.ImageElement;
	import org.osmf.elements.ImageLoader;
	import org.osmf.elements.SWFElement;
	import org.osmf.elements.SWFLoader;
	import org.osmf.elements.SoundLoader;
	import org.osmf.elements.VideoElement;
	import org.osmf.media.MediaElement;
	import org.osmf.media.MediaFactory;
	import org.osmf.media.MediaFactoryItem;
	import org.osmf.net.NetLoader;
	import org.osmf.net.dvr.DVRCastNetLoader;
	import org.osmf.net.rtmpstreaming.RTMPDynamicStreamingNetLoader;
	
	CONFIG::FLASH_10_1
	{
		import org.osmf.net.httpstreaming.HTTPStreamingNetLoader;
		import org.osmf.net.MulticastNetLoader;
	}
	
	
	/**
	 * WMSMediaFactory is copied from DefaultMediaFactory but returns WMS specific loaders
	 * so we can capture the NetStream to retrieve bitrate data during playback
	 */	
	public class WMSMediaFactory extends MediaFactory
	{
		/**
		 * Constructor.
		 *  
		 *  @langversion 3.0
		 *  @playerversion Flash 10
		 *  @playerversion AIR 1.5
		 *  @productversion OSMF 1.0
		 */		
		public function WMSMediaFactory()
		{
			super();
			
			init();
		}
		
		// Internals
		//
		
		private function init():void
		{
			f4mLoader = new F4MLoader(this);
			addItem 
			( new MediaFactoryItem
				( "org.osmf.elements.f4m"
					, f4mLoader.canHandleResource
					, function():MediaElement
					{
						return new F4MElement(null, f4mLoader);
					}
				)
			);
			
			dvrCastLoader = new DVRCastNetLoader();
			addItem
			( new MediaFactoryItem
				( "org.osmf.elements.video.dvr.dvrcast"
					, dvrCastLoader.canHandleResource
					, function():MediaElement
					{
						return new VideoElement(null, dvrCastLoader);
					}
				)
			);
			
			CONFIG::FLASH_10_1
			{
				httpStreamingNetLoader = new WMSHttpStreamingNetLoader();
				addItem
				( new MediaFactoryItem
					( "org.osmf.elements.video.httpstreaming"
						, httpStreamingNetLoader.canHandleResource
						, function():MediaElement
						{
							return new VideoElement(null, httpStreamingNetLoader);
						}
					)
				);
				
				multicastLoader = new MulticastNetLoader();
				addItem
				( new MediaFactoryItem
					( "org.osmf.elements.video.rtmfp.multicast"
						, multicastLoader.canHandleResource
						, function():MediaElement
						{
							return new VideoElement(null, multicastLoader);
						}
					)
				);
			}
			
			rtmpStreamingNetLoader = new RTMPDynamicStreamingNetLoader();
			addItem
			( new MediaFactoryItem
				( "org.osmf.elements.video.rtmpdynamicStreaming"
					, rtmpStreamingNetLoader.canHandleResource
					, function():MediaElement
					{
						return new VideoElement(null, rtmpStreamingNetLoader);
					}
				)
			);
			
			netLoader = new WMSNetLoader();
			addItem
			( new MediaFactoryItem
				( "org.osmf.elements.video"
					, netLoader.canHandleResource
					, function():MediaElement
					{
						return new VideoElement(null, netLoader);
					}
				)
			);		
			
			soundLoader = new SoundLoader();
			addItem
			( new MediaFactoryItem
				( "org.osmf.elements.audio"
					, soundLoader.canHandleResource
					, function():MediaElement
					{
						return new AudioElement(null, soundLoader);
					}
				)
			);
			
			addItem
			( new MediaFactoryItem
				( "org.osmf.elements.audio.streaming"
					, netLoader.canHandleResource
					, function():MediaElement
					{
						return new AudioElement(null, netLoader);
					}
				)
			);
			
			imageLoader = new ImageLoader();
			addItem
			( new MediaFactoryItem
				( "org.osmf.elements.image"
					, imageLoader.canHandleResource
					, function():MediaElement
					{
						return new ImageElement(null, imageLoader);
					}
				)
			);
			
			swfLoader = new SWFLoader();
			addItem
			( new MediaFactoryItem
				( "org.osmf.elements.swf"
					, swfLoader.canHandleResource
					, function():MediaElement
					{
						return new SWFElement(null, swfLoader);
					}
				)
			);
		}
		
		private var rtmpStreamingNetLoader:RTMPDynamicStreamingNetLoader;
		private var f4mLoader:F4MLoader;
		private var dvrCastLoader:DVRCastNetLoader;
		private var imageLoader:ImageLoader;
		private var swfLoader:SWFLoader;
		private var soundLoader:SoundLoader;
		
		CONFIG::FLASH_10_1
		{
			public var httpStreamingNetLoader:WMSHttpStreamingNetLoader;
			public var netLoader:WMSNetLoader;
			private var multicastLoader:MulticastNetLoader;
		}
	}
}
