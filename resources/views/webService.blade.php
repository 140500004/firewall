<?php

$mysqli = new mysqli("localhost", "linux", "12345", "firewall");

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}


function erro($msn){
    echo "
           <div class='alert alert-danger alert-block'>
                <button type='button' class='close' data-dismiss='alert'>×</button>
                <strong>$msn</strong>
            </div>
    ";
}

function comando($dados, $dir, $arq){
    $saida = shell_exec("$dados $dir$arq; echo $?");
    $saida = substr("$saida",-2); // Remover o ultimo vampos
    return $saida;
}

    $i = 1;

    # Limpar arquivo
    shell_exec("echo -n > /etc/squid3/arquivos/liberados.txt"); #Arquivo Liberado
    shell_exec("echo -n > /etc/squid3/arquivos/bloqueados.txt"); #Arquivo bloqueado
    shell_exec("echo -n > /etc/squid3/arquivos/ip/IpBloqueados.txt"); #Arquivo IP Bloqueados
    shell_exec("echo -n > /etc/squid3/arquivos/ip/IpLiberados.txt"); #Arquivo Ip Liberados
    shell_exec("echo -n > /etc/squid3/body3.conf"); #Arquivo body do squid

    # Arquivo Liberado
    $result = $mysqli->query("select url as regras from regras WHERE tipo = 'L' and id_grupo is null and id_usuario is null");
    while ($dados = $result->fetch_assoc()) {
        $linha = "echo \"". $dados['regras'] . "\"";
        $diretorio = " >> /etc/squid3/arquivos/";
        $arquivo = "liberados.txt";

        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1001');
            return ;
        }
    }
    //echo "Arquivo Liberado - " . $i++ . "</br>";

    # Arquivo Bloqueados
    $result = $mysqli->query("select url as regras from regras WHERE tipo = 'B' and id_grupo is null and id_usuario is null");
    while ($dados = $result->fetch_assoc()) {
        $linha = "echo \"". $dados['regras'] . "\"";
        $diretorio = " >> /etc/squid3/arquivos/";
        $arquivo = "bloqueados.txt";

        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1002');
            return;
        }
    }
    //echo "Arquivo Bloqueados - " . $i++. "</br>";

    # Usuario proxy_auth
    $result = $mysqli->query("SELECT login FROM usuarios");
    while ($dados = $result->fetch_assoc()) {
        $linha =  "echo \"acl u_" . $dados['login'] . " proxy_auth " . $dados['login'] . "\"";
        $diretorio = " >> /etc/squid3/";
        $arquivo = "body3.conf";

       $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1003');
            return;
        }
    }
    //echo "Usuario proxy_auth - " . $i++ . "</br>";

    #  Grupo proxy_auth
    $result = $mysqli->query("SELECT nome FROM grupos");
    while ($dados = $result->fetch_assoc()) {
        $linha =  "echo \"acl g_" . $dados['nome'] . " proxy_auth ";
        $linha .= "\\\"/etc/squid3/arquivos/grupos/g_" . $dados['nome'] . ".txt\\\"\"";
        $diretorio = " >> /etc/squid3/";
        $arquivo = "body3.conf";

        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1004');
            return;
        }
    }
    //echo "Grupo proxy_auth - " . $i++ . "</br>";

    #  Regras Grupos url_regex
    $result = $mysqli->query("SELECT nome FROM grupos");
    while ($dados = $result->fetch_assoc()) {
        $linha =  "echo \"acl rg_" . $dados['nome'] . " url_regex -i ";
        $linha .= "\\\"/etc/squid3/arquivos/url/rg_" . $dados['nome'] . ".txt\\\"\"";
        $diretorio = " >> /etc/squid3/";
        $arquivo = "body3.conf";

        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1005');
            return;
        }
    }
    //echo "Regras Grupos url_regex - " . $i++ . "</br>";

    # url_regex Regras Usuarios
    $result = $mysqli->query("select login as usuario from usuarios");
    while ($dados = $result->fetch_assoc()) {
        $linha = "echo \"acl ru_". $dados['usuario'] . " url_regex -i ";
        $linha .= "\\\"/etc/squid3/arquivos/users/ru_". $dados['usuario'] . ".txt\\\"\"";
        $diretorio = " >> /etc/squid3/";
        $arquivo = "body3.conf";

        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1006');
            return;
        }
    }
    //echo "url_regex Regras Usuarios - " . $i++ . "</br>";

    # http_access Usuario
    $result = $mysqli->query("SELECT login FROM usuarios");
    while ($dados = $result->fetch_assoc()) {
        $linha =  "echo \"http_access allow u_" . $dados['login'] . " ru_" . $dados['login']. "\"";
        $diretorio = " >> /etc/squid3/";
        $arquivo = "body3.conf";

        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1007');
            return;
        }
    }
    //echo "http_access Usuario - " . $i++ . "</br>";

    # http_access Grupo
    $result = $mysqli->query("select nome from grupos");
    while ($dados = $result->fetch_assoc()) {
        $linha =  "echo \"http_access allow g_" . $dados['nome'] . " rg_" . $dados['nome']. "\"";
        $diretorio = " >> /etc/squid3/";
        $arquivo = "body3.conf";

        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1008');
            return;
        }
    }
    //echo "http_access Grupo - " . $i++ . "</br>";

    ### Add dados nos arquivos
    $result = $mysqli->query("select u.login as usuario, r.url regras from usuarios u, regras r where r.id_usuario = u.id_usuario;");
    while ($dados = $result->fetch_assoc()) {
        $linha = "echo \"". $dados['regras'] . "\"";
        $diretorio = " > /etc/squid3/arquivos/users/";
        $arquivo = "ru_". $dados['usuario'] . ".txt";

        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1009');
            return;
        }
    }
    //echo "Regras para o Usuario - " . $i++ . "</br>";

    ###  Users para o Grupo ###
    $result = $mysqli->query("select g.nome as grupo, u.login as usuario from grupos g, usuarios u where u.id_grupo = g.id_grupo");
    while ($dados = $result->fetch_assoc()) {
        $linha = "echo \"". $dados['usuario'] . "\"";
        $diretorio = " >> /etc/squid3/arquivos/grupos/";
        $arquivo = "g_". $dados['grupo'] . ".txt";

        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1010');
            return;
        }
    }
    //echo "Users para o Grupo - " . $i++ . "</br>";

    ###  Regras para o Grupo ###
    $result = $mysqli->query("select g.nome as grupo, r.url as regras from grupos g, regras r where r.id_grupo = g.id_grupo");
    while ($dados = $result->fetch_assoc()) {
        $linha = "echo \"". $dados['regras'] . "\"";
        $diretorio = " > /etc/squid3/arquivos/url/";
        $arquivo = "rg_". $dados['grupo'] . ".txt";

        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1011');
            return;
        }
    }
    //echo "Regras para o Grupo  - " . $i++ . "</br>";

    ### Ip's Liberado ###
    $result = $mysqli->query("select ip from ips where tipo = 'L';");
    while ($dados = $result->fetch_assoc()) {
        $linha = "echo \"". $dados['ip'] . "\"";
        $diretorio = " > /etc/squid3/arquivos/ip/";
        $arquivo = "IpLiberados.txt";


        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1012');
            return;
        }
    }
    //echo "Ips Liberados - " . $i++ . "</br>";

    ### Ip's Bloqueados ###
    $result = $mysqli->query("select ip from ips where tipo = 'B';");
    while ($dados = $result->fetch_assoc()) {
        $linha = "echo \"". $dados['ip'] . "\"";
        $diretorio = " > /etc/squid3/arquivos/ip/";
        $arquivo = "IpBloqueados.txt";


        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1013');
            return;
        }
    }
    //echo "Ips Bloqueados - " . $i++ . "</br>";

    ## Fim do Arquivo
    //echo "</br>Carregando Squid. ...";
    $saida = shell_exec("squid3 -k reconfigure; echo $?");
    $saida = substr("$saida",-2);
    if( $saida != 0 ){
        erro('Erro na aplicação entre em contato com o administrator #Error1014');
        return;
    }
    //echo "</br>Squid OK ....";
