var url = {
		list: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/massagist_list.php",
		basic_info: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/massagist_basic_info.php",
		order_detail:"http://gene.rnet.missouri.edu/iKnow/v1/Eng/massagist_order_detail.php",
		login:"http://gene.rnet.missouri.edu/iKnow/v1/Eng/massagist_login.php",
		statistic:"http://gene.rnet.missouri.edu/iKnow/v1/Eng/massagist_statistic.php"
}

var id = {
	massaid: '13233997914'
}

var constant = {
}

var timeset1 = {
	list1:['08:00','09:00','10:00','11:00','12:00','13:00','14:00'],
	list2:['15:00','16:00','17:00','18:00','19:00','20:00','21:00']
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
							title: 'loading...', //等待对话框上显示的提示内容
						}
					});
				});
}

function tConvert (time) {
  // Check correct time format and split into components
  time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

  if (time.length > 1) { // If time format correct
    time = time.slice (1);  // Remove full string match value
    time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
    time[0] = +time[0] % 12 || 12; // Adjust hours
  }
  return time.join (''); // return adjusted time or original string
}

function shareMessage(share, ex) {
					var msg = {
						extra: {
							scene: ex
						}
					};
					msg.href = "http://pre.im/3065";
					msg.title = "身知道App分享：";
					msg.content = self.servicename;
					if (~share.id.indexOf('weibo')) {
						msg.content += "；体验地址：http://pre.im/3065";
					}
					msg.thumbs = ["img/icon120.png"];
					share.send(msg, function() {
						plus.nativeUI.toast("分享到\"" + share.description + "\"成功！ ");
					}, function(e) {
						plus.nativeUI.toast("分享到\"" + share.description + "\"失败: " + e.code + " - " + e.message);
					});
				}
