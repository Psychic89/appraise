<?php defined('ALTUMCODE') || die() ?>

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<div class="container">

    <div class="d-flex flex-column align-items-center">
        <div class="col-xs-12 col-md-12 col-lg-10">
            <?= \Altum\Alerts::output_alerts() ?>

            <div class="card border-0 flex-row">
                <div class="card-body shadow-md p-5">

                    <h4 class="card-title"><?= language()->register->header ?></h4>

                    <form action="" method="post" class="mt-4" role="form">
                        <div class="form-group">
                            <label for="name"><?= language()->register->form->name ?></label>
                            <input id="name" type="text" name="name" class="form-control form-control-lg <?= \Altum\Alerts::has_field_errors('name') ? 'is-invalid' : null ?>" value="<?= $data->values['name'] ?>" placeholder="<?= language()->register->form->name_placeholder ?>" required="required" autofocus="autofocus" />
                            <?= \Altum\Alerts::output_field_error('name') ?>
                        </div>

                        <div class="form-group">
                            <label for="email"><?= language()->register->form->email ?></label>
                            <input id="email" type="text" name="email" class="form-control form-control-lg <?= \Altum\Alerts::has_field_errors('email') ? 'is-invalid' : null ?>" value="<?= $data->values['email'] ?>" placeholder="<?= language()->register->form->email_placeholder ?>" required="required" />
                            <?= \Altum\Alerts::output_field_error('email') ?>
                        </div>

                        <div class="form-group">
                            <label for="password"><?= language()->register->form->password ?></label>
                            <input id="password" type="password" name="password" class="form-control form-control-lg <?= \Altum\Alerts::has_field_errors('password') ? 'is-invalid' : null ?>" value="<?= $data->values['password'] ?>" placeholder="<?= language()->register->form->password_placeholder ?>" required="required" />
                            <?= \Altum\Alerts::output_field_error('password') ?>
                        </div>

                        <?php if(settings()->captcha->register_is_enabled): ?>
                            <div class="form-group">
                                <?php $data->captcha->display() ?>
                            </div>
                        <?php endif ?>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="accept" class="custom-control-input" id="accept" required="required">
                            <label class="custom-control-label" for="accept">
                                <small class="text-muted">
                                    <?= sprintf(
                                        language()->register->form->accept,
                                        '<a href="' . settings()->terms_and_conditions_url . '" target="_blank">' . language()->global->terms_and_conditions . '</a>',
                                        '<a href="' . settings()->privacy_policy_url . '" target="_blank">' . language()->global->privacy_policy . '</a>'
                                    ) ?>
                                </small>
                            </label>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" name="submit" class="btn btn-primary btn-block"><?= language()->register->form->register ?></button>
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
                    </form>
                </div>

                <div class="card-image card-image-register shadow-md p-5">
                    <p class="h1 text-white mb-3"><?= nr($data->total_notifications) ?>+</p>
                    <p class="h4 text-gray-200"><?= language()->register->display->total_notifications ?></p>
                </div>
            </div>

            <div class="text-center mt-4">
                <small><a href="login" class="text-muted"><?= language()->register->login ?></a></small>
            </div>
        </div>
    </div>
</div>


