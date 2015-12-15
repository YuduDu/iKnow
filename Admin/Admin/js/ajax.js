var xmlHttp;
function getXmlHttpRequest() {
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp = new XMLHttpRequest();
	} catch (e) {

		// Internet Explorer
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {

			try {
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				alert("您的浏览器不支持AJAX！");
			}
		}
	}
	return xmlHttp;
}

function sendrequest(url,f1){
	var xmlReq=getXmlHttpRequest();
	xmlReq.onreadystatechange=f1;
	xmlHttp.open("POST", url, true);
	xmlHttp.send(null);
}