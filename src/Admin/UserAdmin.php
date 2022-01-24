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
use Sonata\UserBundle\Form\Type\SecurityRolesType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class UserAdmin extends BaseUserAdmin
{

    const FILE_MAX_SIZE = 4 * 1024 * 1024; // 4 megas

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('username')
            ->add('email')
            ->add('groups')
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
        $fileOptions = array(
            'label' => 'Archivo',
            'required' => true,
            'vich_file_object' => 'downloadfile',
            'vich_file_property' => 'downloadFile',
            'vich_allow_delete' => true,
            'attr' => array(
                'data-max-size' => self::FILE_MAX_SIZE,
                'data-max-size-error' => 'El tamaño del archivo no puede ser mayor de 4 megas'
            )
        );

        // define group zoning
        $form
            ->tab('User')
                ->with('Profile', ['class' => 'col-md-6'])->end()
                ->with('General', ['class' => 'col-md-6'])->end()
                ->with('Dirección', ['class' => 'col-md-6'])->end()
                #->with('Social', ['class' => 'col-md-6'])->end()
            ->end()
            ->tab('Laboral')
                ->with('General', ['class' => 'col-md-12'])->end()
            ->end()
            ->tab('Security')
                ->with('Status', ['class' => 'col-md-4'])->end()
                ->with('Groups', ['class' => 'col-md-4'])->end()
                ->with('Keys', ['class' => 'col-md-4'])->end()
                ->with('Roles', ['class' => 'col-md-12'])->end()
            ->end();

        $now = new \DateTime();

        $genderOptions = [
            'choices' => \call_user_func([$this->getUserManager()->getClass(), 'getGenderList']),
            'required' => true,
            'translation_domain' => $this->getTranslationDomain(),
        ];

        $form
            ->tab('User')
                ->with('General')
                    ->add('fotografia', null, ['required' => false,'label' => 'Fotografía'])
                    ->add('username')
                    ->add('email')
                    ->add('plainPassword', TextType::class, [
                        'required' => (!$this->getSubject() || null === $this->getSubject()->getId()),
                    ])
                ->end()
                ->with('Profile')
                    ->add('firstname', null, ['required' => false])
                    ->add('lastname', null, ['required' => false,'label' => 'Apellido Paterno'])
                    ->add('lastname_2', null, ['required' => false,'label' => 'Apellido Materno'])
                    /*->add('website', UrlType::class, ['required' => false])
                    ->add('biography', TextType::class, ['required' => false])
                    ->add('gender', ChoiceType::class, $genderOptions)
                    ->add('locale', LocaleType::class, ['required' => false])
                    ->add('timezone', TimezoneType::class, ['required' => false])*/
                    ->add('dateOfBirth', DatePickerType::class, [
                        'years' => range(1900, $now->format('Y')),
                        'dp_min_date' => '1-1-1900',
                        'dp_max_date' => $now->format('c'),
                        'required' => false,
                    ])
                    ->add('tipoSangre', null, ['required' => false,'label' => 'Tipo de Sangre'])
                    ->add('estadoCivil', null, ['required' => false,'label' => 'Estado Civil'])
                    ->add('anotacionesMedicas', null, ['required' => false,'label' => 'Anotaciones Médicas'])
                    ->add('celular', null, ['required' => false,'label' => 'Celular'])
                    ->add('phone', null, ['required' => false,'label' => 'Teléfono de Casa'])
                    ->add('rfc', null, ['required' => false,'label' => 'RFC'])
                    ->add('curp', null, ['required' => false,'label' => 'CURP'])
                    ->add('comprobanteDomicilio', null, ['required' => false,'label' => 'Comprobante de domicilio (PDF)','mapped' => false])
                    ->add('contacto1', null, ['required' => false,'label' => 'Nombre de Contacto 1'])
                    ->add('celContacto1', null, ['required' => false,'label' => 'Celular de Contacto 1'])
                    ->add('contacto2', null, ['required' => false,'label' => 'Nombre de Contacto 2'])
                    ->add('celContacto2', null, ['required' => false,'label' => 'Celular de Contacto 2'])
                ->end()
                ->with('Dirección')
                    ->add('georeferencia', null, ['required' => false,'label' => 'Georeferencia (ej. 41.40338; 2.17403)'])
                    ->add('calle', null, ['required' => false,'label' => 'Calle'])
                    ->add('numInterior', null, ['required' => false,'label' => 'Número Interior'])
                    ->add('numExterior', null, ['required' => false,'label' => 'Número Exterior'])
                    ->add('colonia', null, ['required' => false,'label' => 'Colonia'])
                    ->add('municipio', null, ['required' => false,'label' => 'Municipio'])
                    ->add('cp', null, ['required' => false,'label' => 'Código Postal'])
                    ->add('estado', null, ['required' => false,'label' => 'Estado'])
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
            ->tab('Laboral')
                ->with('General')
                    ->add('fechaIngreso', null, ['required' => false,'label' => 'Fecha de Ingreso'])
                    ->add('numImss', null, ['required' => false,'label' => 'Número de Seguridad Social'])
                    ->add('puesto', null, ['required' => false,'label' => 'Puesto'])
                ->end()
            ->end()
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

    protected function configureExportFields(): array
    {
        // Avoid sensitive properties to be exported.
        return array_filter(parent::configureExportFields(), static function (string $v): bool {
            return !\in_array($v, ['password', 'salt'], true);
        });
    }


}