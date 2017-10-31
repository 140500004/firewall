create database firewall;

use firewall;

create table usuario(
    id_usuario int not null primary key auto_increment,
    nome varchar(50) not null,
    senha varchar(50) not null,
    id_grupo int null,
    unique(nome)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

create table grupo(
    id_grupo int not null primary key auto_increment,
    nome varchar(50) not null,
    unique(nome)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE usuario ADD FOREIGN KEY (id_grupo) REFERENCES grupo(id_grupo);


create table ip(
    id_ip int null primary key auto_increment,
    ip varchar(50) not null,
	descricao varchar(50) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

create table regras(
    id_regras int not null primary key auto_increment,
    id_grupo int null,
    id_usuario int null,
	id_ip int null,
    tipo enum('L','B') NOT NULL DEFAULT 'B',
    url varchar(50) not null,
    descricao varchar(50) null,
    unique(id_grupo,url),
    unique(id_usuario,url),
    unique(tipo,url),
    unique(id_grupo,id_usuario,tipo,url),
	unique(id_ip,url)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE regras ADD FOREIGN KEY (id_grupo) REFERENCES grupo(id_grupo);
ALTER TABLE regras ADD FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);
ALTER TABLE regras ADD FOREIGN KEY (id_ip) REFERENCES ip(id_ip);

--- Dados para Teste

-- Grupos
INSERT INTO grupo(nome) VALUES('RH'), ('TI'), ('SAC'), ('Logistica');

-- Usuarios
INSERT INTO usuario(nome, senha, id_grupo) VALUES('admin','mudar123','2'), ('Italo','password', null), ('Marlon','password','2'), ('Teste','Mudar','1');

-- IP's
INSERT INTO ip(ip, descricao) VALUES ('192.168.0.20', 'TI789');
INSERT INTO ip(ip, descricao) VALUES ('192.168.0.30', 'TI000');
INSERT INTO ip(ip, descricao) VALUES ('192.168.0.40', 'TI500');
INSERT INTO ip(ip, descricao) VALUES ('192.168.0.1', 'SRV');

-- Regras
INSERT INTO regras(id_grupo, tipo, url) VALUES ('1', 'L', 'caixa.com.br'), ('1', 'B', 'bb.com.br'), ('1', 'L', 'bradesco.com.br');
INSERT INTO regras(id_usuario, tipo, url) VALUES ('3', 'B', 'facebook.com'), ('2', 'L', 'facebook.com');
INSERT INTO regras(tipo, url) VALUES ('B', 'google.com');
INSERT INTO regras(id_ip, tipo, url) VALUES ('1', 'L', 'marlon.com.br'), ('1', 'L', 'casaaldim.com.br'), ('2', 'B', 'bradesco.com.br'), ('3', 'B', '*');

-- Usuarios e grupo / Grupo usuario
SELECT u.id_usuario, u.nome, g.id_grupo, g.nome as grupo FROM usuario u, grupo g WHERE u.id_grupo = g.id_grupo;

-- Regras Grupo
select r.id_regras, r.id_grupo, g.nome as grupo, r.tipo, r.url, r.descricao from grupo g, regras r WHERE r.id_grupo = g.id_grupo;

-- Regras Usuario
select r.id_regras, r.id_usuario, u.nome as usuario, r.tipo, r.url, r.descricao from usuario u, regras r WHERE r.id_usuario = u.id_usuario;

-- usuario sem grupo
SELECT * FROM usuario WHERE id_grupo is null

-- Regras All
select id_regras, tipo, url, descricao from regras WHERE id_grupo is null and id_usuario is null;

-- IP's
SELECT ip.id_ip, ip.ip, r.tipo, r.url, ip.descricao as descricao_do_ip, r.descricao as descricao_do_regras FROM ip, regras r WHERE ip.id_ip = r.id_ip; 
