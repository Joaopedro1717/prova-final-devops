"# prova-final-devops" 
-
- João Pedro de Oliveira dos Santos Costa
-
## Dockerfile node-api ##

Primeiramente no dockerfile da node-api, utilizamos o **ambiende do node versão 18** que traz consigo a imagem do node.js e o npm instalados e prontos para uso, a partir daí definimos o diretório com o **WORKDIR** para a pasta **/app**, caso ela não exista o docker irá cria-lô, após isto, utilizamos o **COPY** para copiarmos o diretório local para dentro do diretório de trabalho (/app), permitindo que o app.js esteja disponível dentro do container docker, apos isso executamos um **RUN npm intalll** o que inicia um projeto node com um package.json padrão, aceitando as opções, e também instalando todas as dependencias do projeto, neste caso, apenas o express, após isso damos um **COPY** que copiará os arquivos, neste caso apenas o app.js para nossa pasta padrão, após isso executamos o **EXPOSE** que diz que nosso container escutará a porta 3001 e por fim utilizamos o **CMD["node", "app.js"]** que por fim, sinalizará o container para que ao rodar, ele execute o node app.js iniciando o programa.

## Dockerfile flask-api ##

Primeiramente inicamos assim como na node-api dizendo para que utilizemos o ambiente do **python 3.10** que vem com o python e o gerenciador pip instalados, apos isso definimos o workdir para /app, que será o nosso diretório principal da aplicacão, apos isso, copiamos o arquivo app.py para dentro de nosso diretório e em seguida usamos o **RUN** para rodarmos os comandos para baixarmos as dependencias, neste caso flask, redis, requests e o mysql-connector, após baixamos no ambiente da imagem, utilizamos o **EXPOSE** para indicarmos que nossa aplicação fará o uso da porta 3002, e logo após isso utilizamos o **CMD** para denifinirmos o comando que o container usará ao inicar python app.py.

## Dockerfile php-api ##

Primeiramente utilizando o **FROM**, dizemos para o container que utilizaremos o ambiente da imagem 8.2 do PHP, essa versão faz com que não necessitemos de utilizar APACHE ou NGINX, e também inclui o comando php já pronto para uso, apos isso utilizamos o **WORKDIR** e definimos nossa pasta padrão para /app, a qual após criada todos nossos comandos serão executados dentro dela, após isso utilizamos o **COPY** para copiar o arquivo index.php e o router.php que o executa, para dentro da /app, após isso indicamos com o **EXPOSE** que nossa aplicação está na porta 3003, logo após isso damos uma **CMD** que define o comando que será utilizado ao iniciar o container, neste caso php -S 0.0.0.0:3003 router.php.

## Docker-Compse ##

Primeiramente definimos como a versão de sintaxe do docker a versão **3.8**, após isso definimos dentro da **services** todos os containers que serão criados e gerenciados, cada um deles cria um container a partir do Dockerfile que está dentro de sua respectiva pasta, por exemplo, no caso da api-php criará container com base no dockerfile que está dentro de sua pasta, isso não vale apenas para as apis mas também para **REDIS** e o **MYSQL**, que instancia a imagem de cada um destes serviços, no caso da flask-api, ela possui uma diferença que esta no **depends-on** que garante que a api-node, o redis e o mysql sejam executadas antes dela, e o **PYTHONUNBUFFERED** que evita buffer, após isso vem a php-api que também possui um depends-on na api-flask, após isso definimos o volume com mysql-data que é utilizado para o armazenamento de dados no banco e sua persistência.
