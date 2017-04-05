<?php
use insolita\opcache\utils\Translator;

/**
 * @var \yii\web\View                                   $this
 * @var \insolita\opcache\controllers\DefaultController $context
 * @var string                                          $version
 * @var \insolita\opcache\models\OpcacheStatus          $status
 * @var \insolita\opcache\contracts\IOpcachePresenter   $presenter
 **/
$this->title = $version;
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <div class="panel-title"><?= $version ?></div>
    </div>
    <div class="panel-body">
        <?= $this->render('_menu') ?>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-condensed">
                    <tr class="info">
                        <th colspan="4"><?= Translator::t('common_status') ?></th>
                    </tr>
                    <tr>
                        <td>
                            <?= Translator::status('opcache_enabled') ?>
                            <div class="text-mute">opcache_enabled</div>
                        </td>
                        <td>
                            <?= Translator::status('cache_full') ?>
                            <div class="text-mute">cache_full</div>
                        </td>
                        <td>
                            <?= Translator::status('restart_pending') ?>
                            <div class="text-mute">restart_pending</div>
                        </td>
                        <td>
                            <?= Translator::status('restart_in_progress') ?>
                            <div class="text-mute">restart_in_progress</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= Yii::$app->formatter->asBoolean($status->getOpcacheEnabled()) ?>
                        </td>
                        <td>
                            <?= Yii::$app->formatter->asBoolean($status->getCacheFull()) ?>
                        </td>
                        <td>
                            <?= Yii::$app->formatter->asBoolean($status->getRestartPending()) ?>
                        </td>
                        <td>
                            <?= Yii::$app->formatter->asBoolean($status->getRestartInProgress()) ?>
                        </td>
                    </tr>
                    <tr class="info">
                        <th colspan="4"><?= Translator::t('memory_usage') ?></th>
                    </tr>
                    <tr>
                        <?php foreach ($status->getMemoryUsage() as $key => $value): ?>
                            <td>
                                <?= Translator::status($key) ?>
                                <div class="text-mute"><?= $key ?></div>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <?php foreach ($status->getMemoryUsage() as $key => $value): ?>
                            <td>
                                <?= $presenter->formatMemory($value, $key) ?>
                            </td>
                        
                        <?php endforeach; ?> </tr>
                    <tr class="info">
                        <th colspan="4"><?= Translator::t('interned_strings_usage') ?></th>
                    </tr>
                    <tr>
                        <?php foreach ($status->getStringsInfo() as $key => $value): ?>

                            <td>
                                <?= Translator::status($key) ?>
                                <div class="text-mute"><?= $key ?></div>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <?php foreach ($status->getStringsInfo() as $key => $value): ?>

                            <td>
                                <?= $presenter->formatMemory($value, $key) ?>
                            </td>
                        
                        <?php endforeach; ?>
                    </tr>
                </table>
                <table class="table table-bordered table-condensed">
                    <caption><b><?= Translator::t('opcache_statistics') ?></b></caption>
                    <?php foreach ($status->getStatistics() as $key => $value): ?>
                        <tr>
                            <td>
                                <?= Translator::status($key) ?>
                                <div class="text-mute"><?= $key ?></div>
                            </td>
                            <td>
                                <?= $presenter->formatStatistic($value, $key) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="col-md-6">
                <?= $this->render('_charts', ['status' => $status]) ?>
            </div>
        </div>
    </div>
</div>
