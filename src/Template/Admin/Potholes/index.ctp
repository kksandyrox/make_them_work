<div class="potholes index large-9 medium-8 columns content">
    <h3><?= __('Potholes') ?></h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email', 'Email') ?></th>
                <th scope="col">User Full Name</th>
                <!-- <th scope="col"><?= $this->Paginator->sort('image') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('path') ?></th> -->
                <th scope="col"><?= $this->Paginator->sort('location', 'Google Map Location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address', 'Landmark') ?></th>
                <th scope="col"><?= $this->Paginator->sort('severity') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('comments') ?></th> -->
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php pr($potholes);?>
            <?php foreach ($potholes as $pothole): ?>
            <tr>
                <td><?= $this->Number->format($pothole->id) ?></td>
                <td><?= h($pothole->user->email) ?></td>
                <td><?= h($pothole->user->first_name) . ' ' . h($pothole->user->last_name) ?></td>
                <!-- <td><?= h($pothole->image) ?></td> -->
                <!-- <td><?= h($pothole->path) ?></td> -->
                <td><?= h($pothole->location) ?></td>
                <td><?= h($pothole->address) ?></td>
                <td><?= h($pothole->severity) ?></td>
                <!-- <td><?= h($pothole->comments) ?></td> -->
                <td><?= h($pothole->created) ?></td>
                <td><?= h($pothole->modified) ?></td>
                <td class="actions">
                    <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $pothole->id]) ?> -->
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pothole->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pothole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pothole->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
