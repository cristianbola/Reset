function ventana(){
	document.getElementById("ventana1").style.visibility="visible";
}

function ventanacerrar(){
	document.getElementById("ventana1").style.visibility="hidden";
}

function inboxShow(){	
    document.getElementById("ventana-mensajeria").style.visibility="visible";
    var notiNum = $('#notiNum');
    if(notiNum.data('value') > 0){
        $.ajax({
            type: 'GET',
            url: './../control/api.php?source=deleteNotis',
            success: function (data) {
                var result = $.parseJSON(data);
                if(result.response === 'success'){
                    notiNum.remove();
                    //document.getElementById("notiNum").setAttribute('data-value', 0);
                }
            }
        })
    }
}

function inboxHidden(){
    document.getElementById("ventana-mensajeria").style.visibility="hidden";
}




