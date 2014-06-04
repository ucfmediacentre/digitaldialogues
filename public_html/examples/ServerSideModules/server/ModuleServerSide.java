package com.mycompany.wms.module;

import java.util.*;

import com.wowza.wms.module.*;
import com.wowza.wms.client.*;
import com.wowza.wms.amf.*;
import com.wowza.wms.request.*;
import com.wowza.wms.logging.*;

public class ModuleServerSide extends ModuleBase
{
	// receiving simple parameters from the client
	public void c2sParamsSimple(IClient client, RequestFunction function, AMFDataList params)
	{
		String res = "";
		WMSLogger log = getLogger();

		String param1 = getParamString(params, PARAM1);
		int param2 = getParamInt(params, PARAM2);
		boolean param3 = getParamBoolean(params, PARAM3);
		Date param4 = getParamDate(params, PARAM4);

		res += "param1: "+param1+"\n";
		res += "param2: "+param2+"\n";
		res += "param3: "+param3+"\n";
		res += "param4: "+param4+"\n";

		log.info(res);

		sendResult(client, params, res);
	}

	// receiving an object from the client
	public void c2sParamsObject(IClient client, RequestFunction function, AMFDataList params)
	{
		String res = "";
		WMSLogger log = getLogger();

		AMFDataObj param1 = (AMFDataObj)getParam(params, PARAM1);

		// direct method for getting object properties
		String val1 = param1.getString("val1");
		int val2 = param1.getInt("val2");
		boolean val3 = param1.getBoolean("val3");
		Date val4 = param1.getDate("val4");


		res += "\nDirect\n";
		res += "param1: val1="+val1+"\n";
		res += "param1: val2="+val2+"\n";
		res += "param1: val3="+val3+"\n";
		res += "param1: val4="+val4+"\n";

		res += "\nInspect\n";

		// method to inspect object to discover properties
		List keys = param1.getKeys();
		Iterator iter = keys.iterator();
		while(iter.hasNext())
		{
			String key = (String)iter.next();
			AMFDataItem value = (AMFDataItem)param1.get(key);
			String typeStr = "unknown";

			switch (value.getType())
			{
			default:
			case AMFDataItem.DATA_TYPE_UNDEFINED:
			case AMFDataItem.DATA_TYPE_UNKNOWN:
			case AMFDataItem.DATA_TYPE_NULL:
				typeStr = "null";
				break;
			case AMFDataItem.DATA_TYPE_NUMBER:
				typeStr = "number";
				// to extract value use intValue(), shortValue(), longValue(), doubleValue(), floatValue(), byteValue()
				break;
			case AMFDataItem.DATA_TYPE_BOOLEAN:
				typeStr = "boolean";
				// to extract value use booleanValue()
				break;
			case AMFDataItem.DATA_TYPE_STRING:
				typeStr = "string";
				break;
			case AMFDataItem.DATA_TYPE_DATE:
				typeStr = "date";
				break;
			}

			res += "param1: "+key+"="+value.toString()+" ("+typeStr+")"+"\n";
		}

		log.info(res);

		sendResult(client, params, res);
	}

	// receiving an array of strings from the client
	public void c2sParamsArray(IClient client, RequestFunction function, AMFDataList params)
	{
		String res = "";
		WMSLogger log = getLogger();

		AMFDataMixedArray param1 = getParamMixedArray(params, PARAM1);

		int len = param1.size();
		for(int i=0;i<len;i++)
		{
			String value = param1.getString(i);
			res += "param1: ["+i+":"+param1.getKey(i)+"]="+value+"\n";
		}

		log.info(res);

		sendResult(client, params, res);
	}

	// receiving an array of objects from the client
	public void c2sParamsArrayOfObjects(IClient client, RequestFunction function, AMFDataList params)
	{
		String res = "";
		WMSLogger log = getLogger();

		AMFDataMixedArray param1 = getParamMixedArray(params, PARAM1);

		int len = param1.size();
		for(int i=0;i<len;i++)
		{
			AMFDataObj valueObj = param1.getObject(i);
			res += "param1: ["+i+":"+param1.getKey(i)+"]"+"\n";

			String val1 = valueObj.getString("val1");
			int val2 = valueObj.getInt("val2");
			boolean val3 = valueObj.getBoolean("val3");
			Date val4 = valueObj.getDate("val4");

			res += "val1: "+val1+"\n";
			res += "val2: "+val2+"\n";
			res += "val3: "+val3+"\n";
			res += "val4: "+val4+"\n";
		}

		log.info(res);

		sendResult(client, params, res);
	}

	// returning a string to the client
	public void c2sReturnString(IClient client, RequestFunction function, AMFDataList params)
	{
		String res = "";
		WMSLogger log = getLogger();

		res = "Hello Wowza";

		log.info(res);

		sendResult(client, params, res);
	}

	// returning an integer to the client
	public void c2sReturnInt(IClient client, RequestFunction function, AMFDataList params)
	{
		String res = "";
		WMSLogger log = getLogger();

		int resInt = 4325;
		res = "int="+resInt;

		log.info(res);

		sendResult(client, params, resInt);
	}

	// returning a boolean to the client
	public void c2sReturnBoolean(IClient client, RequestFunction function, AMFDataList params)
	{
		String res = "";
		WMSLogger log = getLogger();

		boolean resBoolean = true;
		res = "boolean="+resBoolean;

		log.info(res);

		sendResult(client, params, resBoolean);
	}

	// returning an array of strings
	public void c2sReturnArray(IClient client, RequestFunction function, AMFDataList params)
	{
		String res = "";
		WMSLogger log = getLogger();

		AMFDataArray retArray = new AMFDataArray();

		retArray.add(new AMFDataItem("Hello Wowza 1"));
		retArray.add(new AMFDataItem("Hello Wowza 2"));
		retArray.add(new AMFDataItem("Hello Wowza 3"));

		res = retArray.toString();
		log.info(res);

		sendResult(client, params, retArray);
	}

	// returning an object to the client
	public void c2sReturnObject(IClient client, RequestFunction function, AMFDataList params)
	{
		String res = "";
		WMSLogger log = getLogger();

		AMFDataObj retObj = new AMFDataObj();

		retObj.put("val1", new AMFDataItem("Hello Wowza 1"));
		retObj.put("val2", new AMFDataItem(3456));
		retObj.put("val3", new AMFDataItem(true));

		res = retObj.toString();
		log.info(res);

		sendResult(client, params, retObj);
	}

	// returning an array objects to the client
	public void c2sReturnArrayOfObjects(IClient client, RequestFunction function, AMFDataList params)
	{
		String res = "";
		WMSLogger log = getLogger();

		AMFDataArray retArray = new AMFDataArray();
		AMFDataObj retObj = null;

		retObj = new AMFDataObj();
		retObj.put("val1", new AMFDataItem("Hello Wowza 1"));
		retObj.put("val2", new AMFDataItem(3456));
		retObj.put("val3", new AMFDataItem(true));
		retArray.add(retObj);

		retObj = new AMFDataObj();
		retObj.put("val1", new AMFDataItem("Hello Wowza 2"));
		retObj.put("val2", new AMFDataItem(3457));
		retObj.put("val3", new AMFDataItem(true));
		retArray.add(retObj);

		retObj = new AMFDataObj();
		retObj.put("val1", new AMFDataItem("Hello Wowza 3"));
		retObj.put("val2", new AMFDataItem(3458));
		retObj.put("val3", new AMFDataItem(true));
		retArray.add(retObj);

		res = retArray.toString();
		log.info(res);

		sendResult(client, params, retArray);
	}

	// calling from the server to the client

	public void s2cCallback(IClient client, RequestFunction function, AMFDataList params)
	{
		String handlerName = getParamString(params, PARAM1);

		// calling the client and sending simple parameters
		if (handlerName.equals("s2cParamsSimple"))
		{
			class s2cParamsSimpleResult extends ModuleBase implements IModuleCallResult
			{
				public void onResult(IClient client, RequestFunction function, AMFDataList params)
				{
					WMSLogger log = getLogger();
					String param1 = getParamString(params, PARAM1);
					log.info(param1);
				}
			}

			client.call(handlerName, new s2cParamsSimpleResult(), "Hello Wowza", 1432, true, new Date());
		}

		// calling the client and sending an object
		else if (handlerName.equals("s2cParamsObject"))
		{
			class s2cParamsObjectResult extends ModuleBase implements IModuleCallResult
			{
				public void onResult(IClient client, RequestFunction function, AMFDataList params)
				{
					WMSLogger log = getLogger();
					AMFDataObj param1 = getParamObj(params, PARAM1);
					log.info(param1.toString());
				}
			}

			AMFDataObj retObj = new AMFDataObj();
			retObj.put("val1", new AMFDataItem("Hello Wowza"));
			retObj.put("val2", new AMFDataItem(3456));
			retObj.put("val3", new AMFDataItem(true));

			client.call(handlerName, new s2cParamsObjectResult(), retObj);
		}

		// calling the client and sending an array of strings
		else if (handlerName.equals("s2cParamsArray"))
		{
			class s2cParamsArrayResult extends ModuleBase implements IModuleCallResult
			{
				public void onResult(IClient client, RequestFunction function, AMFDataList params)
				{
					WMSLogger log = getLogger();
					AMFDataMixedArray param1 = getParamMixedArray(params, PARAM1);
					log.info(param1.toString());
				}
			}

			AMFDataArray retArray = new AMFDataArray();

			retArray.add(new AMFDataItem("Hello Wowza 1"));
			retArray.add(new AMFDataItem("Hello Wowza 2"));
			retArray.add(new AMFDataItem("Hello Wowza 3"));

			client.call(handlerName, new s2cParamsArrayResult(), retArray);
		}

		// calling the client and sending an array of objects
		else if (handlerName.equals("s2cParamsArrayOfObjects"))
		{
			class s2cParamsArrayOfObjectsResult extends ModuleBase implements IModuleCallResult
			{
				public void onResult(IClient client, RequestFunction function, AMFDataList params)
				{
					WMSLogger log = getLogger();
					AMFDataMixedArray param1 = getParamMixedArray(params, PARAM1);
					log.info(param1.toString());
				}
			}

			AMFDataArray retArray = new AMFDataArray();
			AMFDataObj retObj = null;

			retObj = new AMFDataObj();
			retObj.put("val1", new AMFDataItem("Hello Wowza 1"));
			retObj.put("val2", new AMFDataItem(3456));
			retObj.put("val3", new AMFDataItem(true));
			retArray.add(retObj);

			retObj = new AMFDataObj();
			retObj.put("val1", new AMFDataItem("Hello Wowza 2"));
			retObj.put("val2", new AMFDataItem(3457));
			retObj.put("val3", new AMFDataItem(true));
			retArray.add(retObj);

			retObj = new AMFDataObj();
			retObj.put("val1", new AMFDataItem("Hello Wowza 3"));
			retObj.put("val2", new AMFDataItem(3458));
			retObj.put("val3", new AMFDataItem(true));
			retArray.add(retObj);

			client.call(handlerName, new s2cParamsArrayOfObjectsResult(), retArray);
		}
	}
}

