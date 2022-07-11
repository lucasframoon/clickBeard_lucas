# clickBeard_lucas
## 🔧 Ambiente
É necessário Docker e um editor para Mysql

Clonar o ambiente docker `git clone https://github.com/lucasframoon/docker-php-mysql.git`

Entrar no diretório 'docker-php', clone esse projeto `https://github.com/lucasframoon/clickBeard_lucas.git`

Renomear a pasta 'clickBeard_lucas' para 'public'

Abrir no editor

executar o comando: `docker-compose up` (iá baixar e montar as imagens necessárias)

Após finalizar, você deve conseguir acessar: localhost:45000
  
### 📋[BANCO DE DADOS]
O docker roda imagem do mysql, está configurado para a porta 45002

>configuração-> host=mysql; dbname=sampleDb; user: userdb; password: secret;
  
Dentro do clone do projeto há um DUMP da base de dados em MySql (public/assets/dumps)

Recupere o dump(terá as tabelas e alguns dados)
