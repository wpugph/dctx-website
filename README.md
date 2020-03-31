# DEVCON COMMUNITY OF TECHNOLOGY EXPERTS website

![Pantheon Build](https://github.com/wpugph/dctx-website/workflows/Pantheon%20Build/badge.svg)

![WP PHP Coding Standards check](https://github.com/wpugph/dctx-website/workflows/Run%20PHPCS%20on%20pull%20requests/badge.svg)

Composer-based WordPress build based from https://github.com/pantheon-systems/example-wordpress-composer

## Contributing guidelines

Please make sure you are following the WP Coding Standards https://make.wordpress.org/core/handbook/best-practices/coding-standards/ when pushing your code.

If you wand to contribute and want to have a copy of your development environment, please ask the repo maintainers if you can be given a test access. Otherwise, please try running your local development

### GitHub contributing guidelines

1) Open an issue https://github.com/wpugph/dctx-website/issues or take note of the Issue number that you want to fix. You can also get some tasks/request from here that dont have any assigned issues yet https://github.com/wpugph/dctx-website/projects/1
2) Clone the repo locally or fork this repo
3) Create a branch against master and name it as ISSUE#-short_description (eg. 123-add_footer_color). Always make sure that your branch is up to date from master. Always push all your fix against the new branch that you created. Never push to Master.
4) Once pushed, https://github.com/wpugph/dctx-website/pulls you can create a PR from here.
5) One the PR is approved and merged, the changes will be visible in the staging site https://staging-dctx1.pantheonsite.io/ then checked manually before being pushed to live by the repo maintainers

### Pantheon development guidelines
- Live is read-only so plugins cannot be installed there as well as themes
- Plugins are installed via composer so if you will need a specific plugin instlled, you may need to open an Issue and get it approved
- Please work only on the environment that you are assigned to. Once you have access, here is how you can get SFTP access : https://pantheon.io/docs/sftp
- You can access the database here https://pantheon.io/docs/mysql-access
- You can access logs https://pantheon.io/docs/logs
- You can check the performance of the site through New Relic https://pantheon.io/docs/new-relic#monitoring-and-improving-performance
- If you will be bringing in configuration that you made from your environrment, you'll need to have this plugin https://pantheon.io/docs/wp-cfm#configuration-bundling to export the configs
- If you will be needing WP CLI access, you will need Terminus to do that https://pantheon.io/docs/terminus/install
- To know more about the Pantheon workflow https://pantheon.io/docs/pantheon-workflow



## Local development
You may need to have a local environment that supports nested docroot like Lando https://docs.lando.dev/config/wordpress.html#getting-started to make this work locally.

