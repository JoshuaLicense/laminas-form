<?php

namespace LaminasTest\Form\TestAsset;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class FieldsetWithDependencyFactory implements FactoryInterface
{
    private $creationOptions = [];

    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $options = $options ?: [];

        $name = null;
        if (isset($options['name'])) {
            $name = $options['name'];
            unset($options['name']);
        }

        $form = new FieldsetWithDependency($name, $options);
        $form->setDependency(new InputFilter());

        return $form;
    }

    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, CustomCreatedForm::class, $this->creationOptions);
    }

    public function setCreationOptions(array $options)
    {
        $this->creationOptions = $options;
    }
}
