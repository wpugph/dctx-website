#!/bin/bash

# setup SSH access
export PATH="$PATH:$COMPOSER_HOME/vendor/bin"
echo "COMPOSER PATH:"$PATH
export PROJECT_ROOT="$(pwd)"
export GITHUB_BRANCH=${GITHUB_REF##*heads/}
printf "[\e[0;34mNOTICE\e[0m] Setting up SSH access to server for rsync usage.\n"
SSH_DIR="$HOME/.ssh"
echo "SSHDIR PATH:"$SSH_DIR

mkdir -p "$SSH_DIR"
chmod 700 "$SSH_DIR"
touch "$SSH_DIR/id_rsa1"
touch "$SSH_DIR/config"
echo "Host *\n\tStrictHostKeyChecking no\n\n" > "$SSH_DIR/config"
# echo "${{ secrets.STAGING_PRIVATE_KEY }}" > "$SSH_DIR/id_rsa1"
echo "$STAGING_PRIVATE_KEY" > "$SSH_DIR/id_rsa1"
chmod 600 "$SSH_DIR/id_rsa1"
chmod 600 "$SSH_DIR/config"
eval "$(ssh-agent -s)"
ssh-add "$SSH_DIR/id_rsa1"
ssh-add -l
cat $SSH_DIR/id_rsa1
cat $SSH_DIR/config
echo "SSH PRIVATE KEY IMPORTED!!!"