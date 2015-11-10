                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Home</h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!$this->session->userdata('login')): ?>
                            <h3>Login form</h3>
                            Login: admin<br />
                            Password: pass<br /><br />
                            <?=form_open(base_url().'user/login')?>
                            <table class="table table-condensed table-responsive">
                                <tr>
                                    <td><?=form_label('Login', 'login').' '?></td>
                                    <td><?=form_input('login').'<br />'?></td>
                                </tr>
                                <tr>
                                    <td><?=form_label('Password', 'password')?></td>
                                    <td><?=form_password('password')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?=form_submit('submit', 'Login')?></td>
                                </tr>
                            </table>
                            <?php echo form_close(); else: ?>
                                Welcome on NANOmatic shop framework :-)
                            <?php endif ?>
                        </div>
                    </div>