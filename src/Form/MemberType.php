<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MemberType
 * @package App\Form
 */
class MemberType extends RegisterType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
