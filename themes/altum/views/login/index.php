<?php defined('ALTUMCODE') || die() ?>

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<div class="container">

    <div class="d-flex flex-column align-items-center">
        <div class="col-xs-12 col-md-12 col-lg-10">
            <?= \Altum\Alerts::output_alerts() ?>

            <div class="card border-0 flex-row">
                <div class="card-body shadow-md p-5">

                    <h4 class="card-title"><?= language()->login->header ?></h4>

                    <form action="" method="post" class="mt-4" role="form">
                        <div class="form-group">
                            <label for="email"><?= language()->login->form->email ?></label>
                            <input id="email" type="text" name="email" class="form-control form-control-lg <?= \Altum\Alerts::has_field_errors('email') ? 'is-invalid' : null ?>" placeholder="<?= language()->login->form->email_placeholder ?>" value="<?= $data->values['email'] ?>" required="required" autofocus="autofocus" />
                            <?= \Altum\Alerts::output_field_error('email') ?>
                        </div>

                        <div class="form-group">
                            <label for="password"><?= language()->login->form->password ?></label>
                            <input id="password" type="password" name="password" class="form-control form-control-lg <?= \Altum\Alerts::has_field_errors('password') ? 'is-invalid' : null ?>" placeholder="<?= language()->login->form->password_placeholder ?>" value="<?= $data->user ? $data->values['password'] : null ?>" required="required" />
                            <?= \Altum\Alerts::output_field_error('password') ?>
                        </div>

                        <?php if($data->user && $data->user->twofa_secret && $data->user->active): ?>
                            <div class="form-group">
                                <label for="twofa_token"><?= language()->login->form->twofa_token ?></label>
                                <input id="twofa_token" type="text" name="twofa_token" class="form-control form-control-lg <?= \Altum\Alerts::has_field_errors('twofa_token') ? 'is-invalid' : null ?>" placeholder="<?= language()->login->form->twofa_token_placeholder ?>" required="required" autocomplete="off" />
                                <?= \Altum\Alerts::output_field_error('twofa_token') ?>
                            </div>
                        <?php endif ?>

                        <?php if(settings()->captcha->login_is_enabled): ?>
                        <div class="form-group">
                            <?php $data->captcha->display() ?>
                        </div>
                        <?php endif ?>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="rememberme" class="custom-control-input" id="rememberme">
                            <label class="custom-control-label" for="rememberme"><small class="text-muted"><?= language()->login->form->remember_me ?></small></label>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" name="submit" class="btn btn-primary btn-block my-1"><?= language()->login->form->login ?></button>
                        </div>

                        <?php if(settings()->facebook->is_enabled): ?>
                            <div class="d-flex align-items-center my-3">
                                <div class="line bg-gray-300"></div>
                                <div class="mx-3"><small class=""><?= language()->login->form->or ?></small></div>
                                <div class="line bg-gray-300"></div>
                            </div>

                            <div class="row">
                                <div class="col-sm mt-1">
                                    <a href="<?= $data->facebook_login_url ?>" class="btn btn-light btn-block text-gray-600"><?= sprintf(language()->login->display->facebook, "<i class=\"fab fa-fw fa-facebook\"></i>") ?></a>
                                </div>
                            </div>
                        <?php endif ?>

                        <div class="mt-4 text-center">
                            <small><a href="lost-password" class="text-muted"><?= language()->login->display->lost_password ?></a> / <a href="resend-activation" class="text-muted" role="button"><?= language()->login->display->resend_activation ?></a></small>
                        </div>
                    </form>
                </div>

                <div class="card-image card-image-login shadow-md p-5">
                    <p class="h1 text-white mb-3"><?= nr($data->total_track_notifications) ?>+</p>
                    <p class="h4 text-gray-200"><?= language()->login->display->total_track_notifications ?></p>
                </div>
            </div>

            <?php if(settings()->register_is_enabled): ?>
                <div class="text-center mt-4">
                    <?= sprintf(language()->login->display->register, '<a href="' . url('register') . '" class="font-weight-bold">' . language()->login->display->register_help . '</a>') ?></a>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>