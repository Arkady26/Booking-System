// JavaScript Document
//var xmlhttp=false;
/*
function loadXMLDoc()
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

}
*/
function requestwithcondandindicatorfail(page,obj,nxtfun,failfun,objloading)
{
	var ob=document.getElementById(obj);
	var obcall=document.getElementById(obj);
	//ob.innerHTML='<img src="../images/loading.gif" />';
	var obloading=document.getElementById(objloading);
	obloading.style.display='block';
	//alert(page);
	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","temp1div");
	xmlhttp.open("GET",page,true);
	page=page+ "&timestamp="+ new Date().getTime() + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			nwdiv.innerHTML=xmlhttp.responseText;
			if(nwdiv.getElementsByTagName('div').length>0)
			{
				if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
				{
					ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
				}
				else
				{
					ob.innerHTML=xmlhttp.responseText;
				}
			}
			else
			{
				ob.innerHTML=xmlhttp.responseText;
			}
				obloading.style.display='none';
				if(obcall.innerHTML=='successfully')
				{
					//alert('successfully');
					nxtfun();	
				}
				else
				{
					
					failfun();
				}
				
		}
	}
	xmlhttp.send(null);	
}
function requesttmp(page,obj,content)
{
	//alert(page);
	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","temp1div");
	//alert(nwdiv.id);
	var ob=document.getElementById(obj);
	xmlhttp.open("POST",page,true);
//	page=page+ "&content="+ content + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			//alert(xmlhttp.responseText);
			nwdiv.innerHTML=xmlhttp.responseText;
		//	alert(xmlhttp.responseText);
			//alert(nwdiv.getElementsByTagName('div').item(0).id);
	//		alert(nwdiv.getElementsByTagName('div').item(0).id + '   ' + ob.id);
	//		alert(nwdiv.innerHTML);
			if(nwdiv.getElementsByTagName('div').length>0)
			{
				if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
				{
			//	alert('if');
					ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
				}
				else
				{
			//		alert('if else');
					ob.innerHTML=xmlhttp.responseText;
				}
			}
			else
			{
			//	alert('else');
			//nwdiv.innerHTML=xmlhttp.responseText;
			//document.t
			//
				ob.innerHTML=xmlhttp.responseText;
			}
		
	//		alert(nwdiv.innerHTML);
			//alert(ob.innerHTML);
			
			//alert(res.id);
			//ob.value=xmlhttp.responseText;
		}
	}
	//alert(content);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(content);	
}

function getHTTPObject() {

  var xmlhttp;

  /*@cc_on

  @if (@_jscript_version >= 5)

    try {

      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

    } catch (e) {

      try {

        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

      } catch (E) {

        xmlhttp = false;

      }

    }

  @else

  xmlhttp = false;

  @end @*/

  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {

    try {

      xmlhttp = new XMLHttpRequest();

    } catch (e) {

      xmlhttp = false;

    }

  }

  return xmlhttp;
}
var t;
function request(page,obj)
{
	var ob=document.getElementById(obj);
	//ob.innerHTML='<img src="../images/loading.gif" />';
	var obloading=document.getElementById('loading');
	obloading.style.display='block';
	
	//alert(ob);
	//alert(page);
	//alert(obloading);
	
	obloading.style.top=ob.offsetTop + (ob.offsetHeight/2) +'px';
	
	obloading.style.left=(ob.offsetWidth/2) + ((958 - ob.offsetWidth)/2) +'px';


	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","temp1div");
	//alert(nwdiv.id);
	xmlhttp.open("GET",page,true);
	page=page+ "&timestamp="+ new Date().getTime() + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			nwdiv.innerHTML=xmlhttp.responseText;
			if(nwdiv.getElementsByTagName('div').length>0)
			{
				if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
				{
					ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
				}
				else
				{
					ob.innerHTML=xmlhttp.responseText;
				}
			}
			else
			{
				ob.innerHTML=xmlhttp.responseText;
			}
				//alert('stop');
				obloading.style.display='none';
		
		}
	}
	xmlhttp.send(null);	
}

function requestonly(page,obj)
{
	var ob=document.getElementById(obj);
	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","temp1div");
	//alert(nwdiv.id);
	xmlhttp.open("GET",page,true);
	page=page+ "&timestamp="+ new Date().getTime() + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			nwdiv.innerHTML=xmlhttp.responseText;
			if(nwdiv.getElementsByTagName('div').length>0)
			{
				if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
				{
					//ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
				}
				else
				{
					//ob.innerHTML=xmlhttp.responseText;
				}
			}
			else
			{
				//ob.innerHTML=xmlhttp.responseText;
			}
		}
	}
	xmlhttp.send(null);	
}


function requestwithindicator(page,obj,obloading)
{
//	alert('requestwithindicator');
	var ob=document.getElementById(obj);
	//ob.innerHTML='<img src="../images/loading.gif" />';
	var obloading=document.getElementById(obloading);
	obloading.style.display='block';
	
	//alert(ob.offsetTop);
	
//	obloading.style.top=ob.offsetTop + (ob.offsetHeight/2) +'px';
	
//	obloading.style.left=(ob.offsetWidth/2) + ((958 - ob.offsetWidth)/2) +'px';


	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","temp1div");
	//alert(nwdiv.id);
	xmlhttp.open("GET",page,true);
	page=page+ "&timestamp="+ new Date().getTime() + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			nwdiv.innerHTML=xmlhttp.responseText;
			if(nwdiv.getElementsByTagName('div').length>0)
			{
				if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
				{
					ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
				}
				else
				{
					ob.innerHTML=xmlhttp.responseText;
				}
			}
			else
			{
				ob.innerHTML=xmlhttp.responseText;
			}
				//alert('stop');
				obloading.style.display='none';
		}
	}
	xmlhttp.send(null);	
}

function requestwithindicatorbutton(page,obj,obloading,btnid)
{
	//alert(page);
//	alert(obj);
	//alert(obloading);
		//alert(btnid);
	var ob=document.getElementById(obj);
	//ob.innerHTML='<img src="../images/loading.gif" />';
	var obloading=document.getElementById(obloading);
	var btnid=document.getElementById(btnid);
	obloading.style.display='block';
	btnid.style.display='none';
	
	//alert(ob.offsetTop);
	
//	obloading.style.top=ob.offsetTop + (ob.offsetHeight/2) +'px';
	
//	obloading.style.left=(ob.offsetWidth/2) + ((958 - ob.offsetWidth)/2) +'px';


	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","temp1div");
	//alert(nwdiv.id);
	xmlhttp.open("GET",page,true);
	page=page+ "&timestamp="+ new Date().getTime() + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			nwdiv.innerHTML=xmlhttp.responseText;
			if(nwdiv.getElementsByTagName('div').length>0)
			{
				if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
				{
					ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
				}
				else
				{
					ob.innerHTML=xmlhttp.responseText;
				}
			}
			else
			{
				ob.innerHTML=xmlhttp.responseText;
			}
				//alert('stop');
				obloading.style.display='none';
				btnid.style.display='block';
		}
	}
	xmlhttp.send(null);	
}

function request1(page,obj,src)
{
	//alert(page);
	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","tempdiv");
	//alert(nwdiv.id);
	var ob=document.getElementById(obj);
	xmlhttp.open("GET",page,true);
	page=page+ "&timestamp="+ new Date().getTime() + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			document.getElementById(src).style.display="none";
			nwdiv.innerHTML=xmlhttp.responseText;
			if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
			{
				ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
			}
			else
			{
			ob.innerHTML=xmlhttp.responseText;
			}
		}
		else
		{
			document.getElementById(src).style.display="block";
		}
	}
	xmlhttp.send(null);	
}
function myrequest(page,obj)
{
	var ob=document.getElementById(obj);
	var obloading=document.getElementById('loading');
	obloading.style.top=ob.offsetHeight/2;
	//ob.innerHTML='<img style="top:'+ ob.height +' src="../images/loading.gif" />';
	
	
	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","temp1div");
	//alert(nwdiv.id);
	xmlhttp.open("GET",page,true);
	page=page+ "&timestamp="+ new Date().getTime() + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			nwdiv.innerHTML=xmlhttp.responseText;
			if(nwdiv.getElementsByTagName('div').length>0)
			{
				if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
				{
					ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
				}
				else
				{
					ob.innerHTML=xmlhttp.responseText;
				}
			}
			else
			{
				ob.innerHTML=xmlhttp.responseText;
			}
		}
	}
	xmlhttp.send(null);	
}

function requestwithcond(page,obj,nxtfun)
{
	//alert(page);alert(obj);
	var ob=document.getElementById(obj);
	var obcall=document.getElementById(obj);
	//ob.innerHTML='<img src="../images/loading.gif" />';
	var obloading=document.getElementById('loading');
	obloading.style.display='block';
	
	//alert(ob.offsetTop);
	
	obloading.style.top=ob.offsetTop + (ob.offsetHeight/2) +'px';
	
	obloading.style.left=(ob.offsetWidth/2) + ((958 - ob.offsetWidth)/2) +'px';


	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","temp1div");
	//alert(nwdiv.id);
	xmlhttp.open("GET",page,true);
	page=page+ "&timestamp="+ new Date().getTime() + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			nwdiv.innerHTML=xmlhttp.responseText;
			if(nwdiv.getElementsByTagName('div').length>0)
			{
				if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
				{
					ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
				}
				else
				{
					ob.innerHTML=xmlhttp.responseText;
				}
			}
			else
			{
				ob.innerHTML=xmlhttp.responseText;
			}
			
				obloading.style.display='none';
				if(obcall.innerHTML=='successfully')
				{
					nxtfun();
				//	alert(nxtfun);	
				}
		}
	}
	xmlhttp.send(null);	
}
function requestwithcondandindicator(page,obj,nxtfun,objloading,successmsg)
{
	//alert(nxtfun);
	//alert(successmsg);
	var ob=document.getElementById(obj);
	var obcall=document.getElementById(obj);
	//ob.innerHTML='<img src="../images/loading.gif" />';
	var obloading=document.getElementById(objloading);
	obloading.style.display='block';
	//alert(ob.offsetTop);
	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","temp1div");
	xmlhttp.open("GET",page,true);
	page=page+ "&timestamp="+ new Date().getTime() + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			nwdiv.innerHTML=xmlhttp.responseText;
			if(nwdiv.getElementsByTagName('div').length>0)
			{
				if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
				{
					ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
				}
				else
				{
					ob.innerHTML=xmlhttp.responseText;
				}
			}
			else
			{
				ob.innerHTML=xmlhttp.responseText;
			}
				//alert(obcall.innerHTML.length);
				//alert(successmsg);
				obloading.style.display='none';
				if(obcall.innerHTML==successmsg)
				{
					//alert('in');
					nxtfun();	
				}				
				//else
				//alert('out');
				//nxtfun();
		}
	}
	xmlhttp.send(null);	
}
function requestwithcondandindicatorbtn(page,obj,nxtfun,objloading,successmsg,btnid)
{
	//alert(nxtfun);
	//alert(successmsg);
	var ob=document.getElementById(obj);
	var obcall=document.getElementById(obj);
	//ob.innerHTML='<img src="../images/loading.gif" />';
	var obloading=document.getElementById(objloading);
	var btnid=document.getElementById(btnid);
	obloading.style.display='block';
	btnid.style.display='none';
	
	//alert(ob.offsetTop);
	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","temp1div");
	xmlhttp.open("GET",page,true);
	page=page+ "&timestamp="+ new Date().getTime() + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			nwdiv.innerHTML=xmlhttp.responseText;
			if(nwdiv.getElementsByTagName('div').length>0)
			{
				if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
				{
					ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
				}
				else
				{
					ob.innerHTML=xmlhttp.responseText;
				}
			}
			else
			{
				ob.innerHTML=xmlhttp.responseText;
			}
				//alert(obcall.innerHTML.length);
				//alert(successmsg);
				obloading.style.display='none';
				btnid.style.display='block';
				if(obcall.innerHTML==successmsg)
				{
					//alert('in');
					nxtfun();	
				}				
				//else
				//alert('out');
				//nxtfun();
		}
	}
	xmlhttp.send(null);	
}

function ajaxrequest(page,obj,nxtfun,objloading,successmsg,innerdata,loadingdiv,formname)
{
	//alert(nxtfun);
	//alert(objloading);
	var ob=document.getElementById(obj);
	var obcall=document.getElementById(obj);
	//ob.innerHTML='<img src="../images/loading.gif" />';
	var obloading=document.getElementById(objloading);
	obloading.style.display='block';
	//alert(ob.offsetTop);
	var xmlhttp= getHTTPObject();
	var nwdiv=document.createElement('div');
	nwdiv.setAttribute("id","temp1div");
	xmlhttp.open("GET",page,true);
	page=page+ "&timestamp="+ new Date().getTime() + "&rnd=" + Math.random();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4)
		{
			nwdiv.innerHTML=xmlhttp.responseText;
			if(nwdiv.getElementsByTagName('div').length>0)
			{
				if(nwdiv.getElementsByTagName('div').item(0).id==ob.id )
				{
					ob.innerHTML=nwdiv.getElementsByTagName('div').item(0).innerHTML;
				}
				else
				{
					ob.innerHTML=xmlhttp.responseText;
				}
			}
			else
			{
				ob.innerHTML=xmlhttp.responseText;
			}
				//alert(obcall.innerHTML.length);
				//alert(successmsg);
				//alert(obloading.id);
				obloading.style.display='none';
				document.getElementById(loadingdiv).innerHTML=innerdata;
				if(obcall.innerHTML==successmsg)
				{
					//alert('in');
					nxtfun(formname);	
				}				
				//else
				//alert('out');
				//nxtfun();
		}
	}
	xmlhttp.send(null);	
}