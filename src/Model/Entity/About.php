<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * About Entity
 *
 * @property int $id
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $instgram
 * @property string|null $youtube
 * @property string|null $andriod
 * @property string|null $ios
 * @property string|null $about_en
 * @property string|null $about_ar
 * @property string|null $about_footer_en
 * @property string|null $about_footer_ar
 */
class About extends Entity
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
        'facebook' => true,
        'twitter' => true,
        'instgram' => true,
        'youtube' => true,
        'andriod' => true,
        'ios' => true,
        'about_en' => true,
        'about_ar' => true,
        'about_footer_en' => true,
        'about_footer_ar' => true,
    ];
}
