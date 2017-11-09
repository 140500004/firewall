<?php

function mensagem($msn){
    echo "
           <div class='alert alert-danger alert-block'>
                <button type='button' class='close' data-dismiss='alert'>×</button>
                <strong>$msn</strong>
            </div>
    ";
    exit();
}

function restore(){
}

function squid($linha, $texto){
    $all = $linha . " >> /etc/squid3/body.conf";
    shell($all, $texto);
}

function shell($shell, $texto){
    $saida = shell_exec("$shell; echo $?");
    $saida = substr("$saida",-2); // Remover o ultimo campo com o espaço
    if( $saida != 0 ){
        mensagem($texto);
        return 0;
    }
}

function limparArquivos(){
    shell_exec("echo -n > /etc/squid3/arquivos/liberados.txt"); #Arquivo Liberado
    shell_exec("echo -n > /etc/squid3/arquivos/bloqueados.txt"); #Arquivo bloqueado
    shell_exec("echo -n > /etc/squid3/arquivos/ip/IpBloqueados.txt"); #Arquivo IP Bloqueados
    shell_exec("echo -n > /etc/squid3/arquivos/ip/IpLiberados.txt"); #Arquivo Ip Liberados
    shell_exec("echo -n > /etc/squid3/body.conf"); #Arquivo body do squid

    shell_exec("rm -rf /etc/squid3/arquivos/grupos/*"); #Limpar pasta 'grupo'
    shell_exec("rm -rf /etc/squid3/arquivos/url/*"); # Limpar pasta 'url'
    shell_exec("rm -rf /etc/squid3/arquivos/users/*"); #Limpar pasta 'users'
}

    ### Busca informações do banco para o arquivo do squid
    limparArquivos();

    ### Busca sites liberados geral ###
    $sql = DB::select("select url from regras WHERE tipo = 'L' and id_grupo is null and id_usuario is null");
    foreach ( $sql as $s ) {
        $linha = "echo \"$s->url\" ";
        $diretorio = " >> /etc/squid3/arquivos/";
        $arquivo = "liberados.txt";

        $all = $linha . $diretorio . $arquivo;
        shell($all, 'Erro na aplicação na busca de sites liberados entre em contato com o administrator #Error1001');
    }


    ## Busca sites bloqueados gereal
    $sql = DB::select("select url from regras WHERE tipo = 'B' and id_grupo is null and id_usuario is null");
    foreach ( $sql as $s ) {
        $linha = "echo \"$s->url\" ";
        $diretorio = " >> /etc/squid3/arquivos/";
        $arquivo = "bloqueados.txt";

        $all = $linha . $diretorio . $arquivo;
        shell($all, 'Erro na aplicação na busca de sites bloqueados entre em contato com o administrator #Error1002');
    }


    ## Busca IP's Liberados
    $sql = DB::select("select ip from ips where tipo = 'L'");
    foreach ( $sql as $s ) {
        $linha = "echo \"$s->ip\" ";
        $diretorio = " >> /etc/squid3/arquivos/ip/";
        $arquivo = "IpLiberados.txt";

        $all = $linha . $diretorio . $arquivo;
        shell($all, 'Erro na aplicação na busca de sites ip`s liberados entre em contato com o administrator #Error1003');
    }


    ## Busca IP's Bloqueados
    $sql = DB::select("select ip from ips where tipo = 'B'");
    foreach ( $sql as $s ) {
        $linha = "echo \"$s->ip\" ";
        $diretorio = " >> /etc/squid3/arquivos/ip/";
        $arquivo = "IpBloqueados.txt";

        $all = $linha . $diretorio . $arquivo;
        shell($all, 'Erro na aplicação na busca de sites ip`s liberados entre em contato com o administrator #Error1004');
    }


    ## Busca usuarios para auth
    $sql = DB::select("SELECT login FROM usuarios");
    foreach ( $sql as $s ) {
        $linha = "echo \"acl u_" . $s->login. " proxy_auth " . $s->login . "\"";
        squid($linha, 'Erro na aplicação na busca dos usuarios entre em contato com o administrator #Error1005');
    }


    ## Busca grupos para auth
    $sql = DB::select("SELECT nome as grupo FROM grupos");
    foreach ( $sql as $s ) {
        $linha = "echo \"acl g_" . $s->grupo. " proxy_auth " . $s->grupo . " \\\"/etc/squid3/arquivos/grupos/g_" . $s->grupo . ".txt\\\"\"";
        squid($linha, 'Erro na aplicação na busca dos grupos entre em contato com o administrator #Error1006');
    }


    ## Busca usuarios dos grupos
    $sql = DB::select("select g.nome as grupo, u.login as usuario from grupos g, usuarios u where u.id_grupo = g.id_grupo");
    foreach ( $sql as $s ) {
        $linha = "echo \"". $s->usuario . "\" ";
        $diretorio = ">> /etc/squid3/arquivos/grupos/";
        $arquivo = "g_". $s->grupo . ".txt";
        $all = $linha . $diretorio . $arquivo;
        shell($all, 'Erro na aplicação na busca dos usuario para o grupos entre em contato com o administrator #Error1007');
    }


    ## url_regex grupos liberados
    $sql = DB::select("SELECT nome as grupo FROM grupos");
    foreach ( $sql as $s ) {
        $linha = "echo \"acl rgl_" . $s->grupo . " url_regex -i \\\"/etc/squid3/arquivos/url/rgl_" . $s->grupo . ".txt\\\"\"";
        squid($linha, 'Erro na aplicação na busca dos url_regex do grupo entre em contato com o administrator #Error1008');
    }

    ## url_regex grupos bloqueados
    $sql = DB::select("SELECT nome as grupo FROM grupos");
    foreach ( $sql as $s ) {
        $linha = "echo \"acl rgb_" . $s->grupo . " url_regex -i \\\"/etc/squid3/arquivos/url/rgb_" . $s->grupo . ".txt\\\"\"";
        squid($linha, 'Erro na aplicação na busca dos url_regex do grupo entre em contato com o administrator #Error1009');
    }


    ## Busca regras para o grupo liberados
    $sql = DB::select("select g.nome as grupo, r.url as regras from grupos g, regras r where r.id_grupo = g.id_grupo and tipo = 'L'");
    foreach ( $sql as $s ) {
        $linha = "echo \"". $s->regras . "\" ";
        $diretorio = ">> /etc/squid3/arquivos/url/";
        $arquivo = "rgl_". $s->grupo . ".txt";
        $all = $linha . $diretorio . $arquivo;
        shell($all, 'Erro na aplicação na busca das regras para os grupos entre em contato com o administrator #Error1010');
    }


    ## Busca regras para o grupo bloqueadas
    $sql = DB::select("select g.nome as grupo, r.url as regras from grupos g, regras r where r.id_grupo = g.id_grupo and tipo = 'B'");
    foreach ( $sql as $s ) {
        $linha = "echo \"". $s->regras . "\" ";
        $diretorio = ">> /etc/squid3/arquivos/url/";
        $arquivo = "rgb_". $s->grupo . ".txt";
        $all = $linha . $diretorio . $arquivo;
        shell($all, 'Erro na aplicação na busca das regras para os grupos entre em contato com o administrator #Error1011');
    }


    ## url_regex usuario liberados
    $sql = DB::select("select login as usuario from usuarios");
    foreach ( $sql as $s ) {
        $linha = "echo \"acl rul_" . $s->usuario . " url_regex -i \\\"/etc/squid3/arquivos/users/rul_" . $s->usuario . ".txt\\\"\"";
        squid($linha, 'Erro na aplicação na busca dos url_regex do usuario entre em contato com o administrator #Error1012');
    }

    ## url_regex usuario bloqueados
    $sql = DB::select("select login as usuario from usuarios");
    foreach ( $sql as $s ) {
        $linha = "echo \"acl rub_" . $s->usuario . " url_regex -i \\\"/etc/squid3/arquivos/users/rub_" . $s->usuario . ".txt\\\"\"";
        squid($linha, 'Erro na aplicação na busca dos url_regex do usuario entre em contato com o administrator #Error1013');
    }


    ## Busca regras para o usuario liberado
    $sql = DB::select("select u.login as usuario, r.url regras from usuarios u, regras r where r.id_usuario = u.id_usuario and tipo = 'L'");
    foreach ( $sql as $s ) {
        $linha = "echo \"". $s->regras . "\" ";
        $diretorio = ">> /etc/squid3/arquivos/users/";
        $arquivo = "rul_". $s->usuario . ".txt";
        $all = $linha . $diretorio . $arquivo;
        shell($all, 'Erro na aplicação na busca das regras para os usuario entre em contato com o administrator #Error1014');
    }


    ## Busca regras para o usuario bloqueados
    $sql = DB::select("select u.login as usuario, r.url regras from usuarios u, regras r where r.id_usuario = u.id_usuario and tipo = 'B'");
    foreach ( $sql as $s ) {
        $linha = "echo \"". $s->regras . "\" ";
        $diretorio = ">> /etc/squid3/arquivos/users/";
        $arquivo = "rub_". $s->usuario . ".txt";
        $all = $linha . $diretorio . $arquivo;
        shell($all, 'Erro na aplicação na busca das regras para os usuario entre em contato com o administrator #Error1015');
    }


/*
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



    ### Arquivo com as configurações final ###
    $result = $mysqli->query("select tipo from conf;");
    while ($dados = $result->fetch_assoc()) {
        $linha = "echo \"http_access ". $dados['tipo'] . " all\"";
        $diretorio = " > /etc/squid3/";
        $arquivo = "footer.conf";

        $res = comando($linha, $diretorio, $arquivo);

        if( $res != 0 ){
            erro('Erro na aplicação entre em contato com o administrator #Error1014');
            return;
        }
    }
    //echo "Arquivo fim - " . $i++ . "</br>";

    // Fecha o acesso ao banco
    mysqli_close($mysqli);

    ## Fim do Arquivo
    //echo "</br>Carregando Squid. ...";
    $saida = shell_exec("squid3 -k reconfigure; echo $?");
    $saida = substr("$saida",-2);
    if( $saida != 0 ){
        erro('Erro na aplicação entre em contato com o administrator #Error1015');
        return;
    }
    //echo "</br>Squid OK ....";
