<?php
namespace N9Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, array(
                'required'  => true,
                'attr' => array(
                    'placeholder'   => 'Votre nom',
                    'pattern'       => '.{2,}',
                    'class'         => 'validate',
                    'aria-required' =>  'true'
                ),
                'label'         => 'Nom',
                'label_attr'    => array('data-error'=> "Votre nom n'est pas valide"),
                'constraints'   => array(
                    new NotBlank(array("message" => "Merci de saisir votre nom")),
                    new Length(array('min' => 2))
                )
            ))
            ->add('firstname', TextType::class, array(
                'attr' => array(
                    'placeholder'   => 'Votre prénom',
                    'pattern'       => '.{2,}',
                    'class'         => 'validate',
                ),
                'label'         => 'Prénom',
                'label_attr'    => array('data-error'=> "Votre prénom n'est pas valide"),
                'constraints'   => array(
                    new NotBlank(array("message" => "Merci de saisir votre prénom")),
                    new Length(array('min' => 2))
                )
            ))
            ->add('email', EmailType::class, array(
                'attr' => array(
                    'placeholder'   => 'Votre email',
                    'class'         => 'validate',
                ),
                'label'         => 'Email',
                'label_attr'    => array('data-error'=> "Votre adresse email n'est pas valide"),
                'constraints'   => array(
                    new NotBlank(array("message" => "Merci de saisir votre adresse email")),
                    new Email(array("message" => "L'adresse email que vous avez saisie n'est pas valide")),
                )
            ))
            ->add('subject', TextType::class, array(
                'attr' => array(
                    'placeholder'   => 'Sujet de votre message',
                    'pattern'       => '.{3,}',
                    'class'         => 'validate',
                ),
                'label'         => 'Sujet',
                'label_attr'    => array('data-error'=> "Merci de saisir un sujet pour votre message"),
                'constraints'   => array(
                    new NotBlank(array("message" => "Merci de saisir un sujet")),
                    new Length(array('min' => 3))
                )
            ))
            ->add('message', TextareaType::class, array(
                'attr' => array(
                    'placeholder'   => 'Votre message ici',
                    'minlength'     => '10',
                    'class'         => 'materialize-textarea validate',
                ),
                'label'         => 'Message',
                'label_attr'    => array('data-error'=> "Merci de saisir votre message"),
                'constraints'   => array(
                    new NotBlank(array("message" => "Merci de saisir un message")),
                    new Length(array('min' => 5))
                )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true
        ));
    }

    public function getName()
    {
        return 'contact_form';
    }
}