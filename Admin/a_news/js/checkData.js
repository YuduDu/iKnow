function checkDate_login(){
	var student_id=document.getElementById("Username").value;
	var password=document.getElementById("Password").value;
	if (student_id==""){
		alert("Please input username.");
		return false;
	}
//	if(isNaN(student_id)){
//		alert("The student id should be numbers.");
//		return false;
//	}
	if(password==""){
		alert("Please input password.");
		return false;
	}
	return true;
}
function checkDate_register(){
	var studentId=document.getElementById("studentId").value;
	var username=document.getElementById("username").value;
	var password=document.getElementById("password_register").value;
	var major=document.getElementById("major").value;
	if(studentId==""){
		alert("Please input the student id.");
		return false;
	}
	if(isNaN(studentId)){
		alert("The student id should be numbers.");
		return false;
	}
	if(username==""){
		alert("Please input the username.");
		return false;
	}
	if(password==""){
		alert("Please input the password.");
		return false;
	}
	if(major==""){
		alert("Please input the major.");
		return false;
	}	
	return true;
}
function checkDate_addCourse(){
	var course=document.getElementById("addcourse").value;
	var teacher=document.getElementById("addteacher").value;
	var classroom=document.getElementById("addclassroom").value;
	var time=document.getElementById("addtime").value;
	var day=document.getElementById("addday").value;
	if(course==""){
		alert("Please input the course.");
		return false;
	}
	if(teacher==""){
		alert("Please input the teacher.");
		return false;
	}
	if(classroom==""){
		alert("Please input the classroom.");
		return false;
	}
	if(day==""){
		alert("Please input the day.");
		return false;
	}
	if(time==""){
		alert("Please input the time.");
		return false;
	}
	return true;
}