# Workstation Management

## Getting started
### Install dependencies
#### Using Docker (recommended)
* To install dependencies, in the root folder, run: `docker run --rm -it -v $(pwd):/app bitnami/php-fpm composer update`
* **Note:** In my system, it needs to change owner, then if your database didn't raise up, just do the same: `sudo chown -R ${USER}: .`

## Sail Installation & Usage
* In my local system, I used `mariadb`. but feel free to use anything you want. It should work on different RDBMS.
* Also, I have `alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'` in my `.zshrc` file. helps for easy access to `sail` commands.
* sail up -d
* sail pest

## Usage
* To run tests, in the root folder, run: `sail test` or `sail pest`
* to visit the web page, in the browser, go to `http://localhost`

## Predictable future extends
1. using different type of files to input data
2. using form to enter data
3. lists should be filterable and sortable
4. lists need to have pagination

## Thinking Process
I've logged my thinking process to have better understanding of the problem before starting to code.

[ThinkingProcess.md](docs%2FThinkingProcess.md)
