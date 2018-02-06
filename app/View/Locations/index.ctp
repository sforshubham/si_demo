<div class="locations index">
    <h2><?php echo __('Locations'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                    <th><?php echo __('Id'); ?></th>
                    <th><?php echo __('Name'); ?></th>
                    <th><?php echo __('Location'); ?></th>
                    <th><?php echo __('Phone Number'); ?></th>
                    <th><?php echo __('Category'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($locations as $location): ?>
            <tr>
                <td><?php echo h($location['Location']['id']); ?>&nbsp;</td>
                <td><?php echo h($location['Location']['name']); ?>&nbsp;</td>
                <td><?php echo h($location['Location']['location']); ?>&nbsp;</td>
                <td><?php echo h($location['Location']['phone_number']); ?>&nbsp;</td>
                <td><?php echo h($location['Category']['name']); ?></td>
                <td class="actions">
                    <?php
                    $slug_url = $this->Html->url('/', true).$location['Location']['name'].'-'.$location['Category']['name'].'-'.$location['Location']['location'].'-'.$location['Location']['id'];
                     echo $this->Html->link(__('View'), $slug_url); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $location['Location']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $location['Location']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $location['Location']['id']))); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __('Page').' {:page} '.__('of').' {:pages}, '.__('showing').' {:current} '.__('records out of').' {:count} '.__('total, starting on record').' {:start}, '.__('ending on').' {:end}'
    ));
    ?>
    </p>
    <div class="paging">
    <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Location'), array('action' => 'add')); ?></li>
    </ul>
</div>
