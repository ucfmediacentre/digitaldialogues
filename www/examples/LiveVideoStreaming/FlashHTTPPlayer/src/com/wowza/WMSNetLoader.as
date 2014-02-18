package com.wowza
{
	import flash.net.NetConnection;
	import flash.net.NetStream;
	
	import org.osmf.media.URLResource;
	import org.osmf.net.NetLoader;

	public class WMSNetLoader extends NetLoader
	{
		private var netStream:NetStream;
		public function WMSNetLoader()
		{
			super();
		}
		/*
		 * This should really be a map of URLResource to NetStream but in our case should work
		*/
		override protected function createNetStream(connection:NetConnection, resource:URLResource):NetStream {
			netStream = super.createNetStream(connection, resource);
			return netStream;
		}
		
		public function getNetStream():NetStream {
			return netStream;
		}
	}
}