<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pothole Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $image
 * @property string $path
 * @property string $address
 * @property string $severity
 * @property string $comments
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Pothole extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'image' => true,
        'path' => true,
        'address' => true,
        'severity' => true,
        'comments' => true,
        'created' => true,
        'modified' => true,
        'user' => true
    ];
}
