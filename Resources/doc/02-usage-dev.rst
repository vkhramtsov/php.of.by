Dev server usage
================
SSH
---
Connect using following credentials:

- Hostname: ``your_host``
- Username: ``<username>``

Samba
-----
Connect using following credentials:

- Folder name: ``\\your_host\<username>``
- Username: ``your_host\<username>``

Creating environment
--------------------

#. It is recommended to use git on your workstation instead of using it on dev server
#. Add SSH key to ``https://github.com/settings/keys``
#. Set domain ``user.name``, ``user.email`` and ``core.autocrlf`` for repo:
   ::

    git config --local user.name "Your Name"
    git config --local user.email "your@email"
    git config --local core.autocrlf input

#. Clone project from ``git@github.com:PHP-Belarus/php.of.by.git`` to ``~/www/phpofby``
#. Copy nginx config from ``~/www/phpofby/app/Resources/configs/nginx/phpofby_dev.nginx`` to ``~/www/phpofby/phpofby.nginx``
#. Replace ``<username>`` with your username in ``~/www/phpofby/phpofby.nginx``
#. Replace ``<sitename>`` with ``phpofby`` in ``~/www/phpofby/phpofby.nginx``
#. Execute ``sudo service nginx restart`` if nginx config is correct
#. Execute ``php phing.phar dependencies-install``
#. Set proper values in ``.env`` file.
#. Check application with ``php phing.phar``
#. Add your workstation IP to ``web/check.php``
#. Check application with ``vendor/bin/requirements-checker``, ``http://your_host/check.php`` and ``http://your_host/index.php``

Privileges
----------

#. Developers have sudo privilege for executing ``service`` application without password

