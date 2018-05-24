//	var texts = document.getElementsByClassName("text")[0];
//		var passwords = document.getElementsByClassName("password")[0];
//		var phone = document.getElementsByClassName("phone")[0];
//		
//      $('.text').blur(function (){
//      	checkeusername(texts.value);
//      });
//
//      $('.password').blur(function (){
//      	checkePWD(passwords.value);
//      });
//      
//      $('.phone').blur(function (){
//      	checkPhone(phone.value);
//      });
		
		function checkeusername(username) {
			var reg =/[~#^.$@%&!?%*]/gi;
        if(reg.test(username)){
        	console.log("用户名里不能有特殊字符");
        }else if(username == ''){
        	console.log("用户名不能为空");
        }else{
        	console.log("用户名可用");
        }
		}

		function checkePWD(PWD) {
			var str = PWD;
			//在JavaScript中，正则表达式只能使用"/"开头和结束，不能使用双引号
			var Expression = /^(?!([a-zA-Z\d]*|[\d!@#\$%_\.]*|[a-zA-Z!@#\$%_\.]*)$)[a-zA-Z\d!@#\$%_\.]{6,16}$/;
			var objExp = new RegExp(Expression); //创建正则表达式对象
			if(objExp.test(str) == true) { //通过正则表达式验证
			    console.log("密码可用");
			    return true;
			} else if(str == ""){
				console.log("密码不能为空");
		    }else{
		    	console.log("密码必须包含大小写字母数字和特殊字符");
				return false;
			}
		}
    
        function checkPhone(nub){
        	var reg =/^[1][3,4,5,7,8][0-9]{9}$/;
        	if(reg.test(nub)){
        		console.log("手机号正确");
        	}else if(nub == ""){
        		console.log("手机号不能为空");
        	}else{
        		console.log("请输入正确的手机号");
        	}
        	
        }