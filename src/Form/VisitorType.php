<?php

namespace App\Form;

use App\Entity\Visitor;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class VisitorType
 * @package App\Form
 */
class VisitorType extends RegisterType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visitor::class,
        ]);
    }
}
