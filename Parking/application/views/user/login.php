		<div class="single-widget-container">
            <section class="widget login-widget">
                <header class="text-align-center">
                    <h3><strong>Logowanie</strong></h3>
                </header>
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
                            <div class="form-group">
                                <label for="password">Hasło</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
									<?=form_password(array(	'name' => 'password',
															'class' => 'form-control input-lg input-transparent',
															'placeholder' => 'Podaj hasło',
															'required' => 'required',
															'size' => '40',
															'minlength' => '6',
															'maxlength' => '40'))?>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-block btn-lg btn-danger">
								<i class="fa fa-sign-in"></i>
                                <small>Zaloguj</small>
                            </button>
                            <a class="forgot" href="<?=base_url($this->router->fetch_class().'/reset')?>">
								<i class="fa fa-refresh"></i> Resetowanie hasła
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