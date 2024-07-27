$(document).ready(function(){
	/* re_bt클래스 클릭시 동작(댓글입력) */
	$("#rep_bt").click(function(){
		if (document.getElementById("dat_user").value == "") {
			alert("닉네임을 입력하세요");
			return false;
		}
		  if (document.getElementById("dat_pw").value == "") {
			alert("비밀번호를 입력하세요");
			return false;
		}
		  if (document.getElementById("re_content").value == "") {
			alert("내용을 입력하세요");
			return false;
		}
		$.post("reply_ok.php",{
					bno:$(".bno").val(),
					dat_user:$(".dat_user").val(),
					dat_pw:$(".dat_pw").val(),
					content:$(".reply_content").val(),
				},	
				function(data,success){
					if(success=="success"){
						$(".reply_view").html(data);
						alert("댓글이 작성되었습니다");	
					}else{
						alert("댓글작성이 실패되었습니다");
					}
				});
	    });
		
	$(".dat_edit_bt").click(function(){
		/* dat_edit_bt클래스 클릭시 동작(댓글 수정) */
			var obj = $(this).closest(".dap_lo").find(".dat_edit");
			obj.dialog({
				modal:true,
				width:650,
				height:200,
				title:"댓글 수정",
				close: function () {
					console.log("dialog_close");
					// location.reload();
					history.go(0);
				   }				
			    }
			);
			console.log("dialog_open");
		});
	$("#del").click(function(){
		var obj = $(this).closest(".bod_lo").find(".board_del");
		obj.dialog({
			modal:true,
			width:400,
			title:"게시글 삭제확인",
		    close: function () {
				console.log("dialog_close");
				// location.reload();
				history.go(0);
			   }
			});
			console.log("dialog_open");
	});	
	$(".dat_delete_bt").click(function(){
		/* dat_delete_bt클래스 클릭시 동작(댓글 삭제) */
		var obj = $(this).closest(".dap_lo").find(".dat_delete");
		obj.dialog({
			modal:true,
			width:400,
			title:"댓글 삭제확인",
		    close: function () {
				console.log("dialog_close");
				// location.reload();
				history.go(0);
			   }
			});
			console.log("dialog_open");
		});	
	});