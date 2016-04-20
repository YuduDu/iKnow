var url = {
	newslist: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/db.php",
	discovernews: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/db.php",
	login: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/login2.php",
	signup: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/signup.php",
	resetpassword: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/resetpassword.php",
	order: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/makeorder.php",
	serviceslist: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/list2.php",
	list: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/list2.php",
	search: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/search.php",
	therapistslist: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/massagistlist.php",
	slideimage1: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/img/slide/slide1.jpg",
	slideimage2: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/img/slide/slide2.jpg",
	slideimage3: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/img/slide/slide3.jpg",
	slideimage4: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/img/slide/slide4.jpg",
	indexservicedetail: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/servicedetail.php",
	appt: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/appointment_times.php",
	comment: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/comment.php",
	orderdetail: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/orderdetail.php",
	massagistdetail: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/massagistdetail.php",
	appointment_succ: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/appointment_succ.php",
	morecomment: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/morecomment.php",
	sms: "http://gene.rnet.missouri.edu/iKnow/v1/Eng/SMS.php",

}

var citylist = {
	city: ['Beijing', 'Luoyang']
}


var constant = {
	versionid: "1.8.2"
}

var categorypair = {
	1: 'Massage',
	2: 'GuaSha',
	3: 'SPA',
	4: 'FootMassage',
	5: 'Traditional Chinese Treatment',
	6: 'Illness Treatment',
	
}

var timeset1 = {
	list1: ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00'],
	list2: ['11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30'],
	list3: ['15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00'],
	list4: ['18:30', '19:00', '19:30', '20:00', '20:30', '21:00', '21:30'],
}

function Post2Template(url, action, templateid, bodyid) {
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

function openWindowfunc(elementid, windowid) {
	var elementid = elementid;
	var windowid = windowid;
	document.getElementById(elementid).addEventListener('tap', function(e) {
		//显示热门服务分类页
		mui.openWindow({
			id: windowid,
			url: windowid + ".html",
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

function addMinutes(time /*"hh:mm"*/ , minsToAdd /*"N"*/ ) {
	function z(n) {
		return (n < 10 ? '0' : '') + n;
	}
	var bits = time.split(':');
	var mins = bits[0] * 60 + (+bits[1]) + (+minsToAdd);

	return z(mins % (24 * 60) / 60 | 0) + ':' + z(mins % 60);
}

function shareMessage(share, ex) {
	var msg = {
		extra: {
			scene: ex
		}
	};
	msg.href = "http://gene.rnet.missouri.edu/iKnow/landing/";
	msg.title = "Share from iKnow："+obj.servicename;
	msg.content = "Service Content"+obj.shortdesc;
	if (~share.id.indexOf('weibo')) {
		msg.content += "；Visit：http://pgyer.com/iknow";
	}
	msg.thumbs = ["img/icon120.png"];
	share.send(msg, function() {
		plus.nativeUI.toast("Share to\"" + share.description + "\"succeed！ ");
	}, function(e) {
		plus.nativeUI.toast("Share to\"" + share.description + "\"failed: " + e.code + " - " + e.message);
	});
}
