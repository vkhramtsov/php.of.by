Installation on Dev server
==========================

Installation on Debian 8
------------------------

Install sudo, in case in required
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Install sudo by issuing command ``apt-get install -y sudo``.
Log in as root. Create account for performing administrative tasks.
Allow new user to perform all commands as root without password:

  ::

    echo "<username> ALL=(ALL) NOPASSWD:ALL" | tee -a /etc/sudoers.d/<username> > /dev/null

``<username>`` stands for login name of new user.


Log in as newly created user

Install common packages
~~~~~~~~~~~~~~~~~~~~~~~
``sudo apt-get install -y git openjdk-7-jre bash-completion mc python-docutils``


Install web server
~~~~~~~~~~~~~~~~~~
``sudo apt-get install -y apache2-mpm-prefork && /usr/sbin/a2enmod rewrite``


Install PHP 5.6
~~~~~~~~~~~~~~~
Install php 5.6 using command ``sudo apt-get install -y php5 php5-cli php5-intl php5-xdebug``. Create and enable ``common.ini``:

  ::

    echo "; priority=99" | sudo tee /etc/php5/mods-available/common.ini > /dev/null
    echo "date.timezone=UTC" | sudo tee -a /etc/php5/mods-available/common.ini > /dev/null
    echo "short_open_tag=0" | sudo tee -a /etc/php5/mods-available/common.ini > /dev/null
    echo "xdebug.max_nesting_level=250" | sudo tee -a /etc/php5/mods-available/xdebug.ini > /dev/null
    echo "xdebug.var_display_max_depth=5" | sudo tee -a /etc/php5/mods-available/xdebug.ini > /dev/null
    sudo php5enmod common

Install PHP 7.0
~~~~~~~~~~~~~~~
Enable http://dotdeb.org repository:

  ::

    wget https://www.dotdeb.org/dotdeb.gpg && sudo apt-key add dotdeb.gpg
    echo "deb http://packages.dotdeb.org jessie all" | sudo tee -a /etc/apt/sources.list > /dev/null
    echo "deb-src http://packages.dotdeb.org jessie all" | sudo tee -a /etc/apt/sources.list > /dev/null
    sudo apt-get update

Install php 7.0 using command ``sudo apt-get install -y php7.0 php7.0-cli php7.0-intl php7.0-xdebug`` . Create and enable ``common.ini``:

  ::

    echo "; priority=99" | sudo tee /etc/php/7.0/mods-available/common.ini > /dev/null
    echo "short_open_tag=0" | sudo tee -a /etc/php/7.0/mods-available/common.ini > /dev/null
    echo "xdebug.max_nesting_level=250" | sudo tee -a /etc/php/7.0/mods-available/xdebug.ini > /dev/null
    echo "xdebug.var_display_max_depth=5" | sudo tee -a /etc/php/7.0/mods-available/xdebug.ini > /dev/null
    sudo phpenmod common


Samba
~~~~~
Install samba using command ``sudo apt-get install -y samba libpam-smbpass``.
Edit samba config ``sudo mcedit /etc/samba/smb.conf``

  ::

    [global]
    workgroup = PHPOFBY
    security = user
    unix password sync = yes
    [homes]
    comment = Home Directories
    valid users = @www-data
    force group = www-data
    read only = No
    create mask = 0644
    force create mode = 0644
    directory mask = 0775
    force directory mode = 0775
    directory security mask = 0775
    force directory security mode = 0775
    nt acl support = No
    map archive = No
    browseable = No

``sudo service smbd restart``


Sudo for developer account
~~~~~~~~~~~~~~~~~~~~~~~~~~

  ::

    echo "User_Alias DEVELOPERS = %www-data" | sudo tee -a /etc/sudoers.d/developers > /dev/null
    echo "Cmnd_Alias SERVICE_CMDS = /usr/sbin/service, /usr/sbin/a2ensite, /usr/bin/tail, /bin/cat" | sudo tee -a /etc/sudoers.d/developers > /dev/null
    echo "DEVELOPERS ALL=NOPASSWD: SERVICE_CMDS" | sudo tee -a /etc/sudoers.d/developers > /dev/null


Developers accounts
~~~~~~~~~~~~~~~~~~~

  ::

    USERNAME=<username>
    sudo adduser --ingroup www-data $USERNAME
    sudo smbpasswd -a $USERNAME
    sudo smbpasswd -e $USERNAME
    sudo service smbd restart
    sudo ln -s /home/$USERNAME/www/phpofby/phpofby.apache /etc/apache2/sites-available/phpofby_$USERNAME.conf
    sudo sudo a2ensite phpofby_$USERNAME
    sudo service apache2 restart

