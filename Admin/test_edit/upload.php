<?phpif(isset($_POST['submit'])) {	$file = $_FILES['file'];//得到传输的数据//得到文件名称	$name       = $file['name'];	$type       = strtolower( substr( $name, strrpos( $name, '.' ) + 1 ) ); //得到文件类型，并且都转化成小写	$allow_type = array( 'jpg', 'jpeg', 'gif', 'png' ); //定义允许上传的类型//判断文件类型是否被允许上传	$upload_path = "/uploads"; //上传文件的存放路径//开始移动文件到相应的文件夹	if ( move_uploaded_file( $file['tmp_name'], $upload_path . $file['name'] ) ) {		echo "Successfully!";	} else {		echo "Failed!";	}}?>