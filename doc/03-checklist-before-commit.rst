Checklist before commit
=======================

General
-------

#. Ensure that all files has unix line separators (``LF``)
#. Ensure new line at the end of files
#. Ensure UTF-8 encoding without BOM
#. Verify that there are no new inspection warnings in IDE (if IDE supports it)
#. Run ``php phing.phar`` before committing. If build successfully passed all targets before ``dependencies-list-updates``
   and ``dependencies-security-check`` then functionality could be send for code review.
#. Be sure to revert ``web/config.php``, ``bin/symfony_requirements``
#. Check inspections in IDE (undefined variables etc.)
#. Check file permissions (permissions must be ``0644``)
#. Check if your git credentials for the current repo are correct: ``git config user.name && git config user.email``
#. Always add comma after the last item of multi-line array
#. Do not add comma after last array element
#. Verify ``phpmd`` output and add ``@SuppressWarnings`` `phpmd annotations`_ for specific rules_
#. Don't use leading slashes before function names from global namespace

OOP
---

#. All properties should be ``private``
#. Use phpDoc for Type hinting of the result
#. Use inline phpDoc annotations (``/** @var $variableName VariableClassOrInterface */``) or ``instanceof`` depending on situation
   to clarify variable type. Don't call methods that aren't present in the annotated type.

Doctrine
--------

#. Omit table and column names. Let Doctrine generate them automatically,
#. Use ``$<entityName>Id`` as fields name for ID
#. Verify typehinting in setters
#. Verify `Fluent interface`_ in setters
#. All properties should be ``private``
#. Initialize ``ArrayCollection`` in constructor for relations
#. Initialize all required (not nullable) non-scalar properties in constructor (e.g. ``DateTime``)
#. Initialize all required (not nullable) scalar properties during definition (``private $height = 0;``)
#. Use all necessary `Doctrine Annotations`_ and restrictions:
    - length, nullable, unique for ``@Column``
    - indexes, unique constraints for ``@Entity``
    - Don't provide field names. Let Doctrine generate them
    - unique, nullable, onDelete for ``@JoinColumn``
    - orphanRemoval, indexBy for ``@OneToMany``
    - use cascade in relations only if necessary
    - add all required relations to constructor as arguments
    - don't use nullable in case of inheritance
#. Always use ``@Version`` for optimistic locking
#. Always use ``\Gedmo\Timestampable\Traits\TimestampableEntity`` to save dates of creation and last modification
#. Use ``@OrderBy`` for default order of related entites only if necessary
#. Use ``is<PropertyName>`` as name for getter methods if property is ``boolean``
#. Update migrations with ``app/console doctrine:migrations:diff``. Don't use ``app/console doctrine:schema:update``.
#. Verify migrations for both up and down directions with ``app/console doctrine:migrations:migrate <migrationId>``
#. Verify sync of DB schema with ORM metadata after migrations with ``app/console doctrine:schema:validate``
#. Verify migrations file manually (check if all statements are correct)
#. Specify entity classes without namespace (if entities are in the same namespace) in relations
#. Don't use reserved words as table names. Specify table name manually if necessary.
#. Each pull request should contain exactly one migration

Assets (JS, CSS, images)
------------------------

#. Increment ``assets_version`` in ``app/config/config.yml`` on each change to assets

New bundle
----------

#. Add it to ``app/config/config_app_prod.yml`` to ``bundles`` section if bundle contains templates

MVC
---

#. All controllers should be services with ``parent:`` and ``lazy: true`` properties
#. Configure routing via annotations with ``@Route`` annotation from `SensioFrameworkExtraBundle Routing annotations`_

Configuration
-------------

#. Check that ``app/config/config.yml`` has ``~PROJECT_VERSION~`` token instead of real version
#. Don't forget to alter configs
    - ``app/config/parameters.yml.dist``
    - ``app/config/parameters_ci.yml``

.. _Fluent interface: http://martinfowler.com/bliki/FluentInterface.html
.. _Doctrine Annotations: http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/annotations-reference.html
.. _SensioFrameworkExtraBundle Routing annotations: http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/routing.html#route-name
.. _phpmd annotations: http://phpmd.org/documentation/suppress-warnings.html
.. _rules: http://phpmd.org/rules/index.html
