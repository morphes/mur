// JavaScript Document

var perform_acrobat_detection = function()
	{ 
	//
	// The returned object
	// 
	var browser_info = {
		name: null,
		acrobat : null,
		acrobat_ver : null
	};

	if(navigator && (navigator.userAgent.toLowerCase()).indexOf("chrome") > -1) browser_info.name = "chrome";
	else if(navigator && (navigator.userAgent.toLowerCase()).indexOf("msie") > -1) browser_info.name = "ie";
	else if(navigator && (navigator.userAgent.toLowerCase()).indexOf("firefox") > -1) browser_info.name = "firefox";
	else if(navigator && (navigator.userAgent.toLowerCase()).indexOf("msie") > -1) browser_info.name = "other";


	try
	{
		if(browser_info.name == "ie")
		{          
		var control = null;

		//
		// load the activeX control
		//                
		try
		{
			// AcroPDF.PDF is used by version 7 and later
			control = new ActiveXObject('AcroPDF.PDF');
		}
		catch (e){}

		if (!control)
		{
			try
			{
				// PDF.PdfCtrl is used by version 6 and earlier
				control = new ActiveXObject('PDF.PdfCtrl');
			}
			catch (e) {}
		}

		if(!control)
		{     
			browser_info.acrobat == null;
			return browser_info;  
		}

		version = control.GetVersions().split(',');
		version = version[0].split('=');
		browser_info.acrobat = "installed";
		browser_info.acrobat_ver = parseFloat(version[1]);
		}
	else if(browser_info.name == "chrome")
	{
		for(key in navigator.plugins)
		{
			if(navigator.plugins[key].name == "Chrome PDF Viewer" || navigator.plugins[key].name == "Adobe Acrobat")
			{
				browser_info.acrobat = "installed";
				browser_info.acrobat_ver = parseInt(navigator.plugins[key].version) || "Chome PDF Viewer";
			}
		} 
	}
	//
	// NS3+, Opera3+, IE5+ Mac, Safari (support plugin array):  check for Acrobat plugin in plugin array
	//    
	else if(navigator.plugins != null)
	{      
		var acrobat;
		if(navigator.plugins['Adobe Acrobat'] != null)
		{
				acrobat = navigator.plugins['Adobe Acrobat'];
//				alert('Adobe Acrobat');
		}
		else if (navigator.plugins['Adobe PDF'] != null)
		{
				acrobat = navigator.plugins['Adobe PDF'];
//				alert('Adobe PDF');
		}
		else if (navigator.plugins['Acrobat Reader'] != null)
		{
				acrobat = navigator.plugins['Acrobat Reader'];
//				alert('Acrobat Reader');
		}
		if(acrobat == null)
		{           
			browser_info.acrobat = null;
			return browser_info;
		}
		browser_info.acrobat = "installed";
		browser_info.acrobat_ver = acrobat.version;
		if(!acrobat.version)
		{
			browser_info.acrobat_ver = acrobat.description;
//			alert('un');
		}
//		alert(""+acrobat.description);
//		browser_info.acrobat_ver = parseInt(acrobat.version[0]);
//		browser_info.acrobat_ver = parseInt(acrobat.version);
//		alert(""+navigator.plugins.length)
//		alert(""+parseInt(acrobat.version[0]));
//		alert(""+acrobat.version);
//		alert(""+acrobat.version[0]);
//Adobe PDF Plug-In For Firefox and Netscape
//		alert(""+browser_info.acrobat_ver);
//		alert("t");

	}
	


	}
	catch(e)
	{
		browser_info.acrobat_ver = null;
	}

	return browser_info;
}

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i) ? true : false;
    },
//    BlackBerry: function() {
//        return navigator.userAgent.match(/BlackBerry/i) ? true : false;
//    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i) ? true : false;
    },
//    Windows: function() {
//        return navigator.userAgent.match(/IEMobile/i) ? true : false;
//    },
    any: function() {
//        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Windows());
        return (isMobile.Android() || isMobile.iOS());
    }
};

var browser_info = perform_acrobat_detection();
//alert(browser_info.name + " "+browser_info.acrobat + " " + browser_info.acrobat_ver);
var minadobeversion10 = /10\..+/.test(browser_info.acrobat_ver);
var minadobeversion11 = /11\..+/.test(browser_info.acrobat_ver);
var minadobeversion12 = /12\..+/.test(browser_info.acrobat_ver);
var minadobeversion13 = /13\..+/.test(browser_info.acrobat_ver);
var minchrome = /Chome.+/.test(browser_info.acrobat_ver);
//alert("Minimum PDF version: " + minadobeversion);
if(minadobeversion10 == true || minadobeversion11 == true || minadobeversion12 == true || minadobeversion13 == true || minchrome == true || isMobile.any())
{	
}
else {
	pdfwarr	= "<tr><td colspan=\"2\" align=\"center\" style=\"BACKGROUND-COLOR:red;COLOR: #000000; text-align:center\"><b>This content requires Adobe PDF 10.x</b>";
	if((browser_info.acrobat == "installed") && (browser_info.acrobat_ver != "1") && (browser_info.acrobat_ver != null))
	{
		pdfwarr	+= " (you are running on: "+ browser_info.acrobat_ver +")";
	}
	pdfwarr	+= ": <a href=\"http://get.adobe.com/reader/\" target=\"_new\" class=\"white\" style=\"color:white;\">Upgrade Adobe PDF</a></td></tr>";
	document.write(pdfwarr);
//	alert("y");
}