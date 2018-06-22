
<h1>Programas Necessários e Úteis</h1>
<ul>
    <li><a href="https://laravel.com/docs/5.6/homestead">Homestead</a></li>
    <li><a href="https://laravel.com/docs/5.6">Laravel 5.6</a></li>
    <li><a href="https://www.virtualbox.org/">VirtualBox</a></li>
    <li><a href="https://www.vagrantup.com/">Vagrant</a></li>
    <li><a href="https://git-scm.com/">Git Bash</a></li>
    <li><a href="https://notepad-plus-plus.org/download/v7.5.6.html">Notepad++</a></li>
    <li><a href="https://www.jetbrains.com/phpstorm/">IDE PHPStorm</a></li>
    <li><a href="https://nodejs.org/en/download/">Node.js</a></li>
</ul>
<h1>Configuração de Ambiente</h1>
<p><strong>Gerar Chave Homestead</strong><br>
    <code>ssh-keygen -t rsa -C "teste@teste.com.br"</code>
</p>

<p><strong>Instalar os Plugins do Vagrant para Adcionar automaticamente os Host's do Windows.</strong><br>
    <code>vagrant plugin install vagrant-hostsupdater</code><br>
    <code>vagrant plugin update vagrant-hostsupdater</code>
</p>

<p><strong>Dar Permissão da Pasta do Windows</strong><br>
    <code>C:\Windows\System32\drivers\etc</code>
</p>

<p><strong>Iniciar Vagrant</strong><br>
    <code>vagrant up</code>
</p>

<p><strong>Depois que seu Vagrant Uma vez que o site foi adicionado, execute o comando do seu diretório
    Homestead.</strong><br>
    <code>vagrant reload --provision</code>
</p>

<h1>Instalação do Oracle no PHP 7.2 dentro do Homestead</h1>
<p><code>vagrant ssh</code><br>
    <code>sudo apt-get update</code><br>
    <code>sudo apt-get install php7.2-dev build-essential php-pear libaio1 alien</code><br>
    <code>sudo chmod -R 777 Code</code> <em>opcional</em><br>
    <code>sudo alien Code/area-restrita/extras/oracle-instantclient-basic-10.2.0.4-1.x86_64.rpm</code><br>
    <code>sudo alien Code/area-restrita/extras/oracle-instantclient-devel-10.2.0.4-1.x86_64.rpm</code><br>
    <code>sudo dpkg -i oracle-instantclient-basic_10.2.0.4-2_amd64.deb</code><br>
    <code>sudo dpkg -i oracle-instantclient-devel_10.2.0.4-2_amd64.deb</code><br>
    <code>sudo pecl install oci8</code></p>

<p>Adcionar extensão do Oracle <code>extension=oci8.so;</code> ao arquivo PHP.ini<br>
    <code>sudo nano /etc/php/7.2/cli/php.ini</code><br>
    <code>sudo nano /etc/php/7.2/fpm/php.ini</code><br>
    <code>Ctrl+x</code> Para Salvar</p>

<p>Agora temos que reiniciar o Homestead
    <code>exit</code> Para Sair<br>
    <code>vagrant reload --provision</code> para Reiniciar todas aplicações</p>


<h1>Configurar Projeto</h1>
<p></p>


<h1>Configuração da Ferramenta para Gerar PDF</h1>
<p>Dentro da Pasta do Projeto executar os comandos abaixo:<br>
    <code>sudo cp vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64 /usr/local/bin/</code><br>
    <code>sudo cp vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64 /usr/local/bin/</code><br>
    <code>sudo chmod +x /usr/local/bin/wkhtmltoimage-amd64</code><br>
    <code>sudo chmod +x /usr/local/bin/wkhtmltopdf-amd64</code><br>
</p>


<h1>Instalar NPM(Node.js) no Windows</h1>
<p>Dentro da Pasta do Projeto executar os comandos abaixo:<br>
    <code>npm install --no-bin-links</code><br>
    <code>npm rebuild node-sass --no-bin-links</code><br>
    <code>npm i -g npm</code><br>
    <code>npm run dev</code><br>
    <code>npm run watch</code><br>
</p>

<h1>Erros e Soluções do Projeto</h1>
<p>
<code>Erro: "The only supported ciphers are AES-128-CBC and AES-256-CBC with the correct key lengths" </code>
<br>
<code>Solução: "php artisan key:generate" </code>
<br>
<code>Descrição: O erro acontece quando a chave ultrapassa o tamanho de 32 caracteres</code>
<br>
<br>
<code> Erro: "could not find driver (SQL: select * from "users" where "email" = user@user.com.br limit 1)"</code>
<br>
<code>Solução: Acessar o vagrant, entrar na pasta raiz do projeto e executar o seguinte comando: "php artisan migrate"</code>
<br>
</p>