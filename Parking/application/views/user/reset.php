		<div class="single-widget-container">
            <section class="widget login-widget">
                <header class="text-align-center">
                    <h3><strong>Resetowanie hasła</strong></h3>
                </header>
				<?php if ($success): ?>
					<div class="alert alert-info alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
						</button>
						<span class="glyphicon glyphicon-exclamation-sign"></span>
						<strong>Informacja</strong>
						Wiadomość z nowym hasłem została wysłana.
					</div>
				<?php endif ?>
				<?php if (validation_errors()): ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
						</button>
						<span class="glyphicon glyphicon-exclamation-sign"></span>
						<strong>Błąd</strong>
						<?=validation_errors()?>
					</div>
				<?php endif ?>
                <div class="body">
					<?=form_open('', array('role' => 'form'))?>
						<?=form_hidden('send', time())?>
                        <fieldset>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
									<?=form_input(array('type' => 'email',
													'name' => 'email',
													'class' => 'form-control input-lg input-transparent',
													'placeholder' => 'Podaj adres e-mail',
													'required' => 'required',
													'size' => '40',
													'minlength' => '6',
													'maxlength' => '40'), set_value('email'))?>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-block btn-lg btn-danger">
								<i class="fa fa-paper-plane"></i>
                                <small>Wyślij</small>
                            </button>
                            <a class="forgot" href="<?=base_url($this->router->fetch_class())?>">
								<i class="fa fa-sign-in"></i> Logowanie
							</a>
                        </div>
					<?=form_close();?>
                </div>
                <footer>
                    <div class="facebook-login">
                        <a href="<?=base_url($this->router->fetch_class().'/add')?>"><i class="fa fa-user-plus"></i> Utwórz konto</a>
                    </div>
                </footer>
            </section>
        </div>