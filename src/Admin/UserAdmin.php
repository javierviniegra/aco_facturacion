<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Sonata\Form\Type\CollectionType;
use Sonata\UserBundle\Form\Type\SecurityRolesType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Security\Core\Security;

class UserAdmin extends BaseUserAdmin
{

    const FILE_MAX_SIZE = 4 * 1024 * 1024; // 4 megas

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('username')
            ->add('email')
            ->add('groups')
            ->add('funcion_usuario')
            ->add('enabled', null, ['editable' => true])
            ->add('createdAt');

        if ($this->isGranted('ROLE_ALLOWED_TO_SWITCH')) {
            $list
                ->add('impersonating', 'string', ['template' => '@SonataUser/Admin/Field/impersonating.html.twig']);
        }
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('groups');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->with('General')
                ->add('username')
                ->add('email')
            ->end()
            ->with('Groups')
                ->add('groups')
            ->end()
            ->with('Profile')
                ->add('dateOfBirth')
                ->add('firstname')
                ->add('lastname')
                ->add('website')
                ->add('biography')
                ->add('gender')
                ->add('locale')
                ->add('timezone')
                ->add('phone')
            ->end()
            ->with('Social')
                ->add('facebookUid')
                ->add('facebookName')
                ->add('twitterUid')
                ->add('twitterName')
                ->add('gplusUid')
                ->add('gplusName')
            ->end()
            ->with('Security')
                ->add('token')
                ->add('twoStepVerificationCode')
            ->end();
    }

    protected function configureFormFields(FormMapper $form): void
    {

        // define group zoning
        $form
            ->tab('Personal')
                ->with('Personal', ['class' => 'col-md-6'])->end()
                ->with('Usuario', ['class' => 'col-md-6'])->end()
                #->with('Social', ['class' => 'col-md-6'])->end()
            ->end()
            ->tab('Domicilio')
                ->with('Domicilio', ['class' => 'col-md-6'])->end()
                ->with('Contacto', ['class' => 'col-md-6'])->end()
                ->with('General', ['class' => 'col-md-6'])->end()
            ->end()
            ->tab('Laboral')
                ->with('General', ['class' => 'col-md-6'])->end()
                ->with('Sueldos', ['class' => 'col-md-6'])->end()
            ->end()
            ->tab('M??dico')
                ->with('General', ['class' => 'col-md-12'])->end()
            ->end()
            ->tab('Licencia')
                ->with('General', ['class' => 'col-md-12'])->end()
            ->end();
            if($this->isGranted('ROLE_SUPER_ADMIN'))
            {
                $form
                ->tab('Security')
                    ->with('Status', ['class' => 'col-md-4'])->end()
                    ->with('Groups', ['class' => 'col-md-4'])->end()
                    ->with('Keys', ['class' => 'col-md-4'])->end()
                    ->with('Roles', ['class' => 'col-md-12'])->end()
                ->end();
            }

        $now = new \DateTime();

        $genderOptions = [
            'choices' => \call_user_func([$this->getUserManager()->getClass(), 'getGenderList']),
            'required' => true,
            'translation_domain' => $this->getTranslationDomain(),
        ];

        $form
            ->tab('Personal')
                ->with('Usuario')
                    ->add('fotografiaFile', VichImageType::class, ['required' => false,'label' => 'Fotograf??a (JPEG, GIF, PNG)'])
                    ->add('username')
                    ->add('email')
                    ->add('plainPassword', TextType::class, [
                        'required' => (!$this->getSubject() || null === $this->getSubject()->getId()),
                    ])
                ->end()
                ->with('Personal')
                    ->add('funcion_usuario', ModelType::class, ['required' => false,'label' => 'Funci??n'])
                    ->add('firstname', null, ['required' => false])
                    ->add('lastname', null, ['required' => false,'label' => 'Apellido Paterno'])
                    ->add('lastname_2', null, ['required' => false,'label' => 'Apellido Materno'])
                    /*->add('website', UrlType::class, ['required' => false])
                    ->add('biography', TextType::class, ['required' => false])
                    ->add('gender', ChoiceType::class, $genderOptions)
                    ->add('locale', LocaleType::class, ['required' => false])
                    ->add('timezone', TimezoneType::class, ['required' => false])*/
                    ->add('dateOfBirth', DateType::class, [
                        'required' => false,
                        'widget' => 'single_text',
                        /*'html5' => false,
                        'attr' => ['class' => 'js-datepicker'],*/
                    ])
                    ->add('rfc_field', null, ['required' => false,'label' => 'RFC'])
                    ->add('rfcFile', VichFileType::class, ['required' => false,'label' => 'RFC (PDF)'])
                    ->add('curp_field', null, ['required' => false,'label' => 'CURP'])
                    ->add('curpFile', VichFileType::class, ['required' => false,'label' => 'CURP (PDF)'])
                ->end()
                #->with('Social')
                #    ->add('facebookUid', null, ['required' => false])
                #    ->add('facebookName', null, ['required' => false])
                #    ->add('twitterUid', null, ['required' => false])
                #    ->add('twitterName', null, ['required' => false])
                #    ->add('gplusUid', null, ['required' => false])
                #    ->add('gplusName', null, ['required' => false])
                #->end()
            ->end()
            ->tab('Domicilio')
                ->with('Domicilio')
                    ->add('calle', null, ['required' => false,'label' => 'Calle'])
                    ->add('numInterior', null, ['required' => false,'label' => 'N??mero Interior'])
                    ->add('numExterior', null, ['required' => false,'label' => 'N??mero Exterior'])
                    ->add('colonia', null, ['required' => false,'label' => 'Colonia'])
                    ->add('municipio', null, ['required' => false,'label' => 'Municipio'])
                    ->add('cp', null, ['required' => false,'label' => 'C??digo Postal'])
                    ->add('estado', null, ['required' => false,'label' => 'Estado'])
                    ->add('georeferencia', null, ['required' => false,'label' => 'Georeferencia (ej. 41.40338; 2.17403)'])
                ->end()
                ->with('General')
                    ->add('domicilioFile', VichFileType::class, ['required' => false,'label' => 'Comprobante de domicilio (PDF)'])
                ->end()
                ->with('Contacto')
                    ->add('celular', null, ['required' => false,'label' => 'Celular'])
                    ->add('phone', null, ['required' => false,'label' => 'Tel??fono de Casa'])
                    ->add('nombreContacto1', null, ['required' => false,'label' => 'Nombre de Contacto 1'])
                    ->add('telContacto1', null, ['required' => false,'label' => 'Tel??fono de Contacto 1'])
                    ->add('nombreContacto2', null, ['required' => false,'label' => 'Nombre de Contacto 2'])
                    ->add('telContacto2', null, ['required' => false,'label' => 'Tel??fono de Contacto 2'])
                ->end()
            ->end()
            ->tab('Laboral')
                ->with('General')
                    ->add('numero_nomina', null, ['required' => false,'label' => 'N??mero de N??mina'])
                    ->add('fechaIngreso', DateType::class, [
                        'widget' => 'single_text',
                        'required' => false,
                        'label' => 'Fecha de Ingreso',
                    ])
                    ->add('numImss', null, ['required' => false,'label' => 'N??mero de Seguridad Social'])
                    ->add('puesto', null, ['required' => false,'label' => 'Puesto'])
                    ->add('estadoCivil', null, ['required' => false,'label' => 'Estado Civil'])
                ->end()
                ->with('Sueldos')
                    ->add('sueldos', CollectionType::class, [
                        'by_reference' => false,
                        'required' => false,
                        'label' => 'Sueldos'
                    ],
                    [
                        'edit' => 'inline',
                        'inline' => 'table'
                    ])
                ->end()
            ->end()
            ->tab('M??dico')
                ->with('General')
                    ->add('tipoSangre', null, ['required' => false,'label' => 'Tipo de Sangre'])
                    ->add('anotacionesMedicas', null, ['required' => false,'label' => 'Anotaciones M??dicas'])
                    ->add('contacto1', null, ['required' => false,'label' => 'Nombre de Contacto de Emergencia 1'])
                    ->add('celContacto1', null, ['required' => false,'label' => 'Celular de Contacto de Emergencia 1'])
                    ->add('contacto2', null, ['required' => false,'label' => 'Nombre de Contacto de Emergencia 2'])
                    ->add('celContacto2', null, ['required' => false,'label' => 'Celular de Contacto de Emergencia 2'])
                ->end()
            ->end()
            ->tab('Licencia')
                ->with('General')
                    ->add('licencia', null, ['required' => false,'label' => 'N??mero de Licencia'])
                    ->add('tipo_licencia', ModelType::class, [
                        'required' => true,
                        'expanded' => false,
                        'multiple' => false,
                        'label' => 'Tipo de Licencia'
                    ])
                    ->add('vigencia', null, ['required' => false,'label' => 'Vigencia'])
                ->end()
            ->end();
            if($this->isGranted('ROLE_SUPER_ADMIN'))
            {
                $form
                ->tab('Security')
                    ->with('Status')
                        ->add('enabled', null, ['required' => false])
                    ->end()
                    ->with('Groups')
                        ->add('groups', ModelType::class, [
                            'required' => false,
                            'expanded' => true,
                            'multiple' => true,
                        ])
                    ->end()
                    ->with('Roles')
                        ->add('realRoles', SecurityRolesType::class, [
                            'label' => 'form.label_roles',
                            'expanded' => true,
                            'multiple' => true,
                            'required' => false,
                        ])
                    ->end() 
                    ->with('Keys')
                        ->add('token', null, ['required' => false])
                        ->add('twoStepVerificationCode', null, ['required' => false])
                    ->end()
                ->end();
            }
    }

    protected function configureExportFields(): array
    {
        // Avoid sensitive properties to be exported.
        return array_filter(parent::configureExportFields(), static function (string $v): bool {
            return !\in_array($v, ['password', 'salt'], true);
        });
    }


}