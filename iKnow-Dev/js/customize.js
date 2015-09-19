var url = {
		newslist: "http://gene.rnet.missouri.edu/iKnow/db.php",
		discovernews:"http://gene.rnet.missouri.edu/iKnow/db.php",
		login:"http://gene.rnet.missouri.edu/iKnow/login.php",
		signup:"http://gene.rnet.missouri.edu/iKnow/signup.php",
		homeservices:"http://gene.rnet.missouri.edu/iKnow/recommand.php",
		hometherapists:"http://gene.rnet.missouri.edu/iKnow/recommand.php",
		serviceslist:"http://gene.rnet.missouri.edu/iKnow/servicelist.php",
		therapistslist:"http://gene.rnet.missouri.edu/iKnow/massagistlist.php",
		slideimage1:"http://gene.rnet.missouri.edu/iKnow/login.php",
		slideimage2:"http://gene.rnet.missouri.edu/iKnow/login.php",
		slideimage3:"http://gene.rnet.missouri.edu/iKnow/login.php",
		slideimage4:"http://gene.rnet.missouri.edu/iKnow/login.php",
		indexservicedetail:"http://gene.rnet.missouri.edu/iKnow/servicedetail.php",
	}

var api = {
		nexmo_api_key:"27883592",
		nexmo_api_secret:"c2516ec5"
}

function Post2Template(url,action,templateid,bodyid){
	var url = url;
	var action = action;
	var templateid = templateid;
	var bodyid = bodyid;
	mui.ajax(url, {
					data: {
						action: action
					},
					type: 'post', //HTTP请求类型 
					timeout: 100000, //超时时间设置为10秒；  
					success: function(data) {
						console.log(data);
						this.obj = JSON.parse(data)
						var html = template(templateid, {
							list: obj
						});
						document.getElementById(bodyid).innerHTML = html;
						},
					error: function(xhr, type, errorThrown) {
						console.log(type);
						console.log(JSON.stringify(xhr));
					}
				});
}

function distancefunc(lat1, lon1, lat2, lon2, unit) {
				var radlat1 = Math.PI * lat1 / 180
				var radlat2 = Math.PI * lat2 / 180
				var radlon1 = Math.PI * lon1 / 180
				var radlon2 = Math.PI * lon2 / 180
				var theta = lon1 - lon2
				var radtheta = Math.PI * theta / 180
				var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
				dist = Math.acos(dist)
				dist = dist * 180 / Math.PI
				dist = dist * 60 * 1.1515
				if (unit == "K") {
					dist = dist * 1.609344
				}
				if (unit == "N") {
					dist = dist * 0.8684
				}
				return dist
			}

function openWindowfunc(elementid,windowid){
	var elementid = elementid;
	var windowid = windowid;
	document.getElementById(elementid).addEventListener('tap', function(e) {
					//显示热门服务分类页
					mui.openWindow({
						id: windowid,
						url: windowid+".html",
						styles: {
							popGesture: 'close'
						},
						show: {
							autoShow: true, //页面loaded事件发生后自动显示，默认为true
							aniShow: 'pop-in', //页面显示动画，默认为”slide-in-right“；
							duration: 300 //页面动画持续时间，Android平台默认100毫秒，iOS平台默认200毫秒；
						},
						waiting: {
							autoShow: true, //自动显示等待框，默认为true
							title: '正在加载...', //等待对话框上显示的提示内容
						}
					});
				});
}
