package com.wowza
{
	import flash.net.NetConnection;
	import flash.net.NetStream;
	
	import org.osmf.media.URLResource;
	import org.osmf.net.httpstreaming.HTTPStreamingNetLoader;
	
	public class WMSHttpStreamingNetLoader extends HTTPStreamingNetLoader
	{
		private var netStream:NetStream;
		public function WMSHttpStreamingNetLoader()
		{
			super();
		}
		
		override protected function createNetStream(connection:NetConnection, resource:URLResource):NetStream
		{
			netStream = super.createNetStream(connection, resource);
			return netStream;
		}
		
		public function getNetStream():NetStream
		{
			return netStream;
		}
	}
}