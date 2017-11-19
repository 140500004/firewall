
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
            cancelButtonText: 'Não, Cancelar',
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
        cancelButtonText: 'Não, Cancelar',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false

    },function(isConfirm){
        if (isConfirm) {
            form.unbind('submit').submit();
        }
    });
});


// ocultar campos label
$("#senhat").css("display", "none");
$("#senhact").css("display", "none");

function validaSenha(){
    $("#senhat").css("display", "inline");
    $("#senhact").css("display", "inline");

    document.getElementById('senhat').innerHTML = "Senha fraca utilizer uma senha mais forte";
    document.getElementById('senhact').innerHTML = "Senha diferente";

    $(".senha, .senhac").css("border", "2px solid #FF0000");
    $(".senha, .senhac").css("background-color", "#ffdddd");

    senha = document.getElementById("senha").value;
    forca = 0;
    if(senha.length >= 6){
        forca += 10;
    }
    if(senha.length > 8){
        forca += 25;
    }
    if(senha.match(/[a-z]+/)){
        forca += 10;
    }
    if(senha.match(/[A-Z]+/)){
        forca += 20;
    }
    if(senha.match(/d+/)){
        forca += 20;
    }
    if(senha.match(/W+/)){
        forca += 25;
    }


    if(forca < 40){
        document.getElementById('senhat').innerHTML = "Senha fraca utilizer uma senha mais forte";
    }else if((forca >= 40) && (forca < 60)){
        document.getElementById("senhat").attributes["class"].value="label label-warning";
        $(".senha").css("border", "2px solid #8a6d3b");
        $(".senha").css("background-color", "#fcf8e3");
        document.getElementById('senhat').innerHTML = "Senha justa";
    }else if((forca >= 60) && (forca < 85)){
        document.getElementById("senhat").attributes["class"].value="label label-info"
        $(".senha").css("border", "2px solid #31708f");
        $(".senha").css("background-color", "#d9edf7");
        document.getElementById('senhat').innerHTML = "Senha forte ";
    }else{
        document.getElementById("senhat").attributes["class"].value="label label-success"
        $(".senha").css("border", "2px solid #3c763d");
        $(".senha").css("background-color", "#dff0d8");
        document.getElementById('senhat').innerHTML = "Senha excelente ";
    }
    //document.getElementById('senhat').innerHTML += forca;
}

function ConfirmeSenha(){
    senha = document.getElementById("senha").value;
    senhac = document.getElementById("senhac").value;

    if (senha == senhac){
        document.getElementById("senhact").attributes["class"].value="label label-success"
        $(".senhac").css("border", "2px solid #3c763d");
        $(".senhac").css("background-color", "#dff0d8");
        document.getElementById('senhact').innerHTML = "Senha Consiste";
    }else{
        document.getElementById("senhact").attributes["class"].value="label label-warning";
        $(".senhac").css("border", "2px solid #FF0000");
        $(".senhac").css("background-color", "#ffdddd");
        document.getElementById('senhact').innerHTML = "Senha diferente";
    }
}