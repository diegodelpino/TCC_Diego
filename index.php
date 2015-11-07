<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
      
        <title>Login Proposta Comercial</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
       
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
           
            <header>
                <h1>Proposta Comercial<span></br>Sistema de geração de proposta comercial</span></h1>
				
            </header>
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="./controller/AutenticaUsuario.php" method="post" autocomplete="on" > 
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Usuário </label>
                                    <input id="username" name="username" required="required" type="text" placeholder=" meu usu�rio"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Senha </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="xxxxxx" /> 
                                </p>
                             
                                <p class="login button"> 
                                    <input type="submit" value="Logar" /> 
								</p>
								
								<?php if(isset($_GET["err"])){ 
										echo '<p>Usuario ou senha invalido</p> ';
									  }
								 ?>
								
                                <p class="change_link">
									Não tem uma conta ainda?
									<a href="#toregister" class="to_register">Criar uma conta</a>
								</p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="controller/CadastrarUsuario.php" method="post" autocomplete="on" > 
                                <h1> Cadastrar-se </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Nome</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="meu nome" />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" > E-mail</label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                                </p>
								<p> 
                                    <label for="cpfsignup" class="cpf" data-icon="u" > Cpf</label>
                                    <input id="cpfsignup" name="cpfsignup" required="required" type="text" placeholder="xxxxxxxxxxx-x"/> 
                                </p>
								<p> 
                                    <label for="nascsignup" class="nasc" data-icon="u" > Data e nascimento</label>
                                    <input id="nascsignup" name="nascsignup" required="required" type="date" placeholder="xx/xx/xxxx"/> 
                                </p>
								<p> 
									<label for="sexosignup" class="sexo"  > Sexo</label>
									<select id="sexosignup" name="sexosignup" required="required">
									  <option ></option>
									  <option value="m">Masculino</option>
									  <option value="f">Feminino</option>
									</select>
                                </p>
								 <p> 
                                    <label for="loginsignup" class="login" data-icon="p">Login </label>
                                    <input id="loginsignup" name="loginsignup" required="required" type="text" placeholder="eg. Paulo"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Senha </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Confirme a senha </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>

                                <p class="signin button"> 
									<input type="submit" value="Cadastrar" /> 
								</p>
                                <p class="change_link">  
									Já possui uma conta
									<a href="#tologin" class="to_register"> Acessar o sistema </a>
								</p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>