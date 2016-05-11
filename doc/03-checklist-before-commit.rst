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

MVC
---

#. All controllers should be services with ``parent:`` and ``lazy: true`` properties
#. Configure routing via annotantions with ``@Mvc\Route`` annotation from `SensioFrameworkExtraBundle Routing annotations`_

.. _SensioFrameworkExtraBundle Routing annotations: http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/routing.html#route-name
.. _phpmd annotations: http://phpmd.org/documentation/suppress-warnings.html
.. _rules: http://phpmd.org/rules/index.html
