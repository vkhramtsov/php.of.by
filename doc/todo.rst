Things to do
============

- Update phing when they fix issue with phpcs reports, which not stored to files
- Add tasks to build to execute tests, when they are appears
- Switch on database validation when we start using database
- Change deploy process. We should create package using build plan, not using deploy script
- Replace ``friendsofsymfony/user-bundle`` with stable version when it appears. Currently we have to use master branch, because other releases are not compatible with symfony 3.*.
- In case of adding more pages(controllers) to admin side, we need to create wrapper for ``EasyAdminBundle`` to use push dependencies into controller like in ``CommonBundle\Controller\AbstractServiceController`` instead of using ``Service Locator``
