<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between mb-4">
    <div class="d-flex align-items-center">
        <h1 class="h3 mr-3"><i class="fa fa-fw fa-xs fa-box-open text-primary-900 mr-2"></i> <?= sprintf(language()->admin_plan_update->header, $data->plan->name) ?></h1>

        <?= include_view(THEME_PATH . 'views/admin/plans/admin_plan_dropdown_button.php', ['id' => $data->plan->plan_id]) ?>
    </div>
</div>

<?= \Altum\Alerts::output_alerts() ?>

<div class="card">
    <div class="card-body">

        <form action="" method="post" role="form">
            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />
            <input type="hidden" name="type" value="update" />

            <div class="row">
                <div class="col-12 col-md-4">
                    <h2 class="h4"><?= language()->admin_plans->main->header ?></h2>
                    <p class="text-muted"><?= language()->admin_plans->main->subheader ?></p>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="name"><?= language()->admin_plans->main->name ?></label>
                        <input type="text" id="name" name="name" class="form-control form-control-lg" value="<?= $data->plan->name ?>" />
                    </div>

                    <div class="form-group">
                        <label for="status"><?= language()->admin_plans->main->status ?></label>
                        <select id="status" name="status" class="form-control form-control-lg">
                            <option value="1" <?= $data->plan->status == 1 ? 'selected="selected"' : null ?>><?= language()->global->active ?></option>
                            <option value="0" <?= $data->plan->status == 0 ? 'selected="selected"' : null ?>><?= language()->global->disabled ?></option>
                            <option value="2" <?= $data->plan->status == 2 ? 'selected="selected"' : null ?>><?= language()->global->hidden ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="order"><?= language()->admin_plans->main->order ?></label>
                        <input type="number" min="0" id="order" name="order" class="form-control form-control-lg" value="<?= $data->plan->order ?>" />
                    </div>

                    <?php if($data->plan_id == 'trial'): ?>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="days"><?= language()->admin_plans->main->trial->days ?></label>
                                <input type="text" id="days" name="days" class="form-control form-control-lg" value="<?= $data->plan->days ?>" />
                                <div><small class="form-text text-muted"><?= language()->admin_plans->main->trial->days_help ?></small></div>
                            </div>
                        </div>
                    <?php endif ?>

                    <?php if(is_numeric($data->plan_id)): ?>
                        <div class="row">
                            <div class="col-sm-12 col-xl-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="monthly_price"><?= language()->admin_plans->main->monthly_price ?> <small class="form-text text-muted"><?= settings()->payment->currency ?></small></label>
                                        <input type="text" id="monthly_price" name="monthly_price" class="form-control form-control-lg" value="<?= $data->plan->monthly_price ?>" />
                                        <small class="form-text text-muted"><?= sprintf(language()->admin_plans->main->price_help, language()->admin_plans->main->monthly_price) ?></small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-4">
                                <div class="form-group">
                                    <label for="annual_price"><?= language()->admin_plans->main->annual_price ?> <small class="form-text text-muted"><?= settings()->payment->currency ?></small></label>
                                    <input type="text" id="annual_price" name="annual_price" class="form-control form-control-lg" value="<?= $data->plan->annual_price ?>" />
                                    <small class="form-text text-muted"><?= sprintf(language()->admin_plans->main->price_help, language()->admin_plans->main->annual_price) ?></small>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-4">
                                <div class="form-group">
                                    <label for="lifetime_price"><?= language()->admin_plans->main->lifetime_price ?> <small class="form-text text-muted"><?= settings()->payment->currency ?></small></label>
                                    <input type="text" id="lifetime_price" name="lifetime_price" class="form-control form-control-lg" value="<?= $data->plan->lifetime_price ?>" />
                                    <small class="form-text text-muted"><?= sprintf(language()->admin_plans->main->price_help, language()->admin_plans->main->lifetime_price) ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <span><?= language()->admin_plans->main->taxes_ids ?></span>
                            <div><small class="form-text text-muted"><?= sprintf(language()->admin_plans->main->taxes_ids_help, '<a href="' . url('admin/taxes') .'">', '</a>') ?></small></div>
                        </div>

                        <?php if($data->taxes): ?>
                            <div class="row">
                                <?php foreach($data->taxes as $row): ?>
                                    <div class="col-12 col-xl-6">
                                        <div class="custom-control custom-switch my-3">
                                            <input id="<?= 'tax_id_' . $row->tax_id ?>" name="taxes_ids[<?= $row->tax_id ?>]" type="checkbox" class="custom-control-input" <?= in_array($row->tax_id, $data->plan->taxes_ids) ? 'checked="checked"' : null ?>>
                                            <label class="custom-control-label" for="<?= 'tax_id_' . $row->tax_id ?>"><?= $row->internal_name ?></label>
                                            <div><span><small><?= $row->name ?></small> - <small class="text-muted"><?= $row->description ?></small></span></div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>

                    <?php endif ?>

                </div>
            </div>

            <div class="mt-5"></div>

            <div class="row">
                <div class="col-12 col-md-4">
                    <h2 class="h4"><?= language()->admin_plans->plan->header ?></h2>
                    <p class="text-muted"><?= language()->admin_plans->plan->subheader ?></p>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="campaigns_limit"><?= language()->admin_plans->plan->campaigns_limit ?></label>
                        <input type="number" id="campaigns_limit" name="campaigns_limit" min="-1" class="form-control form-control-lg" value="<?= $data->plan->settings->campaigns_limit ?>" />
                        <small class="form-text text-muted"><?= language()->admin_plans->plan->campaigns_limit_help ?></small>
                    </div>

                    <div class="form-group">
                        <label for="notifications_limit"><?= language()->admin_plans->plan->notifications_limit ?></label>
                        <input type="number" id="notifications_limit" name="notifications_limit" min="-1" class="form-control form-control-lg" value="<?= $data->plan->settings->notifications_limit ?>" />
                        <small class="form-text text-muted"><?= language()->admin_plans->plan->notifications_limit_help ?></small>
                    </div>

                    <div class="form-group">
                        <label for="notifications_impressions_limit"><?= language()->admin_plans->plan->notifications_impressions_limit ?> <small class="form-text text-muted"><?= language()->admin_plans->plan->per_month ?></small></label>
                        <input type="number" id="notifications_impressions_limit" name="notifications_impressions_limit" min="-1" class="form-control form-control-lg" value="<?= $data->plan->settings->notifications_impressions_limit ?>" />
                        <small class="form-text text-muted"><?= language()->admin_plans->plan->notifications_impressions_limit_help ?></small>
                    </div>

                    <div class="custom-control custom-switch mb-3">
                        <input id="no_ads" name="no_ads" type="checkbox" class="custom-control-input" <?= $data->plan->settings->no_ads ? 'checked="checked"' : null ?>>
                        <label class="custom-control-label" for="no_ads"><?= language()->admin_plans->plan->no_ads ?></label>
                        <div><small class="form-text text-muted"><?= language()->admin_plans->plan->no_ads_help ?></small></div>
                    </div>

                    <div class="custom-control custom-switch mb-3">
                        <input id="removable_branding" name="removable_branding" type="checkbox" class="custom-control-input" <?= $data->plan->settings->removable_branding ? 'checked="checked"' : null ?>>
                        <label class="custom-control-label" for="removable_branding"><?= language()->admin_plans->plan->removable_branding ?></label>
                        <div><small class="form-text text-muted"><?= language()->admin_plans->plan->removable_branding_help ?></small></div>
                    </div>

                    <div class="custom-control custom-switch mb-3">
                        <input id="custom_branding" name="custom_branding" type="checkbox" class="custom-control-input" <?= $data->plan->settings->custom_branding ? 'checked="checked"' : null ?>>
                        <label class="custom-control-label" for="custom_branding"><?= language()->admin_plans->plan->custom_branding ?></label>
                        <div><small class="form-text text-muted"><?= language()->admin_plans->plan->custom_branding_help ?></small></div>
                    </div>

                    <div class="custom-control custom-switch mb-3">
                        <input id="api_is_enabled" name="api_is_enabled" type="checkbox" class="custom-control-input" <?= $data->plan->settings->api_is_enabled ? 'checked="checked"' : null ?>>
                        <label class="custom-control-label" for="api_is_enabled"><?= language()->admin_plans->plan->api_is_enabled ?></label>
                        <div><small class="form-text text-muted"><?= language()->admin_plans->plan->api_is_enabled_help ?></small></div>
                    </div>

                    <h3 class="h5 mt-4"><?= language()->admin_plans->plan->enabled_notifications ?></h3>
                    <p class="text-muted"><?= language()->admin_plans->plan->enabled_notifications_help ?></p>

                    <div class="row">
                        <?php foreach(\Altum\Notification::get_config() as $notification_type => $notification_config): ?>
                            <div class="col-6 mb-3">
                                <div class="custom-control custom-switch">
                                    <input id="enabled_notifications_<?= $notification_type ?>" name="enabled_notifications[]" value="<?= $notification_type ?>" type="checkbox" class="custom-control-input" <?= $data->plan->settings->enabled_notifications->{$notification_type} ? 'checked="checked"' : null ?>>
                                    <label class="custom-control-label" for="enabled_notifications_<?= $notification_type ?>"><?= language()->notification->{mb_strtolower($notification_type)}->name ?></label>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-4"></div>

                <div class="col">
                    <button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= language()->global->update ?></button>
                    <button type="submit" name="submit_update_users_plan_settings" class="btn btn-lg btn-block btn-outline-primary mt-2"><?= language()->admin_plan_update->update_users_plan_settings->button ?></button>
                </div>
            </div>
        </form>

    </div>
</div>
