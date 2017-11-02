
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
