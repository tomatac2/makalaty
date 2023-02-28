<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $address_en
 * @property string|null $address_ar
 * @property string|null $short_desc_en
 * @property string|null $short_desc_ar
 * @property string|null $content_en
 * @property string|null $content_ar
 * @property string|null $type
 * @property string|null $youtube_link
 * @property string|null $photo
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Category $category
 */
class Article extends Entity
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
        'category_id' => true,
        'address_en' => true,
        'address_ar' => true,
        'short_desc_en' => true,
        'short_desc_ar' => true,
        'content_en' => true,
        'content_ar' => true,
        'type' => true,
        'youtube_link' => true,
        'photo' => true,
        'created' => true,
        'modified' => true,
        'category' => true,
        'viewers_count' => true,
    ];
}
