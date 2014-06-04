package com.mycompany.wms.module;

import java.util.*;

import com.wowza.wms.module.*;
import com.wowza.wms.client.*;
import com.wowza.wms.amf.*;
import com.wowza.wms.request.*;
import com.wowza.wms.logging.*;

public class MyFirstModule extends ModuleBase
{
	public void doSomething(IClient client, RequestFunction function, AMFDataList params)
	{
		getLogger().info("doSomething");
		sendResult(client, params, "Hello World");
	}

	public void onAppStart(IApplicationInstance appInstance)
	{
		getLogger().info("onAppStart: "+appInstance.getApplication().getName()+"/"+appInstance.getName());
	}

	public void onAppStop(IApplicationInstance appInstance)
	{
		getLogger().info("onAppStop: "+appInstance.getApplication().getName()+"/"+appInstance.getName());
	}

	public void onConnect(IClient client, RequestFunction function, AMFDataList params)
	{
		getLogger().info("onConnect: "+client.getClientId());
	}

	public void onDisconnect(IClient client)
	{
		getLogger().info("onDisconnect: "+client.getClientId());
	}

	public void onConnectAccept(IClient client)
	{
		getLogger().info("onConnectAccept: "+client.getClientId());
	}

	public void onConnectReject(IClient client)
	{
		getLogger().info("onConnectReject: "+client.getClientId());
	}
}
