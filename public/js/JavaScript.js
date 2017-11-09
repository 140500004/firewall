
function removerGrupo(id, nome){
    document.getElementById('grupo').innerHTML = "  "+nome;
    document.getElementById('modal_delete_grupo').action = 'http://192.168.2.1/grupo/'+ id;
}

function grupousuario(id, nome){
    document.getElementById("id_grupo").value = id;
    document.getElementById("nomegrupo").value = nome;
}


function removerUsuario(){
    var id = document.getElementById('id').value;
    document.getElementById('modal_delete_usuario').action = 'http://192.168.2.1/usuario/'+ id;
}

$(document).ready(function(){
     $("[data-tt=tooltip]").tooltip();
});

$(document).ready(function(){
    $("#myModal").modal();
});


$(".conf-update").submit(function(e){
    var form = $(this);
    e.preventDefault();
        swal({
            title: 'Atenção!',
            text: "Apos atualiza você não poderá reverter isso!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, Atualiza',
            cancelButtonText: 'Não Cancelar',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false

        },function(isConfirm){
            if (isConfirm) {
                form.unbind('submit').submit();
            }
        });
});


$(".conf-drop").submit(function(e){
    var form = $(this);
    e.preventDefault();
    swal({
        title: 'Atenção!',
        text: "Apos excluir não poderá reverter isso!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, Excluir',
        cancelButtonText: 'Não Cancelar',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false

    },function(isConfirm){
        if (isConfirm) {
            form.unbind('submit').submit();
        }
    });
});