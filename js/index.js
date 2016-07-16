
$("#dosubmit").click(function(){
	var username = $("#username").val();
	var gender = $('input:radio:checked').val();
	var tel = $("#tel").val();
	var content = $("#content").val();
	if (username && gender && tel && content){
		$.post("action.php",
		{
			username:username,
			gender:gender,
			tel:tel,
			content:content
		},
		function(data){
			if (data.ok) {
				alert("留言成功");
				location.reload();
			} else {
				alert("请填写所有字段");
			}
		});
	}else{
		alert("请填写所有字段");
	}
});

$(".title").click(function(){
	var id = $(this).prev().attr("id");
	$(this).next().slideToggle("slow");
});
$(".replay").click(function(){
	var id = $(this).parents(".message").children().first().attr("id");
	var name = $(this).attr("name");
	swal({   
		title: "回 复",     
		type: "input",   
		showCancelButton: true,   
		closeOnConfirm: false,   
		animation: "slide-from-top",   
		inputPlaceholder: "回复"+name+":" 
	}, function(inputValue){
		var content =  inputValue;  
		if (inputValue === false) return false;      
		if (inputValue === "") {     
			swal.showInputError("写点东西吧!");     
			return false   
		}
		$.post("action.php",
		{
			name:$("#title").attr('name'),
			mid:id,
			content:inputValue,
		},
		function(data){
			if (data.ok) {
				swal("回复成功!", "", "success");
				var p = "<p>"+name+"回复:"+content+"</p>";
				$('.replay_list').append(p);
			} else {
				console.log();
				swal("回复失败", "请联系管理员", "error");
			}
		})
	})
});