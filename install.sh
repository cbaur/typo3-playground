#!/usr/bin/env bash

WEB_ROOT="$HOME/httpdocs"
KEY_LENGTH=4096
GIT_USER="creationell_guest"

function print_help {
    echo -e "Usage of install\n"
    echo -e "install PARAM"
    echo -e "Params:"
    echo -e "\tautoload - Reloads classes of TYPO3"
    echo -e "\trequire - Require a new package from composer"
    echo -e "\tmakesshkey - Generate a new ssh key"
    echo -e "\tinstall - Run composer to install TYPO3"
    echo -e "\tclean - Clean up installation e.g. remove FIRST_INSTALL..."
    echo -e "\thelp - Shows this help text"
}

function install_typo3 {
    # Ensure to be in the users httpdocs directory
    echo -e "Switch to $WEB_ROOT"
    cd "$WEB_ROOT"

    echo -e "TYPO3 will be installed"
    composer install

    echo -e "Create FIRST_INSTALL file"
    touch FIRST_INSTALL

    echo -e "TYPO3 installation finished."
    echo -e "Open a browser and visit 'https://$(pwd | cut -d '/' -f5)/typo3/' to finish the installation"
}

function clean {
    if test -f "$WEB_ROOT/FIRST_INSTALL"; then
        echo -e "Remove file $WEB_ROOT/FIRST_INSTALL"
        rm "$WEB_ROOT/FIRST_INSTALL"
    fi
}

function make_sshkey {
    # Ensure to be in the users home directory
    echo -e "Switch to $HOME"
    cd $HOME

    echo -e "Generate new SSH key"
    ssh-keygen -t rsa -b "$KEY_LENGTH" -C "$GIT_USER@creationell.com"

    echo -e ""

    cat "$HOME/.ssh/id_rsa.pub"

    echo -e ""
    echo -e "Copy the above key and add it to the ssh keys on gitlab."
    echo -e "Visit https://gitlab.com and login with our $GIT_USER user"
}

function autoload {
    # Ensure to be in the users httpdocs directory
    echo -e "Switch to $WEB_ROOT"
    cd "$WEB_ROOT"

    composer dump-autoload
}

function require {
    # Ensure to be in the users httpdocs directory
    echo -e "Switch to $WEB_ROOT"
    cd "$WEB_ROOT"

    composer require $1
}

if ! test -d "$WEB_ROOT"; then echo -e "Directory $WEB_ROOT does not exist." && exit 1; fi
if test -z "$1"; then print_help && exit 1; fi

case $1 in
    "autoload")
        autoload
        ;;
    "require")
        require $2
        autoload
        ;;
    "install")
        install_typo3
        ;;
    "clean")
        clean
        ;;
    "makesshkey")
        make_sshkey
        ;;
    "help")
        print_help
        ;;
    *)
        print_help && exit 1
esac

exit 0