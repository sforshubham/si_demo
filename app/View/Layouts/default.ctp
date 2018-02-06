<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('cake.generic');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
    <?php echo $this->Html->script('jquery-1.9.1.min'); ?>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="input select">
                <select id="language_menu">
                    <option value="eng">English</option>
                    <option value="fra" <?php echo $this->Session->read('Config.language') == 'fra' ? 'selected' : '' ;?>>Français</option>
                </select>
            </div>
        </div>
        <div id="content">

            <?php echo $this->Session->flash(); ?>

            <?php echo $this->fetch('content'); ?>
        </div>
        <div id="footer">
            <?php echo $this->Html->link(
                    $this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
                    'http://www.cakephp.org/',
                    array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
                );
            ?>
            <p>
                <?php echo $cakeVersion; ?>
            </p>
        </div>
    </div>
    <?php echo $this->element('sql_dump'); ?>
</body>
<script>
  var _ROOT = "<?php echo $this->Html->url('/', true); ?>";
    $('#language_menu').on('change', function () {
        var lang = $('#language_menu').val();
        window.location = _ROOT + 'locations/setLanguage/' + lang;

    });

    $('#LocationCountryId').on('change', function () {
        var c_id = $('#LocationCountryId').val().trim();
        if (c_id) {
            $.ajax({
                'url': _ROOT + 'locations/getState/'+c_id,
                success: function(response) {
                    var html = '';
                    response = JSON.parse(response);
                    $.each(response, function(i, item) {
                        html += '<option value="'+i+'">'+item+'</option>';
                    });
                    $('#LocationStateId').html(html);
                }
            })
        }
        $('#LocationStateId').val('');
        $('#LocationCityId').val('');
    });

    $('#LocationStateId').on('change', function () {
        var s_id = $('#LocationStateId').val().trim();
        if (s_id) {
            $.ajax({
                'url': _ROOT + 'locations/getCity/'+s_id,
                success: function(response) {
                    var html = '';
                    response = JSON.parse(response);
                    $.each(response, function(i, item) {
                        html += '<option value="'+i+'">'+item+'</option>';
                    });
                    $('#LocationCityId').html(html);
                }
            })
        }
        $('#LocationCityId').val('');
    });
</script>
</html>
