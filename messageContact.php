<?php
require_once "recaptchalib.php";
// 1 - Devido ao fato de que o usuário pode submeter um mesmo formulário diversas
//     vezes a partir da atualização da página logo após um submit qualquer, resolvemos
//     contornar a situação adicionado um hash na sessão do usuário, sendo assim,
//     ao submeter o formulário a sessão é criada e um hash dos dados submetidos
//     é adicionado a váriavel da sessão aberta, caso o usuário atualize a página,
//     é verificado o valor do hash, impedindo um novo submit caso os valores comparados
//     sejam identicos.
session_start();

function verifySubmit()
{
			if($_SERVER['REQUEST_METHOD'] === 'POST')
			{
				 $hash = md5(implode($_POST));

				if (isset($_SESSION['hash']) && $_SESSION['hash'] == $hash )
				{
					echo "<span class='message message-no-resend'>Mensagem enviada, caso queira
																												enviar nova mensagem preencha os campos abaixo novamente</span>";
				}
				else
				{
					$_SESSION['hash'] = $hash;
					if ($_SERVER['REQUEST_METHOD'] == 'POST')
					{
						$contact = new ViewMessageContact();
						$contact->sendContact($_POST);
					}
				}
			}

}
?>


<div class="box-center-content box-contact">

				<div class="msg-contact">
					<p>
						Para mais esclarecimentos, orçamento de projeto, consultoria, visita
						tecnica ou outras dúvidas, deixe seu recado preenchendo o formulário
						abaixo, ou se preferir envie um email para <a href="mailto:contato@dharnoslima.com.br" target="_top">contato@dharnoslima.com.br</a>.
					</p>
				</div>

				<div class="div-contact" >
					<?php
							if ($response != null && $response->success) {
								verifySubmit();
								echo "<p>Olá, <b>" .ucfirst($_POST["name"]). "</b>, obrigado por me contactar, retornarei a sua mensagem em breve.</p>";
							} else {
								//verifySubmit();
					 ?>
					<form  action="#send-contact" method="post" class="contact-form">
						<ul class="flex-outer">
							<li>
								<label for="name">Nome</label>
								<input type="text" id="name" name="name" placeholder="Nome" required/>
							</li>
							<li>
								<label for="email">E-mail</label>
								<input type="email" id="email" name="email" placeholder="E-mail" required/>
							</li>
							<li>
								<label for="mensagem">Mensagem</label>
								<textarea rows="6" id="text" name="text" placeholder="Mensagem" required></textarea>
							</li>
							<li>
								<input id="message" type="submit" name="enviar" value="Enviar!" />
							</li>
						</ul>
						<!-- div class="g-recaptcha" data-sitekey="6LejIhcUAAAAAMJGaFYGMF26wzhRi0oGBZyjEpX3"></div -->
						<div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
					</form>
					<?php } ?>
				</div>

			</div>
			<script src='https://www.google.com/recaptcha/api.js'></script>
