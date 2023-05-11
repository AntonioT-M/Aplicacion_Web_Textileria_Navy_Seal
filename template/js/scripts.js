//$(document).ready(function(){ showimg();});

function logIn(){
    $.ajax({url: 'lib/process_login.php', data:{nick:$('#nick').val(), pass:$('#pass').val()}, type:'POST', success: function(data){
        if(data == 'Perfect'){
            Swal.fire({
                title: 'Bienvenid@',
                icon: 'success',
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 1200,
                timerProgressBar: true,
                didOpen: ()=>{
                    Swal.showLoading();
                }
            }).then((result) => {if(result.dismiss === Swal.DismissReason.timer){
                window.location.href="admin/index.php";
            }})
        }else if(data == 'Bad'){
            Swal.fire({
                title: 'Nick o Password incorrectos',
                text: 'Por favor intente de nuevo',
                icon: 'error',
                showConfirmButton: false,
                timer: 1200
            })
        }else{
            Swal.fire({
                title: data,
                icon: 'warning',
                showConfirmButton: false,
                timer: 1200
            })
        }
    }, error: function(fqXHR, textStatus,errorThrow){ 
        console.log(errorThrow)}}).fail(function(){alert("La peticion se termino de ejecutar pero hubo un error")
    });
}