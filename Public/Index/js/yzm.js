   var bnt =document.getElementById('bnt');
    
    $('#bnt').click(function (){
    var t=60;
    bnt.disabled = true;
    bnt.style.backgroundColor = '#B9C3C9';
    var times =  setInterval(function(){	
    	bnt.innerHTML = t+'s'; 
    	t--;
   	    if(t == 0){
   	    	
   	    	
   	    bnt.innerHTML = '获取验证码';
   	    bnt.disabled = false;
   	    bnt.style.backgroundColor = '#38383A';
   	    clearInterval(times);
   	    }
    },1000);
    });