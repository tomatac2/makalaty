<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Advertise Entity
 *
 * @property int $id
 * @property string|null $link
 * @property string|null $photo
 * @property string $type
 * @property int $page_num
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Advertise extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'link' => true,
        'photo' => true,
        'type' => true,
        'page_num' => true,
        'created' => true,
        'modified' => true,
    ];
}
