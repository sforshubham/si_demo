<div class="locations form">
<?php echo $this->Form->create('Location'); ?>
    <fieldset>
        <legend><?php echo __('Add Location'); ?></legend>
    <?php
        echo $this->Form->input('name');
        echo $this->Form->input('address');
        echo $this->Form->input('address2');
        echo $this->Form->input('location');
        echo $this->Form->input('country_id', array('empty' => 'Select', 'style' => 'width:50%'));
        echo $this->Form->input('state_id', array('empty' => 'Select', 'style' => 'width:50%'));
        echo $this->Form->input('city_id', array('empty' => 'Select', 'style' => 'width:50%'));
        echo $this->Form->input('latitude');
        echo $this->Form->input('longitude');
        echo $this->Form->input('phone_number');
        echo $this->Form->input('category_id');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Locations'), array('action' => 'index')); ?></li>
    </ul>
</div>