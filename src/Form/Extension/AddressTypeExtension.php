<?php

declare(strict_types=1);

namespace App\Form\Extension;

use App\Validator\Constraints\Nip;
use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AddressTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('nip', TextType::class, [
            'required' => false,
            'label' => 'NIP',
        ]);
    }

    public static function getExtendedTypes(): iterable
    {
        return [AddressType::class];
    }
}
