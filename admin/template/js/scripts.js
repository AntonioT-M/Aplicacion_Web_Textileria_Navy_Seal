$(document).ready(function(){ list(); setInterval(updateData, 5000);});

function updateData(){
	searches();
}

function list(){
	$.ajax({url:'list.php', type:'POST', success: function(data){$('#en_lista').html(data);}});
}

function searches(){
	var search = $('#search').val();
	var c = $('#c').val();
	if(search != "" || c != ""){
		$.ajax({url: 'search.php', data:{search:search, c:c}, type: 'POST', success: function(data){ $('#en_lista').html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
	}else{
		list();
	}
}

function showForm(id=''){
	let btn = document.getElementById("btnForm");
	if(btn.click){
		if(btn.className == "btn btn-success"){
			if(id == ''){
				document.getElementById("title").innerHTML = "Nuevo Registro";
				$.ajax({url:'saveForm', data: "id="+id, type:'POST', 
				success: function(data){$('#form').html(data)
				document.getElementById("table").style.display = "none";
				btn.className = "btn btn-danger";
				document.getElementById("faIconF").className = "fa fa-close";}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
				Swal.fire({
					position: 'top-end',
					icon: 'warning',
					title: 'Operación iniciada',
					text: 'Nuevo registro',
					showConfirmButton: false,
					timer: 1100,
					timerProgressBar: true,
					didOpen: ()=>{
						Swal.showLoading();
					}
				})
				$("html, body").animate({ scrollTop: 0 }, 600); 
			}else{
				Swal.fire({
					title: '¿Modificar el registro?',
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
				}).then((result) => {if(result.isConfirmed){
					document.getElementById("title").innerHTML = "Editar Registro";
					$.ajax({url:'saveForm', data: "id="+id, type:'POST', 
					success: function(data){$('#form').html(data)
					document.getElementById("table").style.display = "none";
					btn.className = "btn btn-danger";
					document.getElementById("faIconF").className = "fa fa-close";}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
					Swal.fire({
						position: 'top-end',
						icon: 'warning',
						title: 'Operación iniciada',
						text: 'Modificando registro',
						showConfirmButton: false,
						timer: 1100,
						timerProgressBar: true,
						didOpen: () =>{
							Swal.showLoading();
						}
					})
					$("html, body").animate({ scrollTop: 0 }, 600);  
				}else if(result.dismiss === Swal.DismissReason.cancel){

				}})
			}
			
		}else if(btn.className == "btn btn-danger"){
			Swal.fire({
				title: '¿Cancelar operación?',
				text: "La información no se guardara",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Aceptar'
			  }).then((result) => {if (result.isConfirmed) {
				$("#form").html("");
				document.getElementById("title").innerHTML = document.getElementById("tIndex").innerHTML;
				document.getElementById("table").style.display = "block";
				btn.className = "btn btn-success";
				document.getElementById("faIconF").className = "fa fa-plus";
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: 'Operación cancelada',
					text: 'No hay cambios',
					showConfirmButton: false,
					timer: 1100
				})
				$("html, body").animate({ scrollTop: 0 }, 600); 
			  } else if (result.dismiss === Swal.DismissReason.cancel) {
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Continuar Operación',
					showConfirmButton: false,
					timer: 1100
				})
			}})
		}
	}
}

function showFormForOp(id=''){
	let btn = document.getElementById("btnForm");
	console.log(1);
	if(btn.click){
		if(btn.className == "btn btn-success"){
			if(id == ''){
				document.getElementById("title").innerHTML = "Nuevo Registro";
				$.ajax({url:'saveForm', data: "id="+id, type:'POST', 
				success: function(data){$('#form').html(data)
				document.getElementById("table").style.display = "none";
				btn.className = "btn btn-danger";
				document.getElementById("faIconF").className = "fa fa-close";}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
				Swal.fire({
					position: 'top-end',
					icon: 'warning',
					title: 'Operación iniciada',
					text: 'Nuevo registro',
					showConfirmButton: false,
					timer: 1100,
					timerProgressBar: true,
					didOpen: ()=>{
						Swal.showLoading();
					}
				})
				$("html, body").animate({ scrollTop: 0 }, 600); 
			}else{
				Swal.fire({
					title: '¿Producir?',
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
				}).then((result) => {if(result.isConfirmed){
					document.getElementById("title").innerHTML = "Editar Registro";
					$.ajax({url:'saveForm', data: "id="+id, type:'POST', 
					success: function(data){$('#form').html(data)
					document.getElementById("table").style.display = "none";
					btn.className = "btn btn-danger";
					document.getElementById("faIconF").className = "fa fa-close";}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
					Swal.fire({
						position: 'top-end',
						icon: 'warning',
						title: 'Operación iniciada',
						text: 'Produciendo registro',
						showConfirmButton: false,
						timer: 1100,
						timerProgressBar: true,
						didOpen: () =>{
							Swal.showLoading();
						}
					})
					$("html, body").animate({ scrollTop: 0 }, 600);  
				}else if(result.dismiss === Swal.DismissReason.cancel){

				}})
			}
			
		}else if(btn.className == "btn btn-danger"){
			Swal.fire({
				title: '¿Detener operación?',
				text: "",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Aceptar'
			  }).then((result) => {if (result.isConfirmed) {
				$("#form").html("");
				document.getElementById("title").innerHTML = document.getElementById("tIndex").innerHTML;
				document.getElementById("table").style.display = "block";
				btn.className = "btn btn-success";
				document.getElementById("faIconF").className = "fa fa-plus";
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Operación Detenida',
					text: '',
					showConfirmButton: false,
					timer: 1100
				})
				$("html, body").animate({ scrollTop: 0 }, 600); 
			  } else if (result.dismiss === Swal.DismissReason.cancel) {
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Continuar Operación',
					showConfirmButton: false,
					timer: 1100
				})
			}})
		}
	}
}

function setNick(){
	if(document.getElementById("nombre").value != "" && document.getElementById("apellidos").value != ""){
	let n = Array.from(document.getElementById("nombre").value);
	let a = Array.from(document.getElementById("apellidos").value);
	let r1 = [];
	let r2 = [];
	let p1 = [];
	let p2 = [];
	let x1 = [];
	let x2 = [];
	let i,v;
	for(i = 0; n.length > i; i++) p1[i] = i;
	for(i = 0; 3 > i; i++){
		x1 = Math.floor(Math.random()*p1.length);
		r1.push(n[p1[x1]]);
		p1.splice(r1, 2);
	}
	for(v = 0; a.length > v; v++) p2[i] = v;
	for(v = 0; 3 > v; v++){
		x2 = Math.floor(Math.random()*p2.length);
		r2.push(n[p2[x2]]);
		p2.splice(r2, 2);
	}
	let d = new Date();
	let num = Math.floor(Math.random()*(1 + 9)).toString();
	rf = "NS"+r1.join('')+r2.join('')+num+d.getMinutes();
	if(rf.length <= 8){
		rf+="0";
	}else if(rf.length >= 10){
		rf = rf.slice(0,9);
	}
	document.getElementById("nick").value = rf;
	//Math.floor(Math.random()*(0 + 1001)) + 0;
	}
}

function setPrivilegies(){
	let c = document.getElementById("cargo").value;
	if(c == ""){
		document.getElementById("privilegios").value = null;
	}else if(c == "TI"){
		document.getElementById("privilegios").value = 1;
	}else if(c == "Supervisor"){
		document.getElementById("privilegios").value = 2;
	}else if(c == "Programador"){
		document.getElementById("privilegios").value = 3;
	}
}

function saveData(){
	let datos = $('#data').serializeArray();
	Swal.fire({
		title: '¿Desea guardar?',
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar'
	}).then((result) =>{
		if(result.isConfirmed){
			$.ajax({url:'save.php', data:{datos:datos}, type:'POST', success: function(data){
				if(data == 'Perfect'){
					Swal.fire({
						title: 'Guardado Exitoso',
						icon: 'success',
						showConfirmButton: false,
						timer:1100
					})
					searches();
					$("#form").html("");
						document.getElementById("title").innerHTML = document.getElementById("tIndex").innerHTML;
						document.getElementById("table").style.display = "block";
						document.getElementById("btnForm").className = "btn btn-success";
						document.getElementById("faIconF").className = "fa fa-plus";
						$("html, body").animate({ scrollTop: 0 }, 600);
				}else if(data == 'Bad'){
					Swal.fire({
						title: "Algo salio mal\nGuardado incorrecto",
						icon: 'error',
						showConfirmButton: false,
						timer: 1100
					})
				}else{
					Swal.fire({
						title: data,
						icon: 'warning',
						showConfirmButton: false,
						timer:1100
					})
				}},
				error: function(fqXHR, textStatus,errorThrow){ 
						console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error")
				});
		}else if(result.dismiss === Swal.DismissReason.cancel){

		}
	}) 
}

function saveData2(){
	let datos = new FormData($('#data')[0]);
	//let datos = $('#data').serializeArray();
	Swal.fire({
		title: '¿Desea guardar?',
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar'
	}).then((result) =>{
		if(result.isConfirmed){
			$.ajax({url:'save.php', data:datos, processData:false, contentType:false, type:'POST', success: function(data){
				if(data == 'Perfect'){
					Swal.fire({
						title: 'Guardado Exitoso',
						icon: 'success',
						showConfirmButton: false,
						timer:1100
					})
					searches();
					$("#form").html("");
						document.getElementById("title").innerHTML = document.getElementById("tIndex").innerHTML;
						document.getElementById("table").style.display = "block";
						document.getElementById("btnForm").className = "btn btn-success";
						document.getElementById("faIconF").className = "fa fa-plus";
						$("html, body").animate({ scrollTop: 0 }, 600);
				}else if(data == 'Bad'){
					Swal.fire({
						title: "Algo salio mal\nGuardado incorrecto",
						icon: 'error',
						showConfirmButton: false,
						timer: 1100
					})
				}else{
					Swal.fire({
						title: data,
						icon: 'warning',
						showConfirmButton: false,
						timer:1500
					})
				}},
				error: function(fqXHR, textStatus,errorThrow){ 
						console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error")
				});
		}else if(result.dismiss === Swal.DismissReason.cancel){

		}
	}) 
}

function deleteR(id){
	if(id != null){
		Swal.fire({
			title: '¿Eliminar el registro?',
			text: 'Los datos no podrán ser recuperados',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar'
		}).then((result) =>{ if(result.isConfirmed){
			$.ajax({url:'delete.php', data: "id="+id, type:'POST', success: function(data){
				if(data != 'Perfect'){
					Swal.fire({
						title: 'Algo salio mal\nEl registro no ha sido eliminado',
						icon: 'error',
						showConfirmButton: false,
						timer: 1100
					})
				}else{
					Swal.fire({
						title: 'Registro eliminado',
						icon: 'success',
						showConfirmButton: false,
						timer: 1100
					})
					searches();
					$("html, body").animate({ scrollTop: 0 }, 600);
			}}, error: function(fqXHR, textStatus, errorThrow){console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error")});
		}else if(result.dismiss === Swal.DismissReason.cancel){

		}})
	}
}

function hideA(){
	if($(".showA").is(":visible")){
		$('.showA').hide();
		document.getElementById("dA").className = 'fa fa-eye';
	}else{
		$('.showA').show();
		document.getElementById("dA").className = 'fa fa-eye-slash';
	}
}

function hideB(){
	if($(".showB").is(":visible")){
		$('.showB').hide();
		document.getElementById("dB").className = 'fa fa-eye';
	}else{
		$('.showB').show();
		document.getElementById("dB").className = 'fa fa-eye-slash';
	}
}

function hideMaterials(r){
	for(var i = -1; $("#nm").val() > i;i++){
		if(r == i){
			if($('.showMatrl'+i).is(":visible")){
				$('.showMatrl'+i).hide();
				document.getElementById("dB").className = 'fa fa-eye';
			}else{
				$('.showMatrl'+i).show();
				document.getElementById("dB").className = 'fa fa-eye-slash';
			}
		}
	}
}

function typeC(){
	if(document.getElementById("tipoC").value == "Formal"){
		document.getElementById("rSocial").readOnly = false;
		document.getElementById("rSocial").value = document.getElementById("rs").value;
	}else if(document.getElementById("tipoC").value == "Informal"){
		document.getElementById("rSocial").readOnly = true;
		document.getElementById("rSocial").value = "N/A";
	}else{
		document.getElementById("rSocial").readOnly = false;
		document.getElementById("rSocial").value = "";
	}
}

function putSistemsOnI(r){
	if($("#nm").val() != null){
		for(var i = 0; $("#nm").val() > i; i++){
			if(r == i){
				if($("#s"+r).val() == ""){
					$('#m'+r).val("");
					$('#m'+r).attr("readonly", "readonly");
					$('#m'+r).attr("placeholder","Sistemas Necesarios");
				}else if($("#s"+r).val() == "1"){
					$('#m'+r).attr("readonly", "readonly");
					$('#m'+r).val("1,2,3,4,5,6,7,8,9");
				}else if($("#s"+r).val() == "2"){
					$('#m'+r).attr("readonly", "readonly");
					$('#m'+r).val("2,4,6,8");
				}else if($("#s"+r).val() == "3"){
					$('#m'+r).attr("readonly", "readonly");
					$('#m'+r).val("1,3,5,7,9");
				}else if($("#s"+r).val() == "4"){
					$('#m'+r).removeAttr("readonly");
					$('#m'+r).val("");
					$('#m'+r).attr("placeholder","Ejem: 1,2,6...");
				}
			}
		}
	}else{
		if($(".sistemasSelectM").val() == ""){
			$(".sistemasT").val("");
			$(".sistemasT").attr("readonly", "readonly");
			$(".sistemasT").attr("placeholder","Sistemas que tiene");
		}else if($(".sistemasSelectM").val() == "1"){
			$(".sistemasT").attr("readonly", "readonly");
			$(".sistemasT").val("1,2,3,4,5,6,7,8,9");
		}else if($(".sistemasSelectM").val() == "2"){
			$(".sistemasT").attr("readonly", "readonly");
			$(".sistemasT").val("2,4,6,8");
		}else if($(".sistemasSelectM").val() == "3"){
			$(".sistemasT").attr("readonly", "readonly");
			$(".sistemasT").val("1,3,5,7,9");
		}else if($(".sistemasSelectM").val() == "4"){
			$(".sistemasT").removeAttr("readonly")
			$(".sistemasT").val($("st").val());
			$(".sistemasT").attr("placeholder","Ejem: 1,2,6...");
		}
	}
}

function getSistemsOfI(){
	if($(".sistemasT").val() == "1,2,3,4,5,6,7,8,9"){
		$(".sistemasSelectM").val("1");
	}else if($(".sistemasT").val() == "2,4,6,8"){
		$(".sistemasSelectM").val("2");
	}else if($(".sistemasT").val() == "1,3,5,7,9"){
		$(".sistemasSelectM").val("3");
	}else if($(".sistemasT").val() != ""){
		$(".sistemasSelectM").val("4");
		$(".sistemasT").attr("readonly", "readonly");
	}
}

function showimg(){
    var preview = document.querySelector('img[id=show]');
    var file = document.querySelector('#file').files[0];
    if(file){
    var reader = new FileReader();
		reader.onloadend = function(){
			preview.src = reader.result;
		}
		if(file){
			reader.readAsDataURL(file);
		}else{
			preview.src="";
		}
    }
}

function getMaterialsToModels(){
	var nm = $("#nm").val();
	var id = $("#idModelo").val();
	if(nm >=1){
		$.ajax({url: 'search.php', data: {newMaterial:nm, id:id}, type: 'POST', success: function(data){ $('#showFormMaterial').html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
	}else{
		$('#showFormMaterial').html("");
	}
}

function showInformationMaterial(i=""){
	$.ajax({url: 'search.php', data: "shMaterial="+$('#material'+i).val(), type: 'POST', success: function(data){ $('#showInfMaterial'+i).html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
}

function showModels(){
	var talla = $('#talla').val();
	var id = $('#idPedido').val()
	$.ajax({url: 'search.php', data: {talla:talla, idP1:id}, type: 'POST', success: function(data){ $('#showModels').html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
	checkSelectModel();
}

function showImgModel(){
	$.ajax({url: 'search.php', data: "id="+$('#idModelo').val(), type: 'POST', success: function(data){ $('#imgModel').html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
}

function showImgModelToProduct(){
	$.ajax({url: 'search.php', data: "idPedido="+$('#idPedido').val(), type: 'POST', success: function(data){ $('#showModelsProduct').html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
}

function showAllToProduct(){
	showImgModelToProduct();
	showDataCInProduct();
	showDataM();
	setSpf();
}

function checkSelectModel(){
	document.getElementById("idModelo").selectedIndex = 0;
	if(document.getElementById("idModelo").selectedIndex == 0){
		$('#imgModel').html("");
	}
}

function showDataC(){
	$.ajax({url: 'search.php', data: "idC="+$('#idCliente').val(), type: 'POST', success: function(data){ $('#showClientData').html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
}

function showDataM(){
	$.ajax({url: 'search.php', data: "idP="+$('#idPedido').val(), type: 'POST', success: function(data){ $('#showModelData').html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
}

function showDataCInProduct(){
	var idP2 = $('#idPedido').val();
	var idProducto = $('#idProducto').val();
		$.ajax({url: 'search.php', data: {idP2:idP2, idProducto:idProducto}, type: 'POST', success: function(data){ $('#showClientData').html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
}

function showMaqInfo(){
	var idMaq = $('#idMaquina').val();
	var idP3 = $('#idPedido').val();
	if(idMaq != "" && idP3 != ""){
		$.ajax({url: 'search.php', data: {idMaq:idMaq, idP3:idP3}, type: 'POST', success: function(data){ $('#showMaqInformation').html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
	}
}

function checkDM(){
	var a = document.getElementById("anchoI");
	var l = document.getElementById("largoI");
	if($('#idPedido').val() == ""){
		if($('input:radio[name=medidas]:checked').length > 0){
			if($('input:radio[name=medidas]:checked').val() == "1"){
				a.readOnly = false;
				l.readOnly = false;
				a.value = "";
				l.value = "";
			}else{
				a.readOnly = true;
				l.readOnly = true;
				a.value = "N/A";
				l.value = "N/A";
			}
		}
	}else{
		if($('input:radio[name=medidas]:checked').val() == "1"){
			a.readOnly = false;
			l.readOnly = false;
			if(document.getElementById("anchoIBD").value != "N/A"){
				a.value = document.getElementById("anchoIBD").value;
				l.value = document.getElementById("largoIBD").value;
			}else{
				a.value = "";
				l.value = "";
			}
		}else{
			a.readOnly = true;
			l.readOnly = true;
			a.value = "N/A";
			l.value = "N/A";
		}
	}
}

function setSpf(){
	if(document.getElementById("folio").value != ""){
		document.getElementById("sfproduct").innerHTML = document.getElementById("folio").value;
	}
}

function getControlsToFormProduct(c=""){
	var ln = $("#ln").val();
	var id = $("#idPedido").val();
	var idControl = $("#btnC"+c).val();
	var piezasEnd = $("#piezas"+c).val();
	var idOperador = $("#idOperador").val();
	var idProducto = $('#idProducto').val();
	if(ln >=1){
		if(idControl){
			Swal.fire({
				title: '¿Lote terminado?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Aceptar'
			}).then((result) =>{
				if(result.isConfirmed){
					$.ajax({url: 'search.php', data: {ln:ln, idP4:id, idControl:idControl, piezasEnd:piezasEnd, idOperador:idOperador, idProduct2:idProducto}, type: 'POST', success: function(data){
						$('#showDataControls').html(data);
						let datos = new FormData($('#data')[0]);
						$.ajax({url:'save.php', data:datos, processData:false, contentType:false, type:'POST', success: function(data){
							if(data == 'Perfect'){
								Swal.fire({
									title: 'Guardado Exitoso',
									icon: 'success',
									showConfirmButton: false,
									timer:1100
								})
								$.ajax({url: 'search.php', data: {ln:ln, idP4:id, idControl:idControl, piezasEnd:piezasEnd, idOperador:idOperador, idProduct2:idProducto}, type: 'POST', success: function(data){ console.log(1); $('#showDataControls').html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
							}else if(data == 'Bad'){
								Swal.fire({
									title: "Algo salio mal\nGuardado incorrecto",
									icon: 'error',
									showConfirmButton: false,
									timer: 1100
								})
							}else{
								Swal.fire({
									title: data,
									icon: 'warning',
									showConfirmButton: false,
									timer:1500
								})
							}},
							error: function(fqXHR, textStatus,errorThrow){ 
									console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error")
							});
						},
						error: function(fqXHR, textStatus,errorThrow){ 
								console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error")
						});
				}else if(result.dismiss === Swal.DismissReason.cancel){
		
				}
			})
		}else{
			$.ajax({url: 'search.php', data: {ln:ln, idP4:id, idControl:idControl, piezasEnd:piezasEnd, idOperador:idOperador, idProduct2:idProducto}, type: 'POST', success: function(data){ $('#showDataControls').html(data);}, error: function(fqXHR, textStatus, errorThrow){ console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error");});
		}
	}else{
		$('#showDataControls').html("");
	}
}

function saveDataControl(){
	let datos = new FormData($('#data')[0]);
	//let datos = $('#data').serializeArray();
	Swal.fire({
		title: '¿Lote terminado?',
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar'
	}).then((result) =>{
		if(result.isConfirmed){
			$.ajax({url:'save.php', data:datos, processData:false, contentType:false, type:'POST', success: function(data){
				if(data == 'Perfect'){
					Swal.fire({
						title: 'Guardado Exitoso',
						icon: 'success',
						showConfirmButton: false,
						timer:1100
					})
				}else if(data == 'Bad'){
					Swal.fire({
						title: "Algo salio mal\nGuardado incorrecto",
						icon: 'error',
						showConfirmButton: false,
						timer: 1100
					})
				}else{
					Swal.fire({
						title: data,
						icon: 'warning',
						showConfirmButton: false,
						timer:1500
					})
				}},
				error: function(fqXHR, textStatus,errorThrow){ 
						console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error")
				});
		}else if(result.dismiss === Swal.DismissReason.cancel){

		}
	}) 
}

function hideLotes(r){
	for(var i = -1; $("#ln").val() > i;i++){
		if(r == i){
			if($('.showLote'+i).is(":visible")){
				$('.showLote'+i).hide();
				document.getElementById("dB").className = 'fa fa-eye';
			}else{
				$('.showLote'+i).show();
				document.getElementById("dB").className = 'fa fa-eye-slash';
			}
		}
	}
}

function logoutt(){
	var d = "";
	var h = new Date().getHours();
	if(h >= 1 && h <= 11){
		d = "🌄 Que tenga un buen dia!";
	}else if(h >= 12 && h <= 18){
		d = "🌞 Que tenga bonita tarde!";
	}else if(h >= 19 && h <= 23){
		d = "🌚 Que tenga una buena noche!";
	}
	Swal.fire({
		title:'¿Desea salir?',
		icon:'question',
		showCancelButton: true,
		confirmButtonColor:'#3085d6',
		cancelButtonColor:'#d33',
		confirmButtonText:'Aceptar'
	}).then((result) => {
		if(result.isConfirmed){
			Swal.fire({
				title: d,
				icon: 'success',
				showConfirmButton: false,
				allowOutsideClick: false,
				timer: 1300,
				timerProgressBar: true,
				didOpen: () =>{
					Swal.showLoading();
				}
			}).then((result) => {
				if(result.dismiss === Swal.DismissReason.timer){
					window.location.href="../../lib/logout";
				}
			});
		}else if(result.dismiss === Swal.DismissReason.cancel){
			
		}
	})
}