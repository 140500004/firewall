
function removerGrupo(id, nome){
    document.getElementById('grupo').innerHTML = "  "+nome;
    document.getElementById('modal_delete_grupo').action = 'http://192.168.2.1/grupo/'+ id;
}


function removerUsuario(){
    var id = document.getElementById('id').value;
    document.getElementById('modal_delete_usuario').action = 'http://192.168.2.1/usuario/'+ id;
}


function listaUsuario(id, nome, login, senha, id_grupo, status){
    document.getElementById('id').value = id;
    document.getElementById('nome').innerHTML = nome;
    document.getElementById('usuario').value = nome;
    document.getElementById('login').value = login;
    //document.getElementById('senha').value = senha;
    //document.getElementById('senhaC').value = senha;
    document.getElementById("id_grupo").selectedIndex = id_grupo;
    document.getElementById("status").checked = false;

    if( status == "I" ){
        document.getElementById("status").checked = true;
    }
}
