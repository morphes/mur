if(document.cookie.indexOf("approved_gdpr=true") == -1){
if(document.URL.indexOf("/datasheet?/data/") >= 0){	
	var popup = document.createElement("div");
	popup.innerHTML = "<div id='murata_gdpr_popup' style='*margin-top:-100px; top:100px; padding-top:0px; text-align: left;position:fixed;width: 100%;transform: translateY(-50%);z-index:9999;background-color: #FFF;left:0;'><div style='max-width: 1246px;margin: 0 auto 0;padding: 30px 10px 40px;'><div style='font-weight: 400;font-size: 26px;color: #333;z-index:  9999999;'>Murata Power Solutions respects your data privacy</div><div style='margin: 20px 0 30px;color: #5b6770;font-size: 16px;'><div>This website, and third parties who may be located outside of the EU, use cookies to improve this website, to analyze the data traffic on this website, to help this website function properly, to connect with social media, to follow the surf behavior across different websites and to offer the possibility to give feedback. When you press 'Accept', you allow the placement of cookies as described in our statement. For more information, please refer to our <a href='https://www.murata-ps.com/en/about/privacy-security.html' target='_blank' style='color: #f5002f;'>Privacy policy</a> and <a href='https://www.murata-ps.com/en/about/terms-of-use.html' target='_blank' style='color: #f5002f;'>Site policy</a>.</div></div><a id='murata_gdpr_approve_button' style='background-color: #f5002f;padding: 10px 15px;font-size: 16px;font-weight: 400;color: #fff;cursor: pointer;'>Accept</a> </div></div><div id='murata_gdpr_background' style='position: fixed;display: block;opacity: 0.6;filter:alpha(opacity=60);width: 100%;height: 100%;background: #000;z-index: 9998;top: 0;left: 0;bottom: 0;right: 0;'></div>";
	document.body.appendChild(popup);
	document.getElementById("murata_gdpr_approve_button").onclick = function() {
		var expirationDate = new Date();
		expirationDate.setYear(expirationDate.getYear() + 1901);
		document.cookie = "approved_gdpr=true; domain=power.murata.com; path=/; expires=" + expirationDate.toUTCString();
		document.getElementById("murata_gdpr_popup").parentNode.innerText = null;
	};}}				
	

if(document.cookie.indexOf("approved_gdpr=true") == -1){
	if(document.URL.indexOf("/datasheet?/data/") <= 0){
	var popup = document.createElement("div");
	popup.innerHTML = "<div id='murata_gdpr_popup' style='*margin-top:-140px; text-align: left;position:fixed;width: 100%;transform: translateY(-50%);z-index:9999;background-color: #FFF;top: 38%;left:0;'><div style='max-width: 1046px;margin: 0 auto 0;padding: 30px 10px 40px;'><div style='font-weight: 400;font-size: 26px;color: #333;z-index:  9999999;'>Murata Power Solutions respects your data privacy</div><div style='margin: 20px 0 30px;color: #5b6770;font-size: 16px;'><div>This website, and third parties who may be located outside of the EU, use cookies to improve this website, to analyze the data traffic on this website, to help this website function properly, to connect with social media, to follow the surf behavior across different websites and to offer the possibility to give feedback. When you press 'Accept', you allow the placement of cookies as described in our statement. For more information, please refer to our <a href='https://www.murata-ps.com/en/about/privacy-security.html' target='_blank' style='color: #f5002f;'>Privacy policy</a> and <a href='https://www.murata-ps.com/en/about/terms-of-use.html' target='_blank' style='color: #f5002f;'>Site policy</a>.</div></div><a id='murata_gdpr_approve_button' style='background-color: #f5002f;padding: 10px 15px;font-size: 16px;font-weight: 400;color: #fff;cursor: pointer;'>Accept</a> </div></div><div id='murata_gdpr_background' style='position: fixed;display: block;opacity: 0.6;filter:alpha(opacity=60);width: 100%;height: 100%;background: #000;z-index: 9998;top: 0;left: 0;bottom: 0;right: 0;'></div>";
	document.body.appendChild(popup);
	document.getElementById("murata_gdpr_approve_button").onclick = function() {
		var expirationDate = new Date();
		expirationDate.setYear(expirationDate.getYear() + 1901);
		document.cookie = "approved_gdpr=true; domain=power.murata.com; path=/; expires=" + expirationDate.toUTCString();
		document.getElementById("murata_gdpr_popup").parentNode.innerText = null;
	};}}	