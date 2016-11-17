window.onload = function () {
    //подтверждение удаления детали
    document.getElementById('del_detal_sub').onclick = function() {
        if(confirm("Удалить деталь?"))
            return true;
        else
            return false;
    };
    //проверка паролей при регистрации
    document.getElementById('regist_sub').onclick = function() {
        if(document.getElementById('password_reg1').value != document.getElementById('password_reg2').value){
            document.getElementById('password_reg1').setAttribute('class','error');
            document.getElementById('password_reg2').setAttribute('class','error');
            $("div.passworderror").remove();
            $(document.getElementById('email_reg')).before('<div class="passworderror">пароли не одинаковы!</div>');
            return false;
        }else{
            $("div.passworderror").remove();
            document.getElementById('password_reg1').removeAttribute('class');
            document.getElementById('password_reg2').removeAttribute('class');
        }
    };
    //удалить определенный отзыв
};

    function select_foto(obj) {
        var value = obj.files[0].name;
        obj.nextSibling.setAttribute("value", value);
        obj.previousSibling.src="images/portfolio/"+value;
    }

    //добавить поле для модели авто в админке
    function add_func(){
	var clon = document.getElementById('select_example').cloneNode(true);//клонируем селект-пример
	clon.id='model_'+document.getElementById('count_model').value;
	clon.name='model_'+document.getElementById('count_model').value;
	clon.required='required';
	document.getElementById('select_example').parentNode.appendChild(clon);
	
	document.getElementById('count_model').value++;
}
    //удалить поле для модели авто в админке
    function delete_func(){

	document.getElementById('count_model').value--;	
	var model_del ='model_'+ document.getElementById('count_model').value;
	if(document.getElementById(model_del))
		document.getElementById(model_del).remove();
	else
		document.getElementById('count_model').value++;
}
    //вывод товаров по несколько частей с навигацией
    function nav_tovar(obj){
    var nomer= obj.getAttribute("value");
    var count = document.getElementsByClassName('tovar').length;
    for(var i=1;i<=count;i++){
        if(i<=nomer*6-6 || i>nomer*6){
           document.getElementById("tovar_det["+i+"]").classList.add("tovar_hid");
        }
        else
            document.getElementById("tovar_det["+i+"]").classList.remove("tovar_hid");

    }
    var count_a= Math.floor(count/6);
    for(var i=0;i<count_a;i++){
        document.getElementsByClassName('a_check')[0].classList.remove("a_check");
    }
    obj.classList.add("a_check");
}
    //переключение между вкладками в админке
    function tab_admin(obj) {
        var nomer=0;
        for(var i=1;document.getElementById("tab_admin_"+i);i++){
            if(obj.id == document.getElementById("tab_admin_"+i).id)
                nomer=i;
            $('#content_admin_'+i).css({'display':'none'});
        }
        $('#content_admin_'+nomer).css({'display':'block'});
    }

    function modal_foto(obj){
    var src = obj.getAttribute('src');

    var div = document.createElement('div');
    var img = document.createElement('img');
    var overlay = document.createElement('div');

    div.id = "modal_foto";
    overlay.id = "overlay";
    overlay.setAttribute('onclick','del_port_foto();');
    div.setAttribute('onclick','del_port_foto();');
    img.setAttribute('src',src);

    obj.parentNode.appendChild(div);
    obj.parentNode.appendChild(overlay);
    document.getElementById('modal_foto').appendChild(img);}
function del_port_foto() {
    $('#overlay').remove();
    $('#modal_foto').remove();
}
function del_parent(obj) {
    obj.parentNode.remove();
    var count = document.getElementsByClassName('port_foto_box').length;
    document.getElementById('count_foto_portfolio').value=count;

}
function add_foto_portfolio(obj) {
    //var example = obj.parentNode.firstChild.cloneNode(true);

    var count = document.getElementsByClassName('port_foto_box').length+1;
    var port_foto_box = document.createElement("div");
    var img = document.createElement("img");
    var file = document.createElement("input");
    var file_data = document.createElement("input");
    var del_foto = document.createElement("input");

    port_foto_box.className='port_foto_box';
    img.className="port_foto";
    img.src="images/portfolio/dark_bg.jpg";
    img.onclick="modal_foto(this);";
    file.className="input_file";
    file.type="file";
    file.title="изменить фото";
    file.setAttribute('onchange','select_foto(this);');
    file_data.className="hid";
    file_data.type="hidden";
    file_data.name="portf_"+count;
    file_data.value="dark_bg.jpg";
    del_foto.className="vanil_but";
    del_foto.type="button";
    del_foto.value="X";
    del_foto.setAttribute('onclick','del_parent(this);');

    obj.parentNode.insertBefore(port_foto_box,obj);
    obj.previousSibling.appendChild(img);
    obj.previousSibling.appendChild(file);
    obj.previousSibling.appendChild(file_data);
    obj.previousSibling.appendChild(del_foto);
    document.getElementById('count_foto_portfolio').value=count;
}
