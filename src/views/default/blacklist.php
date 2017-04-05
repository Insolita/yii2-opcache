<?php
/**
 * @var \yii\web\View                                   $this
 * @var \insolita\opcache\controllers\DefaultController $context
 * @var string                                          $version
 * @var array $blackList
 * @var string $blackFile
 **/
?>
<div class="panel panel-info">
    <div class="panel-heading">
        <div class="panel-title"><?= $version ?></div>
    </div>
    <div class="panel-body">
        <?=$this->render('_menu')?>
        <?php if(empty($blackList)):?>
            <?=\insolita\opcache\utils\Translator::t('black_list_notice')?>
        <?php else:?>
            <table class="table table-condensed table-stripped">
	            <caption>
		            <b><?=\insolita\opcache\utils\Translator::t('black_list_file')?> <?=$blackFile?></b>
	            </caption>
	            <tr><th>    <?=\insolita\opcache\utils\Translator::t('black_list_ignors')?></th></tr>
                <?php foreach ($blackList  as $file):?>
                    <tr>
                        <td> <?=$file?></td>
                    </tr>
                <?php endforeach;?>
            </table>
        <?php endif;?>
    </div>
</div>

