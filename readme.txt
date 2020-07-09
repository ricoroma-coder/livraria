Instruções:

Para implementar o projeto, alguns passos são necessários.

1º passo: Instale o comando composer na máquina, seguindo as instruções abaixo:
	## Linux e MacOS
		- Abra o terminal de comando;
		- Digite os comandos a seguir:
			php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
			php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
			php composer-setup.php --install-dir=bin --filename=composer
		- Configure o acesso ao composer de maneira global através do seguinte comando:
			sudo mv composer.phar /usr/local/bin/composer
		- Instalado!
	## Windows
		- Faça o download do setup no link a seguir:
			https://getcomposer.org/Composer-Setup.exe
		- Execute o arquivo .exe;
		- Instalado!

2º passo: Instale o Laravel:
	- Abra o terminal e execute o seguinte comando:
		composer global require laravel/installer
	- Instalado!

3º passo: Instale o Git:
	## Windows
		- Baixe o setup do Git no link abaixo:
			https://github.com/git-for-windows/git/releases/download/v2.27.0.windows.1/Git-2.27.0-64-bit.exe
		- Execute o setup e finalize a instalação;
		- Abra o terminal e configure nome e email através dos seguintes comandos:
			git config --global user.name "Seu nome"
			git config --global user.email "seuemail@host.com"
		- Instalado!
	
	## MacOS
		- Abra o terminal e confira a versão do git:
			git --version
		- Caso a resposta seja "git version 2.7.0 (Apple Git-66)" basta configurar nome e email através dos comandos:
			git config --global user.name "Seu nome"
			git config --global user.email "seuemail@host.com"
		- Caso contrário:
			- Faça o download do setup assistente em https://sourceforge.net/projects/git-osx-installer/files/;
			- Execute o setup;
			- Confira se a instalação foi bem sucedida executando novamente o comando "git --version";
			- Configure nome e email através dos comandos:
				git config --global user.name "Seu nome"
				git config --global user.email "seuemail@host.com"

		## Linux (Debian/Ubuntu)
			- Abra o terminal e execute os comandos:
				Sudo apt-get update 
				Sudo apt-get install git
			- Confira se a instalação foi bem sucedida executando novamente o comando "git --version";
			- Configure nome e email através dos comandos:
				git config --global user.name "Seu nome"
				git config --global user.email "seuemail@host.com"

		## Linux (Fedora)
			- Abra o terminal e execute um dos comandos abaixo:
				Sudo dnf install git 
				Sudo yum install git
			- Confira se a instalação foi bem sucedida executando novamente o comando "git --version";
			- Configure nome e email através dos comandos:
				git config --global user.name "Seu nome"
				git config --global user.email "seuemail@host.com"

4º passo: Instale o XAMPP (apenas para acesso local, caso acesse de um servidor, pode pular essa etapa):
	- Acesse o link abaixo e faça o download:
		https://www.apachefriends.org/pt_br/download.html
	- Execute o setup e termine a instalação.
	- Abra o xampp-control.exe e clique em "Start" nas opções "Apache" e "MySQL".

5º passo: Clone o projeto do repositório GitHub:
	- Crie uma pasta em um servidor ou localmente na pasta htdocs do XAMPP chamada "livraria";
	- Entre nessa pasta e clique com o botão direito;
		- Selecione a opção "Git Bash Here"
	- Execute o comando git clone https://github.com/ricoroma-coder/livraria

6º passo: Crie um banco de dados chamado "livraria":
	- Para acesso local:
		- Abra o navegador e digite na barra de endereço "localhost/phpmyadmin"
		- Clique em "Novo" no canto esquerdo da tela;
		- No campo "Nome da base de dados" digite "livraria";
		- Clique em "Criar";
	- Para acesso remoto:
		- Contacte sua empresa de hospedagem e solicite a criação de uma nova base de dados chamada "livraria".

7º passo: Modifique o arquivo .env do projeto:
	- Entre no diretório do projeto e abra o arquivo .env;
	- Modifique os seguintes campos do arquivo:
		# Acesso local:
			DB_CONNECTION=mysql
			DB_HOST=127.0.0.1
			DB_PORT=3306
			DB_DATABASE=livraria
			DB_USERNAME=root
			DB_PASSWORD=
		# Acesso remoto
			DB_CONNECTION={tipo de conexão}
			DB_HOST={host do servidor}
			DB_PORT={porta do host}
			DB_DATABASE=livraria
			DB_USERNAME={seu usuário}
			DB_PASSWORD={sua senha}

8º passo: Importe o banco de dados do projeto:
	- Abra o terminal de comando na pasta do projeto "livraria"
	- Execute o comando abaixo:
		php artisan migrate
	- Feito!

9º passo: Acesse seu projeto através de um navegador:
	# Acesso local com XAMPP:
		localhost/livraria
	# Acesso remoto:
		seudominio.com/livraria


-- Para codificação

=> Plataforma e Extensões
	- O projeto foi codificado utilizando Visual Studio Code com extenções:
		DotENV v1.0.1
		Laravel 5 Snippets v2.0.1
		Laravel Blade Snippets v1.22.1
		PHP IntelliSense v2.3.14

=> Git
	- Crie um repositório no GitHub sem o arquivo .gitignore
	- Entre na pasta do projeto e clique com o botão direito:
		Selecione "Git Bash Here"
	- Execute os seguintes comandos:
		git init
		git remote add origin https://github.com/{seu usuário}/{seu repositório}
		git add .
		git commit -m "{Descrição do commit}"
		git push -u origin master
	- Para os próximos commits, basta executar os comandos:
		git add .
		git commit -m "{Descrição do commit}"
		git push